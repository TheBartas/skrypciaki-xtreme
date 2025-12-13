const modal = document.getElementById('categoryModal');
const closeBtn = document.querySelector('.modal-close-btn');
const addBtn = document.getElementById('addBtn');
const form = document.getElementById('form');
const nameInput = document.getElementById('formInput');

addBtn.onclick = () => {
    modal.style.display = 'block';
    nameInput.value = "";
};

document.querySelectorAll('.editCategoryBtn').forEach(btn => {
    btn.onclick = () => {
        modal.style.display = 'block';

        let id = btn.dataset.id;
        let name = btn.dataset.name;

        nameInput.value = name;

        form.action = "/admin/categories/edit/" + id;
    };
});

document.querySelectorAll('.deleteCategoryLink').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();

        if (!confirm('Na pewno chcesz usunąć tę kategorię?')) return;

        let id = this.dataset.id;

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/categories/delete/' + id;
        document.body.appendChild(form);

        form.submit();
    });
});


closeBtn.onclick = () => modal.style.display = 'none';
window.onclick = (e) => {
    if (e.target === modal) modal.style.display = 'none';
};
