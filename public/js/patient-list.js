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

el('previous-page').onclick = async(e) => {

	const page = el('current-page').getAttribute('data-page');
    const intPage = Number(page);
    if (isNaN(intPage)) return;

    const filter = el('filter').value;
    const searchQuery = el('query').value;

    console.log(filter, searchQuery)
    if (filter && searchQuery) {
        return await getData(intPage - 1, filter, searchQuery);
    };

    await getData(intPage - 1);
}

el('next-page').onclick = async(e) => {

	const page = el('current-page').getAttribute('data-page');
	const intPage = Number(page);
	if (isNaN(intPage)) return;

    const filter = el('filter').value;
    const searchQuery = el('query').value;

    console.log(filter, searchQuery)
    if (filter && searchQuery) {
        return await getData(intPage + 1, filter, searchQuery);
    };

    await getData(intPage + 1);
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
        setPage(page);
        return noData("Tidak ada data di halaman " + page);
    }

	el('patientListBody').innerHTML = '';

	for(let patient of data) {
		const newData = document.createElement('tr');
		newData.className = '*:text-gray-900 *:first:font-medium';

		newData.innerHTML = `
		<td class="px-3 py-2 whitespace-nowrap">${patient.patient_erm}</td>
		<td class="px-3 py-2 whitespace-nowrap">${patient.patient_nik}</td>
		<td class="px-3 py-2 whitespace-nowrap">${patient.full_name}</td>
		<td class="px-3 py-2 whitespace-nowrap">${patient.phone_number}</td>
		<td class="px-3 py-2 whitespace-nowrap">
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
            newData.className = '*:text-gray-900 *:first:font-medium';

            newData.innerHTML = `
            <td class="px-3 py-2 whitespace-nowrap">Data tidak ditemukan</td>`

            patientListBody.appendChild(newData);
            return;
        };

        render(response, 1)
    } catch(err) {
        console.log(err.stack);
    }
}
