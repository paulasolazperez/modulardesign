class MyHeader extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
      <header class="header-inicio">
    <div class="logo">
      <img src="images/logo.png" alt="Logo de la empresa">
    </div>

    <button class="hamburger-btn" id="hamburger-btn">☰</button>

    <nav class="menu-lateral" id="menu-lateral">
      <ul>
        <li><a href="#index">Inicio</a></li>
        <li><a href="#catalogo">Catálogo</a></li>
        <li><a href="nosotros.html">Nosotros</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>
  </header>
    `;
    }
}
customElements.define('my-header', MyHeader);