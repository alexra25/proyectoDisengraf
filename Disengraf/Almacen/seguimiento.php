<?php 
include "../sesion.php";
include "../Resources/conexion.php";

$errores = [];

// Consulta para registros con id_estado igual a 2
$consulta3 = "SELECT seguimiento.*, 
            productos.nombre AS nombre_producto,
            usuarios.nombre AS nombre_usuario,
            usuarios.id_departamento,
            estados.nombre_estado

            FROM seguimiento
            INNER JOIN productos ON seguimiento.id_producto = productos.id 
            INNER JOIN usuarios ON seguimiento.id_usuario = usuarios.id
            INNER JOIN estados ON seguimiento.id_estado = estados.id
            WHERE seguimiento.id_estado = 3
            ORDER BY seguimiento.id DESC";
$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta3);

// Consulta para registros con id_estado igual a 4
$consulta4 = "SELECT seguimiento.*, 
            productos.nombre AS nombre_producto,
            usuarios.nombre AS nombre_usuario,
            usuarios.id_departamento,
            estados.nombre_estado

            FROM seguimiento
            INNER JOIN productos ON seguimiento.id_producto = productos.id 
            INNER JOIN usuarios ON seguimiento.id_usuario = usuarios.id
            INNER JOIN estados ON seguimiento.id_estado = estados.id
            WHERE seguimiento.id_estado = 4
            ORDER BY seguimiento.id DESC";
$con = new Conexion();
$resultadoConsulta2 = $con->queryAll($consulta4);

$consulta_departamentos = "SELECT departamento FROM departamentos";
$con = new Conexion();
$resultadoConsulta3 = $con->queryAll($consulta_departamentos);

$departamentos = $resultadoConsulta3[0];

// Verificar si hay resultados en la consulta
if (count($resultadoConsulta) > 0) {
    $mostrarTabla1 = true;
   
} else {
    $mostrarTabla1 = false;
}

// Verificar si hay resultados en la consulta 2
if (count($resultadoConsulta2) > 0) {
    $mostrarTabla2 = true;
} else {
    $mostrarTabla2 = false;
}

if (isset($_POST['orden'])) {
    if (isset($_POST['seleccionados'])) {
        $seleccionados = $_POST['seleccionados'];
        $id_estado = $_POST['id_estado'];
        $id_productos = $_POST['id_productos'];
        $id_proveedores = $_POST['id_proveedores'];
        $falta_proveedor = false;

        for ($i = 0; $i < count($id_proveedores); $i++) {
            if ($id_proveedores[$i] == '') {
                $falta_proveedor = true;
            }
        }

        if ($falta_proveedor == true) {
            $errores[] = "Hay proveedores sin definir";
        }

        for ($i = 0; $i < count($seleccionados); $i++) {
            $id_modificar = $seleccionados[$i];
            $id_producto = $id_productos[$i];
            $id_proveedor = $id_proveedores[$i];
            if ($id_estado[$i] == 3 && $falta_proveedor == false) {

                // cambiar el estado del procucto a solicitado
                $id_estado_producto = 4;
                $nuevo_estado = 4;
                $consulta4 = "UPDATE productos SET id_estado = $id_estado_producto WHERE id = $id_producto";
                $con = new Conexion();
                $resultadoConsulta4 = $con->query($consulta4);

                $consulta5 = "UPDATE seguimiento SET id_estado = $nuevo_estado WHERE id = $id_modificar";
                $con = new Conexion();
                $resultadoConsulta5 = $con->query($consulta5);

                header("Location: seguimiento.php");
                exit();

                /*if ($resultados) {
                    $nombre = "nombre ok";
                    /*setRegistro($nombre, 8, $id_usuario, $id_categoria, $id_producto, $conn);

                } else {
                    echo "Error al eliminar la categoría: ";
                }*/
            }
        }
    } else {
        $errores[] = "Ninguna solicitud seleccionada.";
    }
}

if (isset($_POST['pre_reponer'])) {
    if (isset($_POST['seleccionados'])) {
        $seleccionados = implode(',', $_POST['seleccionados']);
        header("Location: nuevo-reponer.php?seleccionados=$seleccionados");
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
                    <div class="titulo-paginas">
                        <h2 class="titulo-paginas-h2">SEGUIMIENTO</h2>
                    </div>
                    <?php if ($mostrarTabla1 == false && $mostrarTabla2 == false): ?>
                        <div class="bloque-titulo_boton">
                            <p class="mensaje-informacion">No hay solicitudes pendientes</p>
                        </div>
                    <?php endif ?>
                    <br>
                    <!-- Contenido de la página -->
                    <?php if ($mostrarTabla1): ?>
                        <div class="titulo-paginas">
                            <h2 class="subtitulo-paginas">SOLICITUDES PENDIENTES</h2>
                        </div>
                        <form method="post">
                            <div class="bloque-tabla">
                                <table class="rounded-table">
                                    <thead>
                                        <tr>
                                            <th>Solicitar</th>
                                            <th>Solicitante</th>
                                            <th>Fecha</th>
                                            <th>Departamento</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Proveedor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($resultadoConsulta as $seguimiento){ ?>
                                            
                                            <?php
                                                $id_producto = $seguimiento['id_producto']; 
                                                $consulta_proveedor_producto = "SELECT prodProveedores.*, 
                                                proveedores.*
                                                FROM prodProveedores
                                                INNER JOIN proveedores ON prodProveedores.id_proveedor = proveedores.id
                                                INNER JOIN productos ON prodProveedores.id_producto = productos.id
                                                WHERE productos.id = $id_producto";
                                                $con = new Conexion();
                                                $resultadoConsulta5 = $con->queryAll($consulta_proveedor_producto);
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="seleccionados[]" value="<?php echo $seguimiento['id']; ?>">
                                                </td>
                                                <td>
                                                    <?php echo $seguimiento['nombre_usuario']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $seguimiento['fecha']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $departamentos['departamento']; ?>
                                                </td>
                                                <td>
                                                    <?php echo "CATEGORIA " . $seguimiento['nombre_producto']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $seguimiento['cantidad']; ?>
                                                </td>
                                                <td>
                                                    <select class="select" name="id_proveedores[]">
                                                        <?php if (count($resultadoConsulta5) > 1): ?>
                                                            <option value="">Seleccionar</option>
                                                        <?php endif; ?>
                                                        <?php foreach ($resultadoConsulta5 as $proveedor){ ?>
                                                            <option value="<?php echo $proveedor['proveedor']; ?>">
                                                                <?php echo $proveedor['proveedor'];?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <input type="hidden" name="id_estado[]" value="<?php echo $seguimiento['id_estado']; ?>">
                                                <input type="hidden" name="categorias[]" value="<?php echo $seguimiento['id_categoria']; ?>">
                                                <input type="hidden" name="id_productos[]" value="<?php echo $seguimiento['id_producto']; ?>">
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="datos-formu">
                                <input class="Boton-insertar" type="submit" value="Solicitar" name="orden">
                            </div>
                        </form>
                    <?php endif; ?>                                       
                    <!------------------------------*************************------------------------------>
            
                    <!-- Contenido de la página -->
                    <?php if ($mostrarTabla2): ?>
                        <div class="titulo-paginas">
                            <h2 class="subtitulo-paginas">PENDIENTES DE ENTREGA</h2>
                        </div>
                        <form method="post">
                            <div class="bloque-tabla">
                                <table class="rounded-table">
                                    <thead>
                                        <tr>
                                            <th>Reponer</th>
                                            <th>Solicitante</th>
                                            <th>Fecha</th>
                                            <th>Departamento</th>
                                            <th>Producto</th>
                                            <th>Solicitado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($resultadoConsulta2 as $seguimiento2){ ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="seleccionados[]" value="<?php echo $seguimiento2['id']; ?>">
                                                </td>
                                                <td>
                                                    <?php echo $seguimiento2['nombre_usuario']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $seguimiento2['fecha']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $departamentos['departamento']; ?>
                                                </td>
                                                <td>
                                                    <?php echo "CATEGORIA " . $seguimiento2['nombre_producto']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $seguimiento2['pendiente_entrega']; ?>
                                                </td>

                                                <input type="hidden" name="id_estado[]" value="<?php echo $seguimiento2['id_estado']; ?>">
                                                <input type="hidden" name="cantidad[]" value="<?php echo $seguimiento2['cantidad']; ?>">
                                                <input type="hidden" name="id_producto[]" value="<?php echo $seguimiento2['id_producto']; ?>">
                                                <input type="hidden" name="cantidades_pendientes[]"
                                                    value="<?php echo $seguimiento2['pendiente_entrega']; ?>">
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="datos-formu">
                                <input class="Boton-insertar" type="submit" value="Reponer" name="pre_reponer">
                            </div>
                        </form>
                    
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
<script src="../js/menu-nav.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/submenu.js"></script>
</html>