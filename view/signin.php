<?php 
ob_start();
session_start();

if (isset($_SESSION['user_login'])) 
{
	header('location: home');
    
}

require_once "../controller/MasterController.php";
$gets = new MasterController();
$res = $gets->getLog();

require_once "../controller/Captcha.php";
$captcha = new Captcha();

include_once $res;
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Fotaza</title>
    <meta charset="uft-8">
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">

    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../js/check.js"></script>
    <style>
        .demo-error {
            color: #FF0000;
            font-size: 0.95em;
        }

        .demo-input {
            width: 100%;
            border-radius: 5px;
            border: #CCC 1px solid;
            padding: 12px;
            margin-top: 5px;
        }

        .demo-btn {
            padding: 12px;
            border-radius: 5px;
            background: #232323;
            border: #284828 1px solid;
            color: #FFF;
            width: 100%;
            cursor: pointer;
            margin-top: 4px;
        }

        .demo-table {
            border-radius: 3px;
            padding: 10px;
            border: #E0E0E0 1px solid;
        }

        .demo-success {
            margin-top: 5px;
            color: #478347;
            background: #e2ead1;
            padding: 10px;
            border-radius: 5px;
        }

        .captcha-input {
            background: #c61033 url(../controller/captchaImageSource.php) repeat-y left center;
            padding-left: 85px;
        }

    </style>
</head>

<body style="background: url(../img/eda.jpg) no-repeat center center; background-size: 100%; ">
    <div class="main">
        <div class="headerLogin" style="background-color: rgb(99 78 199 / 51%);">
            <div class="login_menubar clearfix">
                <div class="menu_logo">
                    <h1>
                        <a title="ir a Fotaza" href="../index.php">
                            <b>FOTAZA</b>
                        </a>
                    </h1>
                </div>
                <div class="menu_login_container">
                    <form action="#" method="POST">
                        <table class="menu_login_container">
                            <tr>
                                <td class="logintd">
                                    <label for="email">Usuario o Email</label>
                                </td>
                                <td class="logintd">
                                    <label for="pass">Password</label>
                                </td>
                            </tr>
                            <tr class="login_">
                                <td>
                                    <input type="text" name="user_login" id="email" required="required" value="" class="inputtext">
                                </td>
                                <td>
                                    <input type="password" name="password_login" required="required" id="pass" value="" class="inputtext">
                                </td>
                                <td>
                                    <input type="submit" name="login" class="btn btn-sm btn-primary" value="Login">
                                </td>
                            </tr>
                            <tr>
                                <td class="login_form_label_field">
                                    <a href="passRecover.php" style="text-decoration:none; color:#FFFFFF">¿Olvidaste tu contraseña?</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="holecontainer">
            <div class="container">
                <div>
                    <div>
                        <div class="maincontent">
                            <?php
								if (isset($RegistroOK)) 
                                {
									echo $RegistroOK;
								}
                                else 
                                {
									echo '
									   <h2 style="color: #6c767e;"><font face="bookman">Bienvenido a Fotaza</font></h2>
										<div class="maincontent_text">
										<font face="bookman">Aqui podras:<br>
											<li>Ver a tus amigos.</li>
											<li>Compartir tus fotos.</li>
											<li>Conocer gente como Tu!.</li>
										</font>
										</div>
									';
								}
							   ?>

                        </div>
                        <div class="signupform_content">
                            <h2>Crear Usuario!</h2>
                            <div class="signupform_text"></div>
                            <div>
                                <form action="" method="POST" class="registration">
                                    <div class="signup_form" style="background-color: rgb(210 1 15 / 38%);">
                                        <div>
                                            <td>
                                                <input name="nombre" id="first_name" placeholder="Tu nombre" required="required" class="first_name signupbox_wihei signupbox" type="text" size="30" value="">
                                            </td>
                                        </div>
                                        <div>
                                            <td>
                                                <input name="username" id="username" placeholder="Usuario" required="required" onBlur="checkusername()" onkeyup="clean('username')" onkeydown="clean('username')" class="user_name signupbox signupbox_wihei" type="text" size="30" value="">
                                            </td>
                                            <td style=" margin: 10px; padding: 2px; background-color: white;">
                                                <p id="usernamestatus"></p>
                                            </td>
                                        </div>
                                        <div>
                                            <td>
                                                <input name="email" placeholder="Tu Email" required="required" class="email signupbox signupbox_wihei" type="email" size="30" value="">
                                            </td>
                                        </div>
                                        <div>
                                            <td>
                                                <input name="password" id="password-1" required="required" style="overflow: hidden; padding-right: 7px;" placeholder="Password" class="password signupbox passbox_wihei" type="password" size="30" value="">
                                            </td>
                                        </div>
                                        <div>
                                            <td>Fecha de nacimiento<br>
                                                <input name="fechnac" id="" required="required" style="overflow: hidden; padding-right: 7px;" class="password signupbox passbox_wihei" type="date" size="30" value="">
                                            </td>
                                        </div>
                                        <div>
                                            <td>
                                                <input name="pregunta" id="password-1" required="required" style="overflow: hidden; padding-right: 7px;" placeholder="Nombre de mascota favorita" class="password signupbox passbox_wihei" type="text" size="30" value="">
                                            </td>
                                        </div>
                                        <div class="gender">
                                            <td>
                                            <th>
                                                <div style="float: left;padding: 13px 13px 0 13px;font-size: 16px;font-weight: bold;">
                                                    <input type="radio" name="genero" value="1" required checked><span>Hombre</span>
                                                </div>
                                            </th>
                                            <th>
                                                <div style="float: left;padding: 13px 13px 0 13px; font-size: 16px; font-weight: bold;">
                                                    <input type="radio" name="genero" value="2">
                                                    <span>Mujer</span>
                                                </div>
                                            </th>
                                            </td>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="checkbox" class="" id="selphoto" name="terminos" value="1"><a href="../view/terminos.php" style="text-decoration:none; color:#FFFFFF">Terminos y Condiciones</a>
                                        </div><br>
                                        <div>
                                            Ingresa codigo Captcha: <span id="error-captcha" class="demo-error"><?php if(isset($error_cap)) { echo "<div class='demo-success'>".$error_cap."</div>"; } ?></span>
                                            <input name="captcha_code" type="text" class="demo-input captcha-input">
                                            <?php if(isset($success_message)) { ?>
                                            <div class="demo-success"><?php echo $success_message; ?></div>
                                            <?php } ?>
                                        </div>
                                        <div>
                                            <input type="submit" name="signup" class="uisignupbutton signupbutton" value="Crear mi Cuenta!">
                                        </div>
                                        <div class="signup_error_msg">
                                            <?php 
										      if (isset($error_message)) {echo $error_message;}
									       ?>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include ( "footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
