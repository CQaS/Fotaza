<?php 

require_once("../controller/MasterController.php");
$gets = new MasterController();
$res = $gets->getPass();

include_once $res;

?>


<!DOCTYPE html>
<html>

<head>
    <title>Recuperar Password</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <meta charset="uft-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body style="background-color: #471831;">

    <div>
        <div>
            <div class="headerLogin">
                <div class="login_menubar clearfix">
                    <div class="menu_logo">
                        <h1>
                            <a title="Fotaza Home" href="../index.php">
                                <b>Fotaza</b>
                            </a>
                        </h1>
                    </div>
                    <div class="menu_login_container">
                        <form action="index.php" method="POST">
                            <table class="menu_login_container">
                                <tr class="login_">
                                    <td>
                                        <a href="signin.php" class="uiloginbutton" title="Login">Login / Crear</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="pass_body1" style="min-width: 900px;">
            <?php if(isset($error)){ echo $error;} ?>
            <div class="pass_body2">
                <?php
					if (isset($success_msg)) {
						echo $success_msg;
					}else if (isset($succes_echoEmail)) {
						echo $succes_echoEmail;
					}else if (isset($success_email_cnfrm)) {
						echo $success_email_cnfrm;
					}else {
						echo '
							<form action="" method="POST">
								<p>Recupera tu perfil Fotaza!</p></br>
									Ingresa email o usuario:</br></br><input type="text" name="username" class="placeholder" size="30" autofocus></br></br>
								</hr></br>
								<input class="submRecov" type="submit" name="searchId" id="senddata" value="Enviar">
							</form>
						';
					}
				?>

            </div>
        </div>
        <div><?php include ( "footer.php"); ?></div>
    </div>

</body>

</html>
