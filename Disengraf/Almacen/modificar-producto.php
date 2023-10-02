<?php 
include "../sesion.php";
include "../Resources/conexion.php";

$consulta_categorias = "SELECT * FROM Categorias";
$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta_categorias);
$nom_categoria = $resultadoConsulta[0];
$nombre_categoria = $nom_categoria['nombre'];

$consulta_departamentos = "SELECT * FROM departamentos";
$con = new Conexion();
$resultadoConsulta2 = $con->queryAll($consulta_departamentos);

$id = $_GET['id'];

$consulta_cantidades ="SELECT SUM(pendiente_entrega) AS suma_pendiente_entrega
FROM seguimiento
WHERE id_producto = $id;";

$con = new Conexion();
$resultadoConsulta3 = $con->queryAll($consulta_cantidades);
$resultado_cantidades = $resultadoConsulta3[0];

$consulta = "SELECT * FROM productos WHERE id = $id";
$con = new Conexion();
$resultadoConsulta4 = $con->queryAll($consulta);
$producto = $resultadoConsulta4[0];

$state = 0;

$menu_confirmacion = false;

$pagina = 'MODIFICAR PRODUCTO';

if (isset($_POST['confirmar-borrar'])) {
    $id_borrar = $id;
    $consulta2 = "DELETE FROM productos WHERE id = $id_borrar";
    $con = new Conexion();
    $resultadoConsulta5 = $con->query($consulta2);
    $menu_confirmacion = false;

    /*if ($resultados) {
        //setRegistro($nombre, 6, $id_usuario, $conn);

    } else {
        echo "Error al eliminar la categoría: " . mysqli_error($conn);
    }*/
}
if (isset($_POST['cancelar-borrar'])) {
    $menu_confirmacion = false;
}

if (isset($_POST['confirmacion'])) {
    $menu_confirmacion = true;
}

if($menu_confirmacion){
    $titulo_pagina = "ELIMINAR PRODUCTO";

}else{
    $titulo_pagina = "MODIFICAR PRODUCTO";
}

$nombre_producto = $producto['nombre'];
$id_categoria = $producto['id_categoria'];
$id_departamento = $producto['id_departamento'];
$stock_producto = $producto['stock_min'];
$cantidad_producto = $producto['cantidad'];
$errores=[];

if (isset($_POST['modificar'])) {
    $id_modificar = $id;
    $nombre_producto = $_POST['nombre'];
    $id_categoria = $_POST['id_categoria'];
    $id_departamento = $_POST['id_departamento'];
    $stock_producto = $_POST['stock_min'];
    $cantidad_producto = $_POST['cantidad'];

    if (!$nombre_producto) {
        $errores[] = "Debes añadir un nombre";
    }

    if (!$id_categoria) {
        $errores[] = "Debes añadir una categoria";
    }

    if (!$id_departamento) {
        $errores[] = "Debes añadir un departamento";
    }

    if (!$cantidad_producto) {
        $errores[] = "Debes añadir una cantidad";
    }

    if (!$stock_producto) {
        $errores[] = "Debes añadir una cantidad de stock minimo";
    }

    if (empty($errores)) {
        $consulta3 = "UPDATE productos SET nombre = '$nombre_producto', id_categoria = '$id_categoria', stock_min ='$stock_producto', cantidad ='$cantidad_producto' WHERE id = $id_modificar";
        $con = new Conexion();
        $resultadoConsulta6 = $con->query($consulta3);
        $state = 2;

        /*if ($resultados) {
            setRegistro($nombre, 5, $id_usuario,$id_categoria, $conn);

        } else {
            echo "Error al eliminar la categoría: " . mysqli_error($conn);
        }*/
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
                    <h2 class="titulo-paginas-h2"><?php echo $titulo_pagina;?></h2>
                </div>
                <form class="formulario" method="post">
                    <div class="datos-formu">
                        <!-- Reproduccion de errores en pantalla -->
                        <?php foreach ($errores as $error): ?>
                            <div class="alerta error">
                                <?php echo $error; ?>
                            </div>
                        <?php endforeach; ?>

                        <!-- Reproduccion de alerta satisfactoria -->
                        <?php if (intval($state) === 2): ?>
                            <div class="alerta succes">
                                <?php echo "Producto modificado correctamente"; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="datos-formu">
                        <?php if ($menu_confirmacion): ?>               
                            <p style="color: white;">¿Seguro que quieres eliminar el producto <span><?php echo $nombre_producto?></span>?</p>
                            <input class="Boton-insertar-input" type="submit" value="No" name="cancelar-borrar">
                            <input class="Boton-insertar-input" type="submit" value="Borrar" name="confirmar-borrar">
                        <?php else: ?>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Nombre:</label>
                        <input class="formulario-input" type="text" placeholder="Nombre Producto" name="nombre" value="<?php echo $nombre_producto ?>">
                    </div>

                    <div class="datos-formu">
                        <label class="formulario-label">Categoria:</label>
                        <select class="formulario-input formulario-input-select" name="id_categoria">
                            <option value="">--Seleccionar--</option>
                            <?php foreach ($resultadoConsulta as $categoria){ ?>
                                <option <?php echo $id_categoria === $categoria['id'] ? 'selected' : ''; ?> value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Departamento:</label>
                        <select class="formulario-input formulario-input-select" name="id_departamento">
                            <option value="">--Seleccionar--</option>
                            <?php foreach ($resultadoConsulta2 as $departamento){ ?>
                                <option <?php echo $id_departamento === $departamento['id'] ? 'selected' : ''; ?> value="<?php echo $departamento['id']; ?>"><?php echo $departamento['departamento']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Stock Min:</label>
                        <input class="formulario-input" type="number" placeholder="Stock minimo del Producto" name="stock_min" value="<?php echo $stock_producto ?>">
                    </div>
                    <div class="datos-formu">
                        <label class="formulario-label">Cantidad:</label>
                        <input class="formulario-input" type="number" placeholder="Cantidad del Producto" name="cantidad" value="<?php echo $cantidad_producto ?>">
                    </div>
                    <div class="datos-formu">
                        <input class="Boton-insertar" type="submit" value="Borrar" name="confirmacion">
                        <input class="Boton-insertar" type="submit" value="Modificar" name="modificar">
                        <a class="contenedor-boton-volver" href="productos.php">
                            <div class="Boton-volver">Volver</div>
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/click.js"></script>
</body>
    <script src="../js/menu-nav.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/submenu.js"></script>
</html>