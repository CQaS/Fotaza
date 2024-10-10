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
    <title>Telefono</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>

<body style="background-color: #471831;">

    <?php include "header.php"; ?>

    <div style="margin-top: 48px;">
        <div style="width: 900px; margin: 0 auto;">
            <?php echo $error; ?>
            <ul>
                <li style="float: left;">
                    <div class="settingsleftcontent">
                        <ul>
                            <li><a href="profile_update.php"> Editar foto perfil</a></li>
                            <li><a href="account_update.php">Cambiar nombre</a></li>
                            <li><a href="password_update.php">Password</a></li>
                            <li><a href="workedu_update.php">Trabajo y Educacion</a></li>
                            <li><a href="cbinfo_update.php" style="background-color: #0B810B; border-radius: 3px; color: #fff;">Telefono de contacto</a></li>
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
                        <form action="cbinfo_update.php" method="POST">
                            <h2>
                                <p>Telefono y Email Publico</p>
                            </h2><br>
                            Telefono:
                            <br>
                            <input type="text" name="tel" id="mobile" class="placeholder" size="43" value="<?php echo $db_mobile; ?>"> <br><br>
                            Email Publico:
                            <br>
                            <input type="email" name="pub_email" id="pub_email" class="placeholder" size="43" value="<?php echo $db_pub_email; ?>"> <br><br>
                            <input type="submit" name="sendemail" value="Actualizar Informacion" title="Update Information" class="confirmSubmit">&nbsp;&nbsp;
                            <input type="submit" name="cancel" value="Cancel" title="Cancel" class="cancelSubmit"><br>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
