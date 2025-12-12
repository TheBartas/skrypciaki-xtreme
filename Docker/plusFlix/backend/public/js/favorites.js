function setCookie(name, value, exdays = 365) {
    const date = new Date();
    date.setTime(date.getTime() + exdays * 24 * 60 * 60 * 1000);
    const expires = date.toUTCString();
    document.cookie = `${name}=${value}; expires=${expires}; path=/; SameSite=Lax`;
}

function getCookie(name) {
    let decodedCookie = decodeURIComponent(document.cookie);
    return decodedCookie
        .split("; ")
        .find(row => row.startsWith(name + "="))
        ?.split("=")[1];
}

function getFavorites() {
    try {
        return JSON.parse(getCookie("favorites") ?? "[]");
    } catch {
        return [];
    }
}

function saveFavorites(list) {
    setCookie("favorites", JSON.stringify(list));
}

const favButtons = document.querySelectorAll('.fav-btn');

favButtons.forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault();
        const id = btn.dataset.id;
        let favorites = getFavorites();
        console.log(favorites);

        if (favorites.includes(id)) {
            favorites = favorites.filter(
                fav => fav != id
            );
            e.target.classList.remove("active");
        } else {
            favorites.push(id);
            e.target.classList.add("active");
        }
        saveFavorites(favorites);
    })
});

document.addEventListener("DOMContentLoaded", () => {
    const favorites = getFavorites();
    document.querySelectorAll(".fav-btn").forEach(btn => {
        if (favorites.includes(btn.dataset.id)) {
            btn.classList.add("active");
        }
    });
});