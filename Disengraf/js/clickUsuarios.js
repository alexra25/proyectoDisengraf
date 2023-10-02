// Agregar un evento de clic a las celdas de categoría
var categoriaCells = document.querySelectorAll(".categoria-cell");
categoriaCells.forEach(function (cell) {
    cell.style.cursor = "pointer"; // Cambiar el cursor a mano al pasar el ratón
    cell.addEventListener("click", function () {
        // Obtener el ID de la categoría desde el atributo "data-id"
        var idUsuario = this.getAttribute("data-id");

        // Redirigir a "productos-por-categoria.php" con el ID en la URL
        window.location.href = "modificar-usuario.php?id=" + idUsuario;
    });
});