<?php
include "../sesion.php";
include "../Resources/conexion.php";
 

// consultar todas las categorias
$consulta_categorias = "SELECT * FROM Categorias";
$con = new Conexion();
$resultadoConsulta = $con->queryAll($consulta_categorias);

$consulta_departamentos = "SELECT * FROM departamentos";
$con = new Conexion();
$resultadoConsulta2 = $con->queryAll($consulta_departamentos);

$consulta_proveedores = "SELECT * FROM proveedores";
$con = new Conexion();
$resultadoConsulta3 = $con->queryAll($consulta_proveedores);


// declarar variables de value
$errores = [];
$nombre_producto = '';
$id_categoria = '';
$id_departamento = '';
$cantidad_producto = '';
$stock_min_producto = '';
$pagina = 'NUEVO-PRODUCTO';
$id_estado = 1;
$state=0;

if (isset($_POST['insertar'])) { // Verifica si el formulario se ha enviado

    // Recogemos los valores donde los almacenamos y sanitizamos
    $nombre_producto = $_POST['nombre'];
    $id_categoria = $_POST['id_categoria'];
    $id_departamento = $_POST['id_departamento'];
    $cantidad_producto = $_POST['cantidad'];
    $stock_min_producto = $_POST['stock_min'];

    // Verificacion de formulario
    if(!$nombre_producto){
        $errores[] = "Debes añadir un nombre";
    }

    if(!$id_categoria){
        $errores[] = "Debes añadir una categoria";
    }

    if(!$id_departamento){
        $errores[] = "Debes añadir un departamento";
    }

    if(!$cantidad_producto){
        $errores[] = "Debes añadir una cantidad";
    }

    if(!$stock_min_producto){
        $errores[] = "Debes añadir una cantidad de stock minimo";
    }

    // revisar el array de errores y si esta vacio lo guarda en la base de datos
    if(empty($errores)){
        $consulta = "INSERT INTO productos (cantidad,nombre,stock_min,id_categoria,id_estado, id_departamento) values ('$cantidad_producto','$nombre_producto','$stock_min_producto','$id_categoria', '$id_estado', '$id_departamento')";
        $con = new Conexion();
        $resultadoConsulta4 = $con->query($consulta);
        $state = 2;
        /*$id_insertado = mysqli_insert_id($conn);

        if ($resultados) {
            setRegistro($nombre_producto, 4, $id_usuario,$id_categoria, $conn);

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
                    <h2 class="titulo-paginas-h2"><?php echo $pagina ?></h2>
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
                                <?php echo "Producto insertado correctamente"; ?>
                            </div>
                        <?php endif; ?>
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
                        <input class="Boton-insertar" type="submit" value="Insertar" name="insertar">
                        <a class="contenedor-boton-volver" href="productos.php">
                            <div class="Boton-volver">Volver</div>
                        </a>
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
