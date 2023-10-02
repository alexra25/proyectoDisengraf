<?php 
include "../sesion.php";
include "../Resources/conexion.php";

$id = $_GET['id'];

$consulta_producto = "SELECT * FROM productos WHERE id = $id";
$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta_producto);
$producto =$resultadoConsulta[0];

$consulta_proveedor_producto = "SELECT prodProveedores.*, 
prodProveedores.id AS id_registro,
proveedores.*
FROM prodProveedores
INNER JOIN proveedores ON prodProveedores.id_proveedor = proveedores.id
INNER JOIN productos ON prodProveedores.id_producto = productos.id
WHERE productos.id = $id";
$con = new Conexion();
$resultadoConsulta5 = $con->queryAll($consulta_proveedor_producto);

$consulta_proveedores = "SELECT prodProveedores.*, 
             proveedores.*
             FROM prodProveedores
             INNER JOIN proveedores ON prodProveedores.id_proveedor = proveedores.id
             INNER JOIN productos ON prodProveedores.id_producto = productos.id
             WHERE productos.id = $id";

$con = new Conexion();
$resultadoConsulta2 = $con->queryAll($consulta_proveedores);

$consulta_proveedores2 = "SELECT * FROM proveedores";

$con = new Conexion();
$resultadoConsulta3 = $con->queryAll($consulta_proveedores2);

if (isset($_POST['quitar'])) {
    $id_producto_proveedor = $_POST['id_producto_proveedor'];
    $consulta_eliminar = "DELETE FROM prodProveedores WHERE id = $id_producto_proveedor";
    $con = new Conexion();
    $resultadoConsulta4 = $con->query($consulta_eliminar);
    header("Location: proveedor-producto.php?id=" . $id);
}

if (isset($_POST['agregar'])) {
    // Si se hizo clic en el botón "añadir", agrega un registro en la tabla prodProveedores
    $id_proveedor = $_POST['id_proveedor'];

    // Verifica si el registro ya existe antes de agregarlo
    $consulta_existencia = "SELECT * FROM prodProveedores WHERE id_producto = $id AND id_proveedor = $id_proveedor";
    $con = new Conexion();
    $resultadoConsulta6 = $con->queryAll($consulta_existencia);

    if (count($resultadoConsulta6) == 0) {
        // Si el registro no existe, agrégalo
        $consulta_agregar = "INSERT INTO prodProveedores (id_producto, id_proveedor) VALUES ($id, $id_proveedor)";
        $con = new Conexion();
        $resultadoConsulta6 = $con->query($consulta_agregar);
        header("Location: proveedor-producto.php?id=" . $id);
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
                    <h2 class="titulo-paginas-h2"><?php echo "Poveedores - " . $producto['nombre']; ?></h2>
                </div>
                <div class="boton-añadir">
                    <a class="quitar-borde" href="producto-cantidad.php?id=<?php echo $id ?>">
                        <button class="boton-añadir-general">Volver</button>
                    </a>
                </div>
                <!-- proveedores producto -->
                <div class="bloque-tabla">
                    <table class="rounded-table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>telefono</th>
                                <th>Email</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultadoConsulta5 as $proveedores_producto){ ?>
                                <form method="post">
                                    <tr>
                                        <td><?php echo $proveedores_producto['id']; ?></td>
                                        <td><?php echo $proveedores_producto['proveedor']; ?></td>
                                        <td><?php echo $proveedores_producto['direccion'];?></td>
                                        <td><?php echo $proveedores_producto['telefono']; ?></td>
                                        <td><?php echo $proveedores_producto['correo']; ?></td>
                                        <td><button type="submit" name="quitar">Quitar</button></td>
                                        <input type="hidden" name="id_producto_proveedor" value="<?php echo $proveedores_producto['id_registro'] ?>">
                                    </tr>
                                </form>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <!-- lista de proveedores -->
                <div class="titulo-paginas">
                    <h2 class="titulo-paginas-h2">Lista de Proveedores</h2>
                </div>
                <div class="bloque-tabla">
                    <table class="rounded-table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>telefono</th>
                                <th>Email</th>
                                <th>Añadir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultadoConsulta3 as $proveedores){ ?>
                                <form method="post">
                                    <tr>
                                        <td><?php echo $proveedores['id']; ?></td>
                                        <td><?php echo $proveedores['proveedor']; ?></td>
                                        <td><?php echo $proveedores['direccion'];?></td>
                                        <td><?php echo $proveedores['telefono']; ?></td>
                                        <td><?php echo $proveedores['correo']; ?></td>
                                        <td><button type="submit" name="agregar">Añadir</button></td>
                                        <input type="hidden" name="id_proveedor" value="<?php echo $proveedores['id'] ?>">
                                    </tr>
                                </form>
                            <?php } ?>
                        </tbody>
                    </table>
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