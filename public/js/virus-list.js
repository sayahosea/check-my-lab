const el = (id) => document.getElementById(id);

document.onclick = async(e) => {
    let target = e.target;

    if (target.nodeName === 'BUTTON') {
        const action = target.getAttribute('data-action');
        if (!['EDIT', 'ADD', 'DELETE'].includes(action)) return;

        let id = target.getAttribute('data-virus-id');
        if (!id) return;

        if (action === 'DELETE') {
            const name = target.getAttribute('data-virus-name');
            el('delete_message').innerText = `Apakah Anda yakin ingin menghapus virus ${name}?`;
            el('delete_link').setAttribute('href', `/outbreak/virus/delete/${id}`);
            return;
        }

        el('name').value = target.getAttribute('data-virus-name');
        el('id').value = id;
    }
}
