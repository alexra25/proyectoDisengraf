<?php
    include "../sesion.php";
    include "../Resources/conexion.php";

    // consultar todos los departamentos
    $consulta_departamentos = "SELECT * FROM departamentos";
    $con = new Conexion();
    $resultadoDepartamentos = $con->queryAll($consulta_departamentos);

    $titulo_pagina = "Productos";
    $departamento = "none";

    //consultas para mostrar las tablas por filtros
    $consulta = "SELECT productos.*, categorias.nombre AS nombre_categoria,departamentos.departamento FROM productos
             INNER JOIN categorias ON productos.id_categoria = categorias.id
             INNER JOIN departamentos ON productos.id_departamento = departamentos.id";
    $con = new Conexion();
    $resultado = $con->queryAll($consulta);

    if ($_GET) {
        $departamento = $_GET['departamento'];
        $consulta2 = "SELECT productos.*, categorias.nombre AS nombre_categoria,departamentos.departamento FROM productos
        INNER JOIN categorias ON productos.id_categoria = categorias.id
        INNER JOIN departamentos ON productos.id_departamento = departamentos.id
        WHERE productos.id_departamento = $departamento";
        $con = new Conexion();
        $resultado = $con->queryAll($consulta2);

        $consulta3 = "SELECT departamento FROM departamentos WHERE id = $departamento";
        $con = new Conexion();
        $resultado2 = $con->queryAll($consulta3);
        $depa=$resultado2[0];
        if ($depa) {
            $titulo_pagina = "Productos de " . $depa['departamento'];
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
                    <h2 class="titulo-paginas-h2"><?php echo $titulo_pagina ?></h2>
                </div>
                
                <div class="botones-departamentos">
                <a class="boton-departamento <?php echo $departamento == 'none' ? 'boton-departamento-seleccionado': '';?>" href="productos.php">Todos</a>
                <?php foreach ($resultadoDepartamentos as $depar){ ?> 
                    <a class="boton-departamento <?php echo $departamento == $depar['id'] ? 'boton-departamento-seleccionado': '';?>" 
                    href="productos.php?departamento=<?php echo $depar['id']?>"><?php echo $depar['departamento']?></a>
                <?php } ?>
                    <?php if (intval($id_rol) == 1 || intval($id_rol) == 2): ?>
                        <a class="boton-añadir" href="nuevo-producto.php">
                            <div class="boton-departamento">Añadir</div>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="bloque-tabla">

                <?php if(count($resultado) == 0): ?>
                    <p class="mensaje-informacion">No se han encontrado resultados</p>
                <?php else :?>
                    <table class="rounded-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Departamento</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultado as $producto){ ?>
                                <tr class="categoria-cell" data-id="<?php echo $producto['id']; ?>">
                                    <td>
                                        <?php echo $producto['nombre']; ?>
                                    </td>
                                    <td>
                                        <?php echo $producto['nombre_categoria']; ?>
                                    </td>
                                    <td>
                                        <?php echo $producto['departamento']; ?>
                                    </td>
                                    <td>
                                        <?php echo $producto['cantidad']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php endif;?>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/clickProductos.js"></script>
</body>
<script src="../js/menu-nav.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/submenu.js"></script>

</html>
