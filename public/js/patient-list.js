const el = (id) => document.getElementById(id);

function setPage(page) {
    el('current-page').innerHTML = `Halaman ${page}`;
    el('current-page').setAttribute('data-page', page);
}

function noData(msg) {
    const patientListBody = el('patientListBody');
    patientListBody.innerHTML = '';

    const newData = document.createElement('tr');
    newData.className = '*:text-gray-900 *:first:font-medium';

    newData.innerHTML = `
    <td class="px-3 py-2 whitespace-nowrap">${msg ?? 'Data tidak ditemukan'}</td>`

    patientListBody.appendChild(newData);
}

let prevPage = el('previous-page');
if (prevPage) {
prevPage.onclick = async(e) => {
    const page = el('current-page').getAttribute('data-page');
    const intPage = Number(page);
    if (isNaN(intPage)) return;
    if (intPage < 2) return;

    const filter = el('filter').value;
    const searchQuery = el('query').value;

    if (filter && searchQuery) {
        return await getData(intPage - 1, filter, searchQuery);
    };

    await getData(intPage - 1);
    }
}

let nextPage = el('next-page');
if (nextPage) {
nextPage.onclick = async(e) => {
	const page = el('current-page').getAttribute('data-page');
	const intPage = Number(page);
	if (isNaN(intPage)) return;

    const filter = el('filter').value;
    const searchQuery = el('query').value;

    if (filter && searchQuery) {
        return await getData(intPage + 1, filter, searchQuery);
    };

    await getData(intPage + 1);
}
}

async function getData(page, filter, searchQuery) {
	try {
	    let url = '/api/patients/fetch?page=' + page;
	    if (filter) {
	        url = `/api/patients/fetch?page=${page}&filter=${filter}&query=${searchQuery}`;
	    }

		const request = await fetch(url);
		const response = await request.json();
		render(response, page)
	} catch(err) {
    	console.log(err.stack);
	}
}

function render(data, page) {
    if (!data.length) {
        return;
    }

	el('patientListBody').innerHTML = '';

	for(let patient of data) {
		const newData = document.createElement('tr');

		newData.innerHTML = `
		<td>${patient.patient_erm ?? ''}</td>
		<td>${patient.patient_nik ?? ''}</td>
		<td>${patient.full_name ?? ''}</td>
		<td>${patient.phone_number ?? ''}</td>
		<td>
			<a href="/patients/edit/${patient.account_id}">
	            <button class="btn btn-info">Ubah</button>
	        </a>
	        <a href="/patients/delete/${patient.account_id}">
	            <button class="btn btn-error">Hapus</button>
	        </a>
		</td>`;

		el('patientListBody').appendChild(newData);

		if (page) setPage(page)
	}

}

let search = el('search');
if (search) {
    el('search').onclick = async() => {
        const filter = el('filter').value;
        if (!filter) return;

        const searchQuery = el('query').value;
        if (!searchQuery) return;

        try {
            const request = await fetch(`/api/patients/fetch?page=1&filter=${filter}&query=${searchQuery}`);
            const response = await request.json();

            if (!response.length) {
                const patientListBody = el('patientListBody');
                patientListBody.innerHTML = '';

                const newData = document.createElement('tr');

                newData.innerHTML = `
                <td>Data tidak ditemukan</td>`

                patientListBody.appendChild(newData);
                return;
            };

            render(response, 1)
        } catch(err) {
            console.log(err.stack);
        }
    }
}

const checkboxes = document.querySelectorAll('.checkbox');
document.onclick = async(e) => {
    let target = e.target;

    if (target.className === 'checkbox') {
        event.preventDefault();

        try {
            const checked = target.checked;
            if (typeof checked !== 'boolean') return;

            const accountId = target.getAttribute('data-account_id');
            if (!accountId) return;

            const request = await fetch(`/api/patients/verify?account_id=${accountId}&checked=${checked}`);

            target.checked = checked;
        } catch(err) {
            console.error(err.message);
        }
    }
}
