<?php 
include "../sesion.php";
include "../Resources/conexion.php";

$seleccionados = $_GET['seleccionados'];
$errores = [];
$idArray = explode(',', $seleccionados);
$idArray = array_map('intval', $idArray);
$ids = implode(',', $idArray);

//$consulta = "SELECT * FROM productos WHERE id IN ($ids)";
$consulta = "SELECT productos.*, categorias.nombre AS nombre_categoria FROM productos
            INNER JOIN categorias ON productos.id_categoria = categorias.id
            WHERE productos.id IN ($ids)";

$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta);

if (isset($_POST['solicitar'])) {
    $cantidades = $_POST['cantidad'];
    $productos = $_POST['productos'];
    $estados = $_POST['estados'];
    

    if (isset($_POST['cantidad'])) {
        for ($i = 0; $i < count($cantidades); $i++) {
            $id_producto = $productos[$i];
            $cantidad_solicitada = $cantidades[$i];
            $id_estado = $estados[$i];
            $pendiente_entrega = $cantidad_solicitada;

            if($id_estado == 2){
                $id_estado_producto = 3;
                $consulta2 = "UPDATE productos SET id_estado = '$id_estado_producto' WHERE id = $id_producto";
                $con = new Conexion();
                $resultadoConsulta2 = $con->query($consulta2);
            }
                
            // Insertar en la tabla seguimiento
            $id_estado = 3;

            $consulta3 = "INSERT INTO seguimiento (cantidad, id_usuario, id_producto, id_estado, pendiente_entrega)
                        VALUES ('$cantidad_solicitada', '$id_usuario', '$id_producto', '$id_estado', '$pendiente_entrega')";
                            
            $con = new Conexion();
            $resultadoConsulta3 = $con->query($consulta3);
        }

    }

        if ($resultadoConsulta3) {
            //setRegistro($$id_estado, 7, $id_usuario, $id_producto, $id_categoria, $conn);
            header("Location: seguimiento.php");
        }else{
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
                    <h2 class="titulo-paginas-h2">NUEVA ORDEN DE COMPRAS</h2>
                </div>
                <form method="post">
                <div class="bloque-tabla">
                    <table class="rounded-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Stock</th>
                                <th class="tama-campos">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultadoConsulta as $productos){ ?>
                                <tr>
                                    <td>
                                        <?php echo $productos['nombre']; ?>
                                    </td>

                                    <td>
                                        <?php echo $productos['nombre_categoria']; ?>
                                    </td>

                                    <td class="tama-campos">
                                        <?php echo $productos['cantidad']; ?>
                                    </td>

                                    <td>
                                        <input class="formulario-input" type="number" value="1" min="0" name="cantidad[]">
                                        <input type="hidden" name="productos[]" value="<?php echo $productos['id'] ?>">
                                        <input type="hidden" name="estados[]" value="<?php echo $productos['id_estado'] ?>">
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>
            <div class="datos-formu">
                <input class="Boton-insertar" type="submit" value="Solicitar" name="solicitar">
            </div>
            
            </div>
        </div>
    </main>
</body>
<script src="../js/menu-nav.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/submenu.js"></script>

</html>