<?php
include "../sesion.php";
include "../Resources/conexion.php";
 

// Recogemos el id pasado por la url.
$id = $_GET['id'];
$consulta = "SELECT * FROM categorias WHERE id = $id";

$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta);
$categoria = $resultadoConsulta[0];

// variables de la pagina
$nombre_categoria = $categoria['nombre'];
$descripcion_categoria = $categoria['descripcion'];
$pagina = 'modificar-categoria';
$id_categoria = $id;
$errores = [];
$state = 0;
$menu_confirmacion = false;


// evento modificar categoria
if (isset($_POST['modificar'])) {
    $id_modificar = $id;
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
        $consulta2 = "UPDATE categorias SET nombre = '$nombre_categoria', descripcion = '$descripcion_categoria' WHERE id = $id_modificar";
        $con = new Conexion();
        $resultadoConsulta2 = $con->query($consulta2);
        $state = 1;

        /*if ($resultados) {
            setRegistro($nombre_categoria, 1, $id_usuario, $id_categoria, $conn);

        } else {
            echo "Error al eliminar la categoría: " . mysqli_error($conn);
        }*/
    }
}
// evento eliminar categoria
if (isset($_POST['confirmar-borrar'])) {
    $id_borrar = $id;
    $consulta3 = "DELETE FROM categorias WHERE id = $id_borrar";

    $con = new Conexion();
    $resultadoConsulta3 = $con->query($consulta3);
    $menu_confirmacion = false;

    /*if ($resultados) {
        setRegistro($nombre_categoria, 3, $id_usuario, $id_categoria, $conn);

    } else {
        echo "Error al eliminar la categoría: " . mysqli_error($conn);
    }*/
}

if (isset($_POST['cancelar-borrar'])) {
    $menu_confirmacion = false;
}

if (isset($_POST['confirmacion'])) {
    $menu_confirmacion = true;
}

if($menu_confirmacion){
    $titulo_pagina = "ELIMINAR CATEGORIA";

}else{
    $titulo_pagina = "MODIFICAR CATEGORIA";
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
                    <h2 class="titulo-paginas-h2"><?php echo $titulo_pagina;?></h2>
                </div>
                <form class="formulario" method="post" id="categoriaForm">
                    
                        <!-- Reproduccion de errores en pantalla -->

                        <?php if(count($errores) > 0): ?>
                            <div class="datos-formu">
                            <?php foreach ($errores as $error): ?>
                                <div class="alerta error">
                                    <?php echo $error; ?>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Reproduccion de alerta satisfactoria -->
                        <?php if (intVal($state) === 1): ?>
                            <div class="alerta succes">
                                <?php echo "Categoria Modificada Correctamente"; ?>
                            </div>
                        <?php endif; ?>
                
                    <div class="datos-formu">
                        <?php if ($menu_confirmacion): ?>               
                            <p style="color: white;">¿Seguro que quieres eliminar la categoria <span><?php echo $nombre_categoria?></span>?</p>
                            <input class="Boton-insertar-input" type="submit" value="No" name="cancelar-borrar">
                            <input class="Boton-insertar-input" type="submit" value="Borrar" name="confirmar-borrar">
                        <?php else: ?>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Nombre:</label>
                        <input class="formulario-input" type="text" value="<?php echo $nombre_categoria ?>" name="nombre">
                    </div>

                    <div class="datos-formu">
                        <label class="formulario-label">Descripcion:</label>
                        <input class="formulario-input" type="text" value="<?php echo $descripcion_categoria ?>" name="descripcion">
                    </div>
                    <div class="datos-formu">
                            <input class="Boton-insertar-input" type="submit" value="Modificar" name="modificar">
                            <input class="Boton-insertar-input" type="submit" value="Borrar" name="confirmacion">
                            <a class="contenedor-boton-volver" href="categorias.php">
                                <div class="Boton-volver">Volver</div>
                            </a>
                        <?php endif; ?>
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
