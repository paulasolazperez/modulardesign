const btn = document.getElementById("hamburger-btn");
const menu = document.getElementById("menu-lateral");

btn.addEventListener("click", () => {
    menu.classList.toggle("open");
});

// Cierra el menú al hacer clic fuera de él
menu.addEventListener("click", (e) => {
    if (e.target === menu) {
        menu.classList.remove("open");
    }
});
