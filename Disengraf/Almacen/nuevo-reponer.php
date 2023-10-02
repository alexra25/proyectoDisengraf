<?php
include "../sesion.php";
include "../Resources/conexion.php";
//include "includes/registrar.php";

$seleccionados = $_GET['seleccionados'];
$errores = [];
$idArray = explode(',', $seleccionados);
$idArray = array_map('intval', $idArray);
$ids = implode(',', $idArray);

//$consulta = "SELECT * FROM productos WHERE id IN ($ids)";
$consulta = "SELECT seguimiento.*, 
            productos.nombre AS nombre_producto
            FROM seguimiento
            INNER JOIN productos ON seguimiento.id_producto = productos.id
            WHERE seguimiento.id IN ($ids)";

$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta);

if (isset($_POST['reponer'])) {
    if (isset($_POST['cantidades_recibidas'])) {
        $id_seguimientos = $idArray;
        $cantidades_recibidas = $_POST['cantidades_recibidas'];
        $id_estados = $_POST['estados'];
        $id_productos = $_POST['productos'];
        $cantidades_solicitadas = $_POST['cantidades_solicitadas'];



        for ($i = 0; $i < count($cantidades_recibidas); $i++) {
 
            $id_modificar = $id_seguimientos[$i];
            $cantidad = $cantidades_recibidas[$i];
            $cantidad_solicitada = $cantidades_solicitadas[$i];

            if ($id_estados[$i] == 4) {
                $nuevo_estado = 4;
                

                // Consulta para obtener la cantidad actual
                $query = "SELECT * FROM productos WHERE id = $id_productos[$i]";
                $con = new Conexion();
                $resultadoConsulta2 = $con->queryAll($query);
                
                
                if ($resultadoConsulta2) {
                 
                    $productoSeleccionado = $resultadoConsulta2[0];
                    $cantidadActualizada = $productoSeleccionado['cantidad'] + $cantidad;

                    // comprobar si ha venido todas las unidades solicitadas
                    if($cantidad_solicitada == $cantidad){
                        $nuevo_estado = 5;
                        $estado_producto = 1;
                        $cantidad_solicitada = 0;

                        $consulta2 = "UPDATE productos SET cantidad = $cantidadActualizada, id_estado = $estado_producto WHERE id = $id_productos[$i]";

                    }else{
                        $cantidad_solicitada -= $cantidad;
                        $consulta2 = "UPDATE productos SET cantidad = $cantidadActualizada WHERE id = $id_productos[$i]";
                    }

                    // Corregir la sintaxis de la consulta de actualización
                    $con = new Conexion();
                    $resultadoConsulta3 = $con->query($consulta2);

                    // Corregir la sintaxis de la consulta de actualización
                    $consulta3 = "UPDATE seguimiento SET id_estado = $nuevo_estado, pendiente_entrega = $cantidad_solicitada WHERE id = $id_modificar";
                    echo $consulta;
                    $con = new Conexion();
                    $resultadoConsulta4 = $con->query($consulta3);


                    if (!$resultadoConsulta4) {
                        // Manejar errores de la consulta de actualización si es necesario
                        $errores[] = "Error al actualizar el seguimiento para el ID $id_producto[$i]";
                    }

                } else {
                    // Manejar errores de la consulta de selección si es necesario
                    $errores[] = "Error al obtener la cantidad del producto con ID $id_producto[$i]";
                }

                if ($resultadoConsulta4) {
                    //setRegistro($nombre, 9, $id_usuario, $conn);
                    header("Location: seguimiento.php");
    
                } else {
                    echo "Error al eliminar la categoría: " . mysqli_error($conn);
                }

            }
        }
    } else {
        $errores[] = "Ninguna solicitud seleccionada.";
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
                    <h2 class="titulo-paginas-h2">ORDEN DE REPOSICIÓN</h2>
                </div>
                <form method="post">
                <div class="bloque-tabla">
                    <table class="rounded-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Solicitado</th>
                                <th class="tama-campos">Recibido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultadoConsulta as $productos){ ?>
                                <tr>
                                    <td>
                                        <?php echo $productos['nombre_producto']; ?>
                                    </td>

                                    <td>
                                        <?php echo $productos['pendiente_entrega']; ?>
                                    </td>

                                    <td>
                                        <input class="formulario-input" type="number" value=<?php echo $productos['pendiente_entrega']; ?> min="0" name="cantidades_recibidas[]">
                                        <input type="hidden" name="estados[]" value="<?php echo $productos['id_estado'] ?>">
                                        <input type="hidden" name="productos[]" value="<?php echo $productos['id_producto'] ?>">
                                        <input type="hidden" name="cantidades_solicitadas[]" value="<?php echo $productos['pendiente_entrega'] ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>
            <div class="datos-formu">
                <input class="Boton-insertar" type="submit" value="Reponer" name="reponer">
            </div>
            
            </div>
        </div>
    </main>
</body>
<script src="../js/menu-nav.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/submenu.js"></script>

</html>