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
    <title>Cambia tu nombre</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>

<body style="background-color: #471831;">
    <?php  include ( "header.php"); ?>
    <div style="margin-top: 48px;">
        <div style="width: 900px; margin: 0 auto;">
            <ul>
                <?php echo $error; ?>
                <li style="float: left;">

                    <div class="settingsleftcontent">
                        <ul>
                            <li><a href="profile_update.php"> Editar foto perfil</a></li>
                            <li><a href="account_update.php" style="background-color: #0B810B; border-radius: 3px; color: #fff;">Cambiar nombre</a></li>
                            <li><a href="password_update.php">Password</a></li>
                            <li><a href="workedu_update.php">Trabajo y Educacion</a></li>
                            <li><a href="cbinfo_update.php">Telefono de contacto</a></li>
                            <li><a href="location_update.php">Ubicacion</a></li>
                            <li><a href="details_update.php">Detalles sobre ti</a></li>
                        </ul>
                    </div>

                    <div class="settingsleftcontent">
                        <?php include 'profilefooter.php'; ?>
                    </div>
                </li>
                <li style="float: right;">
                    <div class="uiaccountstyle">
                        <form action="#" method="post">
                            <h2>
                                <p>Cambia tu nombre: </p>
                            </h2><br>
                            Nombre completo: <br><input type="text" name="fname" id="fname" class="placeholder" size="30" value="<?php echo $db_firstname; ?>"> <br><br>
                            <input type="submit" name="cambiarNombre" id="updateinfo" class="confirmSubmit" value="Cambiar Info">&nbsp;&nbsp;
                            <input type="submit" name="cancel" value="Cancelar" title="Cancelar" class="cancelSubmit"> <br>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
