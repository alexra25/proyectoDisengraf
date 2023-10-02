<?php 
include "sesion.php";
include "Resources/conexion.php";
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
    <!-- Menú desplegable -->
    <div class="menu-overlay" id="menuOverlay">
        <nav class="menu">
            <ul>
                <li>
                    <p class="titu-submenu toggle-link">&nbsp; &nbsp; CONTROL DE STOCK</p>
                    <ul class="submenu">
                        <li><a href="Almacen/categorias.php">Categorias</a></li>
                        <li><a href="Almacen/productos.php">Productos</a></li>
                        <li><a href="Almacen/notificaciones.php">Notificaciones</a></li>
                        <li><a href="Almacen/seguimiento.php">Seguimiento</a></li>
                        <li><a href="Almacen/Registro.php">Registro</a></li>
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

    <main>
        <div class="contenido-main">
            <div class="contenido-principal">
                <div class="bloque-botones">
                    
                </div>
            </div>
        </div>
    </main>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/menu-nav.js"></script>
    <script src="js/submenu.js"></script>
</html>
