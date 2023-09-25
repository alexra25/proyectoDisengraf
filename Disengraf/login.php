<?php
include "Resources/conexion.php";
$form_usuario = "";
$form_password = "";
$notificaciones = [];

if (isset($_POST["iniciar-sesion"])) {
    $form_usuario = $_POST["usuario"];
    $form_password = $_POST["password"];

    // Consulta para comprobar usuario y contraseña
    $consulta = "SELECT * FROM usuarios WHERE username = '$form_usuario' AND pasword = '$form_password'";
    $con = new Conexion();
    $resultadoConsulta = $con->queryAll($consulta);

    if ($resultadoConsulta) {
        session_start();
        $usuario = $resultadoConsulta[0];
        $_SESSION["username"] = $usuario["username"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["apellido"] = $usuario["apellido"];
        $_SESSION["id_usuario"] = $usuario["id"];
        $_SESSION["id_rol"] = $usuario["id_rol"];
        $_SESSION["id"] = session_id();
        header("Location: index.php");
        exit();

    } else {
        $notificaciones[] = "Usuario o Contraseña Incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <title>Disengraf | Login</title>
    <link rel="icon" type="image/ico" sizes="16x16 32x32 48x48" href="img/favicon.ico"/>
</head>

<body>
    <div class="contenedor">
        <main>
            <div class="login">
                <a class="login__contenedor-logo" href="https://www.disengraf.com/">
                    <img class="login__logo" src="img/LOGO-SOLO.png" alt="logo_disengraf">
                </a>

                <!-- Reproduccion de errores en pantalla -->
                <?php if(count($notificaciones) > 0){ ?>
                    <?php foreach ($notificaciones as $notificacion){ ?>
                        <div class="notificaciones">
                            <p>
                                <?php echo $notificacion; ?>
                            </p>
                        </div>
                    <?php } ?>
                <?php } ?>

                <!-- formulario login -->
                <form method="POST">
                    <div class="login__input">
                        <img class="login__icono" src="img/icon_user.png" alt="icono_usuario">
                        <input class="login__caja" type="text" name="usuario" placeholder="Usuario ID"
                            value="<?php echo $form_usuario ?>">
                    </div>
                    <div class="login__input">
                        <img class="login__icono" src="img/icon_candado.png" alt="icono_usuario">
                        <input class="login__caja" type="password" name="password" placeholder="Contraseña"
                            value="<?php echo $form_password ?>">
                    </div>
                    <div class="login__recuerdame-olvidaste">
                        <div class="login__recuerdame">
                            <input id="recuerdame" type="checkbox">
                            <label for="recuerdame">Recuérdame</label>
                        </div>
                        <a href="#">¿Olvidaste la contraseña?</a>
                    </div>
                    <input class="login-boton" type="submit" name="iniciar-sesion" value="Iniciar Sesión">
                </form>
                
            </div>
        </main>

        <footer class="footer">
            <img class="logo" src="img/logo-just.png" alt="logo-just">
            <img class="logo" src="img/logo-epson.png" alt="logo-epson">
            <img class="logo" src="img/logo-esko.png" alt="logo-esko">
            <img class="logo" src="img/logo-apple.png" alt="logo-apple">
            <img class="logo" src="img/logo-dupont-cyrel.png" alt="logo-dupont-cyrel">
            <img class="logo" src="img/logo-dupont.png" alt="logo-dupont">
            <img class="logo" src="img/logo-kodak.png" alt="logo-kodak">
        </footer>
    </div>
</body>

</html>