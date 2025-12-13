const modal = document.getElementById('ratingModal');
const closeBtn = document.querySelector('.modal-close-btn');
const form = document.getElementById('form');
const title = document.getElementById('modalTitle');
const ratingInput = document.getElementById('ratingID');
const commentInput = document.getElementById('commentID');

document.querySelectorAll('.editratingLink').forEach(link => {
    link.onclick = () => {
        modal.style.display = 'block';
        title.innerText = link.dataset.name;

        const ratingId = link.dataset.idRating;

        let rating = link.dataset.rating;
        let comment = link.dataset.comment;

        ratingInput.value = rating;
        commentInput.value = comment;

        form.action = "/admin/rating/edit/" + ratingId;
    };
});

document.querySelectorAll('.deleteratingLink').forEach(link => {
    link.onclick = (e) => {
        e.preventDefault();
        if (!confirm('Na pewno chcesz usunąć tę kategorię?')) return;
        const ratingId = link.dataset.idRating;

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/rating/delete/' + ratingId;
        document.body.appendChild(form);

        form.submit();
    }
})

closeBtn.onclick = () => modal.style.display = 'none';
window.onclick = (e) => {
    if (e.target === modal) modal.style.display = 'none';
};
