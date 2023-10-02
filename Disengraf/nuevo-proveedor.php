<?php
include "sesion.php";
include "Resources/conexion.php";

// consultar todas las categorias
$consulta_usuarios = "SELECT * FROM proveedores";
$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta_usuarios);


// declarar variables de value
$errores = [];
$codigo = '';
$proveedor = '';
$referencia = '';
$direccion = '';
$pais = '';
$provincia = '';
$poblacion = '';
$codPostal = '';
$telefono = '';
$correo = '';
$nacional = '';
$state=0;

if (isset($_POST['insertar'])) { // Verifica si el formulario se ha enviado

    // Recogemos los valores donde los almacenamos y sanitizamos
    $proveedor = $_POST['proveedor'];
    $referencia = $_POST['referencia'];
    $direccion = $_POST['direccion'];
    $pais = $_POST['pais'];
    $provincia = $_POST['provincia'];
    $poblacion = $_POST['poblacion'];
    $codPostal = $_POST['codPostal'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $nacional = $_POST['nacional'];
    

    // Verificacion de formulario
    /*if (!$codigo) {
        $errores[] = "Debes añadir un nombre proveedor";
    }*/

    if (!$proveedor) {
        $errores[] = "Debes añadir un proveedor";
    }

    if (!$referencia) {
        $errores[] = "Debes añadir una referencia";
    }

    if (!$direccion) {
        $errores[] = "Debes añadir una direccion";
    }

    if (!$pais) {
        $errores[] = "Debes añadir un pais";
    }

    if (!$provincia) {
        $errores[] = "Debes añadir una provincia";
    }

    if (!$poblacion) {
        $errores[] = "Debes añadir una poblacion";
    }

    if (!$codPostal) {
        $errores[] = "Debes añadir un codPostal";
    }

    if (!$telefono) {
        $errores[] = "Debes añadir un telefono";
    }

    if (!$correo) {
        $errores[] = "Debes añadir un email";
    }

    if (!$nacional) {
        $errores[] = "Debes añadir un nacional";
    }

    // revisar el array de errores y si esta vacio lo guarda en la base de datos
    if (empty($errores)) {
        $consulta = "INSERT INTO proveedores (proveedor, referencia, direccion, poblacion, pais, provincia, codPostal, telefono, correo, nacional) 
        values ('$proveedor','$referencia','$direccion','$poblacion','$pais','$provincia','$codPostal','$telefono','$correo','$nacional')";

        $con = new Conexion();
        $resultadoConsulta2 = $con->query($consulta);
        $state=2;

        /*if ($resultados) {
            setRegistro($nombre, 11, $id_usuario,$id_categoria,$id_insertado,$conn);

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
    <link rel="stylesheet" href="css/style.css">
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
            <img src="img/luna.png" heigth="20px" width="20px">
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
                                    <li><a href="Usuarios.php">Usuarios</a></li>
                                    <li><a href="proveedores.php">Proveedores</a></li>
                                </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                        <div class="logo_nav">
                            <img src="img/LOGO-SOLO.png" width="170px" heigth="170px">

                            <div class="iconos_nav"> 
                        
                                <img class="logo_usuario" src="img/iconos-06.png">
                            
                                <img class="icono_username" src="img/iconos-07.png">
                            
                                <img class="logo_usuario" src="img/iconos-05.png">
                            
                            </div>
                            <p class="nombre_usuario">Francisco José</p>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="bloque-botones">
                <!-- Contenido de la página -->
                <div class="titulo-paginas">
                    <h2 class="titulo-paginas-h2">NUEVO PROVEEDOR</h2>
                </div>
                <form class="formulario" method="post">
                    <div class="datos-formu">
                        <!-- Reproduccion de errores en pantalla -->
                        <?php foreach ($errores as $error): ?>
                            <div class="alerta error">
                                <?php echo $error; ?>
                            </div>
                        <?php endforeach; ?>

                        <!-- Reproduccion de alerta satisfactoria -->
                        <?php if (intval($state) === 2): ?>
                            <div class="alerta succes">
                                <?php echo "Proveedor insertado correctamente"; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Proveedor:</label>
                        <input class="formulario-input" type="text" placeholder="Nombre Proveedor" name="proveedor"
                        value="<?php echo $proveedor ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Referencia:</label>
                        <input class="formulario-input" type="text" placeholder="Referencia" name="referencia"
                        value="<?php echo $referencia ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Dirección:</label>
                        <input class="formulario-input" type="text" placeholder="Direccion" name="direccion"
                        value="<?php echo $direccion ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">País:</label>
                        <input class="formulario-input" type="text" placeholder="Pais:" name="pais"
                            value="<?php echo $pais ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Población:</label>
                        <input class="formulario-input" type="text" placeholder="Poblacion:" name="poblacion"
                            value="<?php echo $poblacion ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Provincia:</label>
                        <input class="formulario-input" type="text" placeholder="Provincia:" name="provincia"
                            value="<?php echo $provincia ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Código Postal:</label>
                        <input class="formulario-input" type="text" placeholder="codPostal:" name="codPostal"
                            value="<?php echo $codPostal ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Teléfono:</label>
                        <input class="formulario-input" type="text" placeholder="telefono:" name="telefono"
                            value="<?php echo $telefono ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Email:</label>
                        <input class="formulario-input" type="email" placeholder="Correo" name="correo"
                        value="<?php echo $correo ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Nacional:</label>
                        <input class="formulario-input" type="text" placeholder="Nacional:" name="nacional"
                        value="<?php echo $nacional ?>">
                    </div>
                    <div class="datos-formu">
                        <input class="Boton-insertar" type="submit" value="Insertar" name="insertar">
                        <a class="contenedor-boton-volver" href="usuarios.php">
                            <div class="Boton-volver">Volver</div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="js/click.js"></script>
</body>
    <script src="js/menu-nav.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/submenu.js"></script>
</html>
