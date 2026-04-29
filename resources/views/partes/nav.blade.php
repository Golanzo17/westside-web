    <!-- Navegación -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">WESTSIDE</a>

            <ul class="nav-links">
                <li><a href="/quienes-somos">Quienes Somos</a></li>
                <li><a href="/catalogo">Catálogo</a></li>
                <li><a href="/comercializacion">Comercialización</a></li>
                <li><a href="/terminos-y-usos">Términos y Usos</a></li>
                <li><a href="/contacto">Contacto</a></li>
                <li><a href="/consultas">Consultas</a></li>
                <li><a href="/turnos" class="btn-primary">Turnos</a></li>
            </ul>

            <!-- Botón hamburguesa — solo visible en mobile -->
            <button class="nav-hamburger" id="nav-hamburger" aria-label="Abrir menú de navegación">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Menú mobile — overlay de pantalla completa -->
    <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <ul class="mobile-menu-links">
            <li><a href="/quienes-somos" class="mobile-menu-link">Quienes Somos</a></li>
            <li><a href="/catalogo" class="mobile-menu-link">Catálogo</a></li>
            <li><a href="/comercializacion" class="mobile-menu-link">Comercialización</a></li>
            <li><a href="/terminos-y-usos" class="mobile-menu-link">Términos y Usos</a></li>
            <li><a href="/contacto" class="mobile-menu-link">Contacto</a></li>
            <li><a href="/consultas" class="mobile-menu-link">Consultas</a></li>
            <li><a href="/turnos" class="mobile-menu-link mobile-menu-link--cta">Reservar Turno</a></li>
        </ul>
    </div>

    <script>
        (function () {
            const btn  = document.getElementById('nav-hamburger');
            const menu = document.getElementById('mobile-menu');

            function toggle() {
                const isOpen = menu.classList.toggle('is-open');
                btn.classList.toggle('is-open');
                document.body.classList.toggle('menu-open');
                menu.setAttribute('aria-hidden', String(!isOpen));
            }

            btn.addEventListener('click', toggle);

            // Cerrar al tocar cualquier link
            menu.querySelectorAll('.mobile-menu-link').forEach(a =>
                a.addEventListener('click', () => {
                    menu.classList.remove('is-open');
                    btn.classList.remove('is-open');
                    document.body.classList.remove('menu-open');
                    menu.setAttribute('aria-hidden', 'true');
                })
            );

            // Cerrar con tecla Escape
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && menu.classList.contains('is-open')) toggle();
            });
        })();
    </script>
