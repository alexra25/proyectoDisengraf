$(document).ready(function() {
    // Cuando se hace clic en un título
    $(".toggle-link").click(function() {
        // Encuentra el elemento .submenu asociado
        var submenu = $(this).siblings(".submenu");
        
        // Cambia la clase de visibilidad del submenu
        if (submenu.hasClass("visible")) {
            submenu.removeClass("visible").addClass("oculto");
        } else {
            submenu.removeClass("oculto").addClass("visible");
        }
    });
});