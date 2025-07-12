const el = (id) => document.getElementById(id);

el('patientList').onclick = async(e) => {
    const target = e.target;

    if (target.tagName === 'LI') {
        const accountId = target.dataset.id;
        if (!accountId || accountId === "" || accountId.length != 36) return;
const el = (id) => document.getElementById()
        await getData(accountId, e);
    }
}

async function getData(accountId, e) {

    const req = await fetch(`/api/test/fetch?account_id=${accountId}`);
    if (!req.ok) return;

    try {
        const results = await req.json();

        const testResultsBody = document.getElementById('testResultsBody');
        testResultsBody.innerHTML = '';

        if (!results.length) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>Tidak ada data ${e.target.innerText}</td>
            `;
            testResultsBody.appendChild(tr);
            return
        };

        for (let result of results) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${result.patient_erm}</td>
                <td>${result.timestamp}</td>
                <td>${result.patient_nik}</td>
                <td>
                    <a href="/tests/view/${result.test_id}">
                        <button class="btn bg-green-300 text-black px-3 py-1 rounded mr-2 hover:bg-green-400">Lihat</button>
                    </a>
                    <a href="/tests/edit/${result.test_id}">
                        <button class="btn bg-yellow-300 text-black px-3 py-1 rounded mr-2 hover:bg-yellow-400">Edit</button>
                    </a>
                    <a href="/tests/delete/${result.test_id}">
                        <button class="btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                    </a>
                </td>
            `;
            testResultsBody.appendChild(tr);
        }
    } catch(err) {
        alert('error:' + err.message);
    }

}
