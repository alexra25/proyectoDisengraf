<?php
include "sesion.php";
include "Resources/conexion.php";

$consulta_usuarios = "SELECT * FROM usuarios";
$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta_usuarios);

$id = $_GET['id'];

$consulta = "SELECT usuarios.*, departamentos.departamento 
                FROM usuarios 
                INNER JOIN  departamentos ON usuarios.id_departamento = departamentos.id
                WHERE usuarios.id = $id";
$con = new Conexion();
$resultadoConsulta2 = $con->queryAll($consulta);
$usuario = $resultadoConsulta2[0];
$state = 0;

if (isset($_POST['borrar'])) {
    $id_borrar = $id;
    $consulta2 = "DELETE FROM usuarios WHERE id = $id_borrar";
    $con = new Conexion();
    $resultadoConsulta3 = $con->query($consulta2);

    if ($resultadoConsulta3) {
        header("Location: usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario: ";
    }
}

$username = $usuario['username'];
$pasword = $usuario['pasword'];
$nombre = $usuario['nombre'];
$apellido1 = $usuario['apellido1'];
$apellido2 = $usuario['apellido2'];
$email = $usuario['email'];
$departamento = $usuario['departamento'];
$errores=[];

if (isset($_POST['modificar'])) {
    // Recogemos los valores donde los almacenamos y sanitizamos
    $id_modificar = $id;
    $username = $_POST['username'];
    $pasword = $_POST['pasword'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $departamento = $_POST['departamento'];

    // Verificacion de formulario
    if (!$username) {
        $errores[] = "Debes añadir un Nombre Usuario";
    }

    if (!$pasword) {
        $errores[] = "Debes añadir una contraseña";
    }

    if (!$nombre) {
        $errores[] = "Debes añadir un nombre";
    }

    if (!$apellido1) {
        $errores[] = "Debes añadir primer apellido";
    }

    if (!$apellido2) {
        $errores[] = "Debes añadir segundo apellido";
    }

    if (!$email) {
        $errores[] = "Debes añadir un email";
    }

    if (!$departamento) {
        $errores[] = "Debes añadir un departamento";
    }

    if (empty($errores)) {
        $consulta3 = "UPDATE usuarios SET username='$username',pasword='$pasword',nombre='$nombre',apellido1='$apellido1',apellido2='$apellido2',email='$email',id_departamento='$departamento' WHERE id = $id_modificar";
        $con = new Conexion();
        $resultadoConsulta4 = $con->query($consulta3);
        $state = 2;
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
                    <h2 class="titulo-paginas-h2">MODIFICAR USUARIO</h2>
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
                                <?php echo "Usuario modificado correctamente"; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Username:</label>
                        <input class="formulario-input" type="text" placeholder="Nombre Usuario" name="username"
                        value="<?php echo $username ?>">
                    </div>

                    <div class="datos-formu">
                        <label class="formulario-label">Contraseña:</label>
                        <input class="formulario-input" type="text" placeholder="Contraseña" name="pasword"
                        value="<?php echo $pasword ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Nombre:</label>
                        <input class="formulario-input" type="text" placeholder="Nombre" name="nombre"
                        value="<?php echo $nombre ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Primer apellido:</label>
                        <input class="formulario-input" type="text" placeholder="Primer apellido:" name="apellido1"
                        value="<?php echo $apellido1 ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Segundo apellido:</label>
                        <input class="formulario-input" type="text" placeholder="Segundo apellido:" name="apellido2"
                        value="<?php echo $apellido2 ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Departamento:</label>
                        <select class="formulario-input formulario-input-select" name="departamento">
                            <option value="">--Seleccionar--</option>
                            <option value="1">OFICINA</option>
                            <option value="2">DIBUJO</option>
                            <option value="5">TECNICO</option>
                            <option value="4">CLICHES</option>
                            <option value="3">MONTAJE</option>
                        </select>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Email:</label>
                        <input class="formulario-input" type="text" placeholder="Email" name="email"
                        value="<?php echo $email ?>">
                    </div>
                    <div class="datos-formu">
                        <input class="Boton-insertar" type="submit" value="Modificar" name="modificar">
                        <input class="Boton-insertar" type="submit" value="Borrar" name="borrar">
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
