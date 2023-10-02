<?php
    include "../sesion.php";
    include "../Resources/conexion.php";

    $errores = [];
    
        $consulta = "SELECT registro.*,
        productos.nombre AS nombre_producto,
        categorias.nombre AS nombre_categoria,
        usuarios.nombre AS nombre_usuario,
        usuarios.apellido1,
        usuarios.id_departamento,
        accion.nombre_accion
        FROM registro
        LEFT JOIN productos ON registro.id_producto = productos.id
        LEFT JOIN categorias ON registro.id_categoria = categorias.id
        INNER JOIN usuarios ON registro.id_usuario = usuarios.id
        INNER JOIN accion ON registro.id_accion = accion.id";
    $con = new Conexion();
    $resultadoConsulta = $con->queryAll($consulta);

    $consulta2 = "SELECT usuarios.*, departamentos.departamento
                    FROM usuarios
                    INNER JOIN departamentos ON usuarios.id_departamento = departamentos.id";
    $con = new Conexion();
    $resultadoConsulta2 = $con->queryAll($consulta2);
    $nomDepa = $resultadoConsulta2[0];

    if (isset($_POST['orden'])) {
        if (isset($_POST['seleccionados'])) {
            $seleccionados = implode(',', $_POST['seleccionados']);
            header("Location: nueva-orden.php?seleccionados=$seleccionados");
            exit();
        } else {
            $errores[] = "Ningún producto seleccionado.";
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
                    <h2 class="titulo-paginas-h2">REGISTRO</h2>
                </div>
                <div class="bloque-tabla">
                    <?php if(count($resultadoConsulta) == 0): ?>
                        <p class="mensaje-informacion">No se han encontrado registros</p>
                    <?php else :?>
                        <table class="rounded-table">
                            <thead>
                                <tr>
                                    <th>Solicitante</th>
                                    <th>Departamento</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                    <th>Producto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoConsulta as $productos){ ?>
                                    <?php 
                                        $timestamp = strtotime($productos['fecha']);

                                        // Formatea el timestamp en el nuevo formato
                                        $fechaFormateada = date("d-m-Y H:i", $timestamp);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php  echo $productos["nombre_usuario"] . " " .$productos["apellido1"]; ?>
                                        </td>

                                            <td>
                                                <?php  echo $nomDepa['departamento']; ?>
                                            </td>
                                
                                        <td>
                                            <?php echo $fechaFormateada; ?>
                                        </td>
                                        <td>
                                        <?php  echo $productos['nombre_accion']; ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if(isset($productos['id_producto'])){
                                                echo  $productos['nombre_producto'] ;
                                                }else{
                                                    echo  $productos['nombre_categoria'];
                                                }
                                            ?>
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

</body>
    <script src="../js/menu-nav.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/submenu.js"></script>
</html>
