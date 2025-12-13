const modal = document.getElementById('tagModal');
const closeBtn = document.querySelector('.modal-close-btn');
const addBtn = document.getElementById('addBtn');
const form = document.getElementById('form');
const title = document.getElementById('modal-title');
const nameInput = document.getElementById('formInput');

addBtn.onclick = () => {
    modal.style.display = 'block';
    title.innerText = "Dodaj tag";
    // form.action = "{{ path('admin_tag_add') }}";
    nameInput.value = "";
};

document.querySelectorAll('.editTagBtn').forEach(btn => {
    btn.onclick = () => {
        modal.style.display = 'block';
        title.innerText = "Edytuj tag";

        let id = btn.dataset.id;
        let name = btn.dataset.name;

        nameInput.value = name;

        form.action = "/admin/tags/edit/" + id;
    };
});

document.querySelectorAll('.deleteTagLink').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();

        if (!confirm('Na pewno chcesz usunąć ten tag?')) return;

        let id = this.dataset.id;

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/tags/delete/' + id;
        document.body.appendChild(form);

        form.submit();
    });
});

closeBtn.onclick = () => modal.style.display = 'none';
window.onclick = (e) => {
    if (e.target === modal) modal.style.display = 'none';
};
