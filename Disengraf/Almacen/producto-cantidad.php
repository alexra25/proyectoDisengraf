<?php 
include "../sesion.php";
include "../Resources/conexion.php";

$id = $_GET['id'];

$consulta_proveedor_producto = "SELECT prodProveedores.*, 
proveedores.*
FROM prodProveedores
INNER JOIN proveedores ON prodProveedores.id_proveedor = proveedores.id
INNER JOIN productos ON prodProveedores.id_producto = productos.id
WHERE productos.id = $id";
$con = new Conexion();
$resultadoProveedor = $con->queryAll($consulta_proveedor_producto);

$consulta = "SELECT productos.*, 
             categorias.nombre AS nombre_categoria, 
             estados.nombre_estado AS nombre_estado, 
             departamentos.departamento AS nombre_departamento
             FROM productos
             INNER JOIN categorias ON productos.id_categoria = categorias.id
             INNER JOIN estados ON productos.id_estado = estados.id
             INNER JOIN departamentos ON productos.id_departamento = departamentos.id
             WHERE productos.id = $id";

$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta);

$producto = $resultadoConsulta[0];

$state = 0;

$nombre_producto = $producto['nombre'];
$categoria_producto = $producto['nombre_categoria'];
$cantidad_producto = $producto['cantidad'];
$nombre_estado = $producto['nombre_estado'];
$id_proveedor = $producto['id_proveedor'];
$nombre_departamento = $producto['nombre_departamento'];
$stock_min = $producto['stock_min'];
$id_estado = $producto['id_estado'];


if (isset($_POST['actualizar'])) {

    $id_modificar = $id;
    $cantidad_descontar = $_POST['descontar'];

    if ($cantidad_descontar > 0) {
        if (($cantidad_producto - $cantidad_descontar) < 0) {
            $state = 1;
        } else {
            $cantidad_producto -= $cantidad_descontar;

            if ($cantidad_producto <= $stock_min && $id_estado == 1) {
                $id_estado = 2;
                $consulta_descontar = "UPDATE productos SET cantidad ='$cantidad_producto', id_estado = '$id_estado' WHERE id = $id_modificar";
            } else {
                $consulta_descontar = "UPDATE productos SET cantidad ='$cantidad_producto' WHERE id = $id_modificar";
            }

            $con = new Conexion();
            $resultadoDescontar = $con->query($consulta_descontar);
            $state = 2;
        }
    } else {
        $state = 3;
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
                    <h2 class="titulo-paginas-h2"><?php echo strtoupper($nombre_producto . " - " . $categoria_producto); ?></h2>
                </div>
                <form class="formulario" method="post">
                    <div class="datos-formu">
                        <?php if (intval($state) === 1): ?>
                            <div class="alerta error">
                                <?php echo "No se puede descontar"; ?>
                            </div>
                        <?php elseif (intval($state) === 2): ?>
                            <div class="alerta succes">
                                <?php echo "Cantidad descontada"; ?>
                            </div>
                        <?php elseif (intval($state) === 3): ?>
                            <div class="alerta error">
                                <?php echo "No se ha indicado ninguna cantidad"; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Estado:</label>
                        <input class="formulario-input" type="text" placeholder="Estado" name="estado" value="<?php echo $nombre_estado ?>"disabled>
                    </div>

                    <div class="datos-formu">
                        <label class="formulario-label">Departamento:</label>
                        <input class="formulario-input" type="text" placeholder="Departamento" name="departamento" value="<?php echo $nombre_departamento ?>"disabled>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Stock Mínimo:</label>
                        <input class="formulario-input" type="text" placeholder="Stock_min" name="stock_min" value="<?php echo $stock_min ?>"disabled>

                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Stock Actual:</label>
                        <input class="formulario-input" type="number" placeholder="Stock Actual" name="stock_actual" value="<?php echo $cantidad_producto ?>"disabled>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Descontar:</label>
                        <input class="formulario-input" type="number" name="descontar" placeholder="0" min="0">
                    </div>
                    <div class="datos-formu">
                        <a class="quita-borde" href="modificar-producto.php?id=<?php echo $producto['id'] ?>">
                            <div class="Boton-insertar">Incidencia</div>
                        </a>
                        <?php if(intval($id_rol) == 1 || intval($id_rol) == 2 || intval($id_rol) == 3):?>
                            <a class="quita-borde" href="modificar-producto.php?id=<?php echo $producto['id'] ?>">
                                <div class="Boton-insertar">Modificar</div>
                            </a>
                        <?php endif; ?>
                                
                        <input class="Boton-insertar-input" type="submit" value="Actualizar" name="actualizar">
                        <a class="contenedor-boton-volver" href="productos.php">
                            <div class="Boton-volver">Volver</div>
                        </a>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $producto['id'] ?>">
                    <input type="hidden" name="stock_min" value="<?php echo $producto['stock_min'] ?>">
                    <input type="hidden" name="id_estado" value="<?php echo $producto['id_estado'] ?>">
                </form>
                <div class="bloque-botones">
                    <div class="titulo-paginas">
                        <h2 class="titulo-paginas-h2">PROVEEDORES</h2>
                    </div>
                    <div class="bloque-tabla">
                        <table class="rounded-table">
                            <thead>
                                <tr>
                                    <th>Proveedor</th>
                                    <th>Contacto</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoProveedor as $proveedor){ ?>
                                    <tr>
                                        <td>
                                            <?php echo $proveedor['proveedor']; ?>
                                        </td>

                                        <td>
                                            <?php echo $proveedor['telefono']; ?>
                                        </td>

                                        <td>
                                            <?php echo $proveedor['correo']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="datos-formu">
                        <a class="quita-borde" href="proveedor-producto.php?id=<?php echo $id ?>">
                            <div class="Boton-insertar">Modificar</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/click.js"></script>
</body>
    <script src="../js/menu-nav.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/submenu.js"></script>
</html>