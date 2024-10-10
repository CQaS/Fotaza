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
    <title>Editar perfil</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>

<body style="background-color: #471831;">

    <?php  include ( "header.php"); ?>


    <div style="margin-top: 48px;">
        <div style="width: 900px; margin: 0 auto;">
            <ul>
                <li>
                    <div><?php if(isset($error)){ echo $error;} ?></div>
                </li>
                <li style="float: left;">
                    <div class="settingsleftcontent">
                        <ul>
                            <li><a href="profile_update.php" style="background-color: #0B810B; border-radius: 3px; color: #fff;"> Editar foto perfil</a></li>
                            <li><a href="account_update.php">Cambiar nombre</a></li>
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
                        <h2>
                            <p>Sube tu foto de Perfil</p>
                        </h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <img src="<?php echo $profile_pic; ?>" width="82"><br>
                            <input type="file" name="upfoto" class="placeholder"><br><br>
                            <h2>
                                <p style="font-style: italic; font-size: 13px">fotos tipo: *jpg *jpeg *png *gif</p>
                            </h2><br><br>
                            <input type="submit" name="upperfil" title="Subir foto" class="confirmSubmit" value="Subir foto">&nbsp;&nbsp;
                            <input type="submit" name="cancel" value="Cancelar" title="Cancel" class="cancelSubmit"> <br>
                        </form>
                    </div>
                    <div class="uiaccountstyle">
                        <h2>
                            <p>Subir tu foto de Portada</p>
                        </h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <img src="<?php echo $cover_pic; ?>" width="110" height="55"><br>
                            <input type="file" class="placeholder" name="portada"><br><br>
                            <h2>
                                <p style="font-style: italic; font-size: 13px">fotos tipo: *jpg *jpeg *png *gif</p>
                            </h2><br><br>
                            <input type="submit" name="upportada" class="confirmSubmit" title="Upload cover photo" value="Subir foto">&nbsp;&nbsp;
                            <input type="submit" name="cancel" value="Cancelar" title="Cancel" class="cancelSubmit"> <br>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
