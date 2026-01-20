const btn = document.getElementById("hamburger-btn");
const menu = document.getElementById("menu-lateral");

// Abrir menú al pasar el cursor sobre el botón
btn.addEventListener("mouseenter", () => {
  menu.classList.add("open");
});

// Cerrar menú si el cursor sale del botón, del menú o del overlay
btn.addEventListener("mouseleave", (e) => {
  if (!menu.contains(e.relatedTarget)) {
    menu.classList.remove("open");
  }
});

menu.addEventListener("mouseleave", (e) => {
  if (!btn.contains(e.relatedTarget)) {
    menu.classList.remove("open");
  }
});

// Detectar overlay
menu.addEventListener("mousemove", (e) => {
  const rect = menu.getBoundingClientRect();
  if (
    e.clientX < rect.left ||
    e.clientX > rect.right ||
    e.clientY < rect.top ||
    e.clientY > rect.bottom
  ) {
    menu.classList.remove("open");
  }
});

// Cerrar menú al hacer click en un enlace
menu.querySelectorAll("a").forEach(link => {
  link.addEventListener("click", () => {
    menu.classList.remove("open");
  });
});