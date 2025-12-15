(function () {
    const storedTheme = localStorage.getItem('theme');

    if (storedTheme) {
        document.documentElement.dataset.theme = storedTheme;
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.dataset.theme = 'dark';
    } else {
        document.documentElement.dataset.theme = 'light';
    }
})();


document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById('theme-toggle');

    if(document.documentElement.dataset.theme === 'dark')
    {
        toggleBtn.classList.add('dark');
    }

    toggleBtn.addEventListener('click', () => {
        const isDark = document.documentElement.dataset.theme === 'dark';
        const newTheme = isDark ? 'light' : 'dark';

        toggleBtn.classList.toggle('dark');

        document.documentElement.dataset.theme = newTheme;
        localStorage.setItem('theme', newTheme);
    });
});
