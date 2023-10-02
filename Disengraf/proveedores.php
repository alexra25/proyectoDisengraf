<?php
include "sesion.php";
include "Resources/conexion.php";
 
$consulta = "SELECT * FROM proveedores"; 

$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta);
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
                                    <li><a href="Almacen/categorias.php">Categorias</a></li>
                                    <li><a href="Almacen/productos.php">Productos</a></li>
                                    <li><a href="Almacen/notificaciones.php">Notificaciones</a></li>
                                    <li><a href="Almacen/seguimiento.php">Seguimiento</a></li>
                                    <li><a href="Almacen/Registro.php">Registro</a></li>
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
                    <h2 class="titulo-paginas-h2">Proveedores</h2>
                </div>
                <div class="boton-añadir">
                    <a class="quita-borde" href="nuevo-proveedor.php"><button class="boton-añadir-general">Añadir</button></a>
                </div>
                <div class="bloque-tabla">
                    <table class="rounded-table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Telegono</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultadoConsulta as $proveedores){?>
                                <tr class="categoria-cell" data-id="<?php echo $proveedores['id']; ?>">
                                    <td><?php echo $proveedores['id']; ?></td>
                                    <td><?php echo $proveedores['proveedor']; ?></td>
                                    <td><?php echo $proveedores['direccion'];?></td>
                                    <td><?php echo $proveedores['telefono']; ?></td>
                                    <td><?php echo $proveedores['correo']; ?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="js/clickProveedores.js"></script>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/menu-nav.js"></script>
    <script src="js/submenu.js"></script>
</html>
