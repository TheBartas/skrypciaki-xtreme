const modal = document.getElementById('streamingModal');
const closeBtn = document.querySelector('.modal-close-btn');
const addBtn = document.getElementById('addBtn');
const form = document.getElementById('form');
const title = document.getElementById('modal-title');
const nameInput = document.getElementById('formInput');

addBtn.onclick = () => {
    modal.style.display = 'block';
    title.innerText = "Dodaj platformę";
    nameInput.value = "";
};

document.querySelectorAll('.editStreamingBtn').forEach(btn => {
    btn.onclick = () => {
        modal.style.display = 'block';
        title.innerText = "Edytuj platformę";

        let id = btn.dataset.id;
        let name = btn.dataset.name;

        nameInput.value = name;

        form.action = "/admin/streamings/edit/" + id;
    };
});

document.querySelectorAll('.deleteStreamingLink').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();

        if (!confirm('Na pewno chcesz usunąć tę platformę?')) return;

        let id = this.dataset.id;

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/streamings/delete/' + id;
        document.body.appendChild(form);

        form.submit();
    });
});


closeBtn.onclick = () => modal.style.display = 'none';
window.onclick = (e) => {
    if (e.target === modal) modal.style.display = 'none';
};
