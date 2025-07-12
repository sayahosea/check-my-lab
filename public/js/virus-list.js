const el = (id) => document.getElementById(id);

document.onclick = async(e) => {
    let target = e.target;

    if (target.nodeName === 'BUTTON') {
        let id = target.getAttribute('data-virus-id');
        if (!id) return;

        el('name').value = target.getAttribute('data-virus-name');
        el('id').value = id;
    }
}
