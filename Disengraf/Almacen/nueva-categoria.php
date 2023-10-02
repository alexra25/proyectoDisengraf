<?php
include "../sesion.php";
include "../Resources/conexion.php";
 

// variables de la pagina
$nombre_categoria = '';
$descripcion_categoria = '';
$pagina = "nueva-categoria";
$errores = [];
$state = 0;

// evento nueva categoria
if (isset($_POST['insertar'])) {
    $nombre_categoria = $_POST['nombre'];
    $descripcion_categoria = $_POST['descripcion'];

    //comprobacion de errores
    if (!$nombre_categoria) {
        $errores[] = "Debes añadir un nombre";
    }

    if (!$descripcion_categoria) {
        $errores[] = "Debes añadir una descripcion";
    }

    if (empty($errores)) {
        $consulta = "INSERT INTO categorias (nombre,descripcion) values ('$nombre_categoria','$descripcion_categoria')";
        $con = new Conexion();
        $resultadoConsulta = $con->query($consulta);

        // Obtiene el último ID insertado
        if ($resultadoConsulta) {
            $consulta = "SELECT * FROM categorias WHERE nombre=$nombre_categoria";
            $con = new Conexion();
            //$id_categoria = $con->query($consulta);
        }
    
        /*if ($resultados) {
            setRegistro($nombre_categoria, 3, $id_usuario, $id_categoria, $conn);

        } else {
            echo "Error al eliminar la categoría: " . mysqli_error($conn);
        }*/
       
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <title>Index</title>
    
</head>
<body class="body_a">
    <header class="header_a">
        <div class="burguer">
            <div class="menu-toggle" id="menuToggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <h2 class="h2_a">DISENGRAF</h2>
        </div>
        <div class="mode-switch" id="modeSwitch">
            <img src="../img/luna.png" heigth="20px" width="20px">
            <label class="switch">
                <input type="checkbox" id="nightModeToggle">
                <span class="slider round"></span>
            </label>
        </div>
    </header>

    <main>
        <div class="contenido-main">
            <!--MENU DE NAVEGACION-->
            <!-- Menú desplegable -->
            <div class="contenido-principal">
            <div class="bloque-menu" id="menuBloque">
                <div  class="menu-overlay" id="menuOverlay">
                    <nav class="menu">
                    <ul>
                        <li>
                            <p class="titu-submenu toggle-link">&nbsp; &nbsp; CONTROL DE STOCK</p>
                            <ul class="submenu">
                                <li><a href="categorias.php">Categorias</a></li>
                                <li><a href="productos.php">Productos</a></li>
                                <li><a href="notificaciones.php">Notificaciones</a></li>
                                <li><a href="seguimiento.php">Seguimiento</a></li>
                                <li><a href="Registro.php">Registro</a></li>
                                <!-- Agrega más enlaces de servicios aquí -->
                            </ul>
                        </li>
                        <li>
                            <p class="titu-submenu toggle-link">&nbsp; &nbsp; FICHAS TÉCNICAS</p>
                            <ul class="submenu">
                            </ul>
                        </li>
                        <li>
                            <p class="titu-submenu toggle-link">&nbsp; &nbsp; BUSCAR PEDIDO</p>
                            <ul class="submenu">
                            </ul>
                        </li>
                        <li>
                            <p class="titu-submenu toggle-link">&nbsp; &nbsp; PRODUCCIÓN</p>
                            <ul class="submenu">
                            </ul>
                        </li>
                        <li>
                            <p class="titu-submenu toggle-link">&nbsp; &nbsp; CORREO</p>
                            <ul class="submenu">
                            </ul>
                        </li>
                        <li>
                            <p class="titu-submenu toggle-link">&nbsp; &nbsp; LEN</p>
                            <ul class="submenu">
                            </ul>
                        </li>
                        <li>
                            <?php if (intval($id_rol) == 1): ?>
                                <p class="titu-submenu toggle-link">&nbsp; &nbsp; ADMINISTRADOR</p>
                                <ul class="submenu">
                                    <li><a href="../Usuarios.php">Usuarios</a></li>
                                    <li><a href="../proveedores.php">Proveedores</a></li>
                                </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                        <div class="logo_nav">
                            <img src="../img/LOGO-SOLO.png" width="170px" heigth="170px">

                            <div class="iconos_nav"> 
                        
                                <img class="logo_usuario" src="../img/iconos-06.png">
                            
                                <img class="icono_username" src="../img/iconos-07.png">
                            
                                <img class="logo_usuario" src="../img/iconos-05.png">
                            
                            </div>
                            <p class="nombre_usuario">Francisco José</p>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="bloque-botones">
                <!-- Contenido de la página -->
                <div class="titulo-paginas">
                    <h2 class="titulo-paginas-h2">NUEVA CATEGORIA</h2>
                </div>
                <form class="formulario" method="post">
                    <div class="datos-formu">
                        <label class="formulario-label">Nombre:</label>
                        <input class="formulario-input" type="text" value="<?php echo $nombre_categoria ?>" name="nombre">
                    </div>

                    <div class="datos-formu">
                        <label class="formulario-label">Descripcion:</label>
                        <input class="formulario-input" type="text" value="<?php echo $descripcion_categoria ?>" name="descripcion">
                    </div>
                    <div class="datos-formu">
                        <input class="Boton-insertar" type="submit" value="Insertar" name="insertar">
                        <a class="contenedor-boton-volver" href="categorias.php">
                            <div class="Boton-volver">Volver</div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/click.js"></script>
</body>
    <script src="../js/menu-nav.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/submenu.js"></script>
</html>
