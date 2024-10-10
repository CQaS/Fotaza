<?php  
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) 
{
	header('location: signin');
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
    <title>Trabajo y educacion</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>

<body style="background-color: #471831;">

    <?php include ( "header.php");?>

    <div style="margin-top: 48px;">
        <div style="width: 900px; margin: 0 auto;">
            <ul>
                <li style="float: left;">
                    <div class="settingsleftcontent">
                        <ul>
                            <li><a href="profile_update.php">Editar foto perfil</a></li>
                            <li><a href="account_update.php">Cambiar nombre</a></li>
                            <li><a href="password_update.php">Password</a></li>
                            <li><a href="workedu_update.php" style="background-color: #0B810B; border-radius: 3px; color: #fff;">Trabajo y Educacion</a></li>
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
                        <form action="workedu_update.php" method="post">
                            <h2>
                                <p>Donde trabajas:
                                </p>
                            </h2>
                            <br>
                            Compañia:
                            <br>
                            <input type="text" name="compania" id="company" class="placeholder" size="30" value="<?php echo $db_company; ?>"> <br><br>
                            Posicion:
                            <br>
                            <input type="text" name="posicion" id="position" class="placeholder" size="30" value="<?php echo $db_position; ?>">
                            <br><br>
                            <input type="submit" name="trabajo" id="updatework" class="confirmSubmit" value="Editar informacion">&nbsp;&nbsp;
                            <input type="submit" name="cancel" value="Cancelar" title="Cancelar" class="cancelSubmit">
                            <br>
                        </form>
                    </div>
                    <div class="uiaccountstyle">
                        <form action="workedu_update.php" method="post">
                            <h2>
                                <p>Donde estudiaste: </p>
                            </h2>
                            <br>
                            Lugar:
                            <br>
                            <input type="text" name="lugar" id="school" class="placeholder" size="30" value="<?php echo $db_school; ?>">
                            <br><br>
                            Titulo:
                            <br>
                            <input type="text" name="titulo" id="concentration" class="placeholder" size="30" value="<?php echo $db_concentration; ?>">
                            <br><br>
                            <input type="submit" name="estudios" id="updateinfo" class="confirmSubmit" value="Editar informacion">&nbsp;&nbsp;
                            <input type="submit" name="cancel" value="Cancelar" title="Cancelar" class="cancelSubmit"> <br>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
