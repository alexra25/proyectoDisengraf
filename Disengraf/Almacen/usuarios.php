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
                                <p class="titu-submenu">&nbsp; &nbsp; CONTROL DE STOCK</p>
                                <ul class="submenu">
                                    <li><a href="categorias.php">Categorias</a></li>
                                    <li><a href="productos.php">Productos</a></li>
                                    <li><a href="notificaciones.php">Notificaciones</a></li>
                                    <li><a href="seguimiento.php">Seguimiento</a></li>
                                    <li><a href="Registro.php">Registro</a></li>
                                    <li><a href="Usuarios.php">Usuarios</a></li>
                                    <li><a href="proveedores.php">Proveedores</a></li>
                                </ul>
                            </li>
                            <li>
                                <p class="titu-submenu">&nbsp; &nbsp; FICHAS TÉCNICAS</p>
                                <ul class="submenu">
                                    
                                </ul>
                            </li>
                            <li>
                                <p class="titu-submenu">&nbsp; &nbsp; BUSCAR PEDIDO</p>
                                <ul class="submenu">
                                    
                                </ul>
                            </li>
                            <li>
                                <p class="titu-submenu">&nbsp; &nbsp; PRODUCCIÓN</p>
                                <ul class="submenu">
                                    
                                </ul>
                            </li>
                            <li>
                                <p class="titu-submenu">&nbsp; &nbsp; CORREO</p>
                                <ul class="submenu">
                                    
                                </ul>
                            </li>
                            <li>
                                <p class="titu-submenu">&nbsp; &nbsp; LEN</p>
                                <ul class="submenu">
                                    
                                </ul>
                            </li>
                            <li>
                                <p class="titu-submenu">&nbsp; &nbsp; DPTO. TÉCNICO</p>
                                <ul class="submenu">
                                    
                                </ul>
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
                    <h2 class="titulo-paginas-h2">Usuarios</h2>
                </div>
                <div class="boton-añadir">
                    <button class="boton-añadir-categoria">Añadir</button>
                </div>
                <div class="bloque-tabla">
                    <table class="rounded-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Departamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Alejandro</td>
                                <td>ruiz alacid</td>
                                <td>a.ruiz</td>
                                <td>a.ruiz@disengraf.com</td>
                                <td>Técnico</td>
                            </tr>
                            <tr>
                                <td>Francisco</td>
                                <td>Escamez</td>
                                <td>fj.escamez</td>
                                <td>f.escamez@disengraf.com</td>
                                <td>Oficina</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>
<script src="../js/menu-nav.js"></script>
</html>
