const tagsPills = document.querySelectorAll('#tagsPills .pill');
const categoriesPills = document.querySelectorAll('#categoriesPills .pill');
const streamingsPills = document.querySelectorAll('#streamingsPills .pill');

const pillsContainer = document.querySelectorAll('.pills-container');

pillsContainer.forEach(container => {
    container.addEventListener('wheel', function (e) {
        // prevent vertical scrolling
        e.preventDefault();

        // scroll horizontally
        container.scrollLeft += e.deltaY;
    });
});

tagsPills.forEach( pill => {
    pill.addEventListener('click', () => {
        pill.classList.toggle('active');
        const selected = [...document.querySelectorAll('#tagsPills .pill.active')]
            .map(p => p.dataset.value);

        document.getElementById('tagsInput').value = selected.join(',');
    });
})

categoriesPills.forEach( pill => {
    pill.addEventListener('click', () => {
        pill.classList.toggle('active');
        const selected = [...document.querySelectorAll('#categoriesPills .pill.active')]
            .map(p => p.dataset.value);

        document.getElementById('categoriesInput').value = selected.join(',');
        console.log(document.getElementById('categoriesInput').value);
    });
});

streamingsPills.forEach( pill => {
    pill.addEventListener('click', () => {
        pill.classList.toggle('active');
        const selected = [...document.querySelectorAll('#streamingsPills .pill.active')]
            .map(p => p.dataset.value);

        document.getElementById('streamingsInput').value = selected.join(',');
    });
});
