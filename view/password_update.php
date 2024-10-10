<?php

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) 
{
	header('location: signin.php');
}
else 
{
	$user = $_SESSION['user_login'];
    
    require_once("../controller/MasterController.php");
    $gets=new MasterController();
    $res=$gets->actualizar();
                
    include_once $res;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cambiar Password</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>

<body style="background-color: #471831;">

    <?php 
    include ( "header.php");

?>
    <div style="margin-top: 48px;">
        <?php echo $error; ?>
        <div style="width: 900px; margin: 0 auto;">
            <ul>
                <li style="float: left;">
                    <div class="settingsleftcontent">
                        <ul>
                            <li><a href="profile_update.php"> Editar foto perfil</a></li>
                            <li><a href="account_update.php">Cambiar nombre</a></li>
                            <li><a href="password_update.php" style="background-color: #0B810B; border-radius: 3px; color: #fff;">Password</a></li>
                            <li><a href="workedu_update.php">Trabajo y Educacion</a></li>
                            <li><a href="cbinfo_update.php">Telefono de contacto</a></li>
                            <li><a href="location_update.php">Ubicacion</a></li>
                            <li><a href="details_update.php">Detalles sobre ti</a></li>
                        </ul>
                    </div>
                    <div class="settingsleftcontent" style="background-color: #fff;">

                        <?php include 'profilefooter.php'; ?>
                    </div>
                </li>
                <li style="float: right;">
                    <form action="#" method="post">
                        <div class="uiaccountstyle">
                            <h2>
                                <p>Cambiar password</p>
                            </h2>
                            <br>
                            Password anterior:
                            <br>
                            <input type="password" name="passwordantes" class="placeholder" size="30">
                            <br><br>
                            Nuevo Password:
                            <br>
                            <input type="password" name="newpassword" class="placeholder" size="30">
                            <br><br>
                            Repite nuevo Password:
                            <br>
                            <input type="password" name="newpassword2" class="placeholder" size="30">
                            <br><br>
                            <hr>
                            <br>
                            <input type="submit" name="cambiar" id="senddata" class="confirmSubmit" value="Cambiar Password">&nbsp;&nbsp;
                            <input type="submit" name="cancel" value="Cancelar" title="Cancelar" class="cancelSubmit">
                            <br>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
