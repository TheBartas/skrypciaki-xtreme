const input = document.getElementById('home-search-input');
const suggestionsBox = document.getElementById('suggestions');
const form = document.getElementById('home-search-form');

const searchUrl = form.dataset.searchUrl;
const suggestionsUrl = form.dataset.suggestionsUrl;

input.addEventListener('input', async () => {
    const q = input.value.trim();

    if (q.length < 2) {
        suggestionsBox.innerHTML = '';
        return;
    }

    const res = await fetch(suggestionsUrl + '?q=' + encodeURIComponent(q));
    const suggestions = await res.json();

    suggestionsBox.innerHTML = '';

    suggestions.forEach(item => {
        const div = document.createElement('div');
        div.className = 'suggestion-item';
        div.textContent = `${item.name} (${item.year})`;

        div.addEventListener('click', () => {
            window.location.href = searchUrl + '?q=' + encodeURIComponent(item.name);
        });

        suggestionsBox.appendChild(div);
    });
});

input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        const q = input.value.trim();
        if (q) {
            window.location.href = searchUrl + '?q=' + encodeURIComponent(q);
        }
    }
});
