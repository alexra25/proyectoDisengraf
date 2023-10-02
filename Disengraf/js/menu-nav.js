        const menuToggle = document.getElementById('menuToggle');
        const menuOverlay = document.getElementById('menuOverlay');
        const menuBloque = document.getElementById('menuBloque');
        const body = document.body;

        // Abre el menú al cargar la página
        menuOverlay.classList.add('menu-open');

        menuToggle.addEventListener('click', () => {
            menuOverlay.classList.toggle('menu-open');
            menuBloque.classList.toggle('bloque-menu-oculto');
            body.classList.toggle('no-scroll'); // Agregar esta línea para evitar el desplazamiento de la página
        });

        /*//Eventos para ocultar los enlaces.
        document.addEventListener("DOMContentLoaded", function () {
            const tituloControlStock = document.querySelector(".titu-submenu");
            const submenu = document.querySelector(".submenu");

            tituloControlStock.addEventListener("click", function () {
                submenu.classList.toggle("oculto");
            });
        });*/