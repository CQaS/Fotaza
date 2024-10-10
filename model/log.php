<?php

require_once "connection.php";
$conectar=new Conectar();
$db = $conectar->getConnection();


if (isset($_COOKIE['user_login'])) 
{
	$_SESSION['user_login'] = $_COOKIE['user_login'];
	header("location: ../index.php");
	exit();
    
}
 
//check logueo...
if (isset($_POST['login']))
{
    
    if (isset($_POST['user_login']) && isset($_POST['password_login']))
    {
        
        //limpiar campos de formulario...
        $gets->limpiarInputLogin($_POST['user_login'], $_POST['password_login'], $objUs, $RegistroOK, $db);
        
        
        if(empty($RegistroOK))
        {
            $num = 0;
        
            $pregunta = "SELECT pregunta FROM users WHERE (username= ? || email= ?)";
            $stmtpregunta = $db->prepare($pregunta);
            $user = $objUs->getUsername();
            $stmtpregunta->bind_param('ss', $user, $user);
            $stmtpregunta->execute();
            $pregunta = $stmtpregunta->get_result();
            $stmtpregunta->close();
            
            $pre = $pregunta->num_rows;
            if($pre>0)
            {
                
                $get = $pregunta->fetch_assoc();
                $hashpass = hash('sha256', $objUs->getPassword() . $get['pregunta']);
            
            
			    $result = "SELECT * FROM users WHERE (username= ? || email= ?) AND password= ? AND blocked_user='0'";
                $stmtres = $db->prepare($result);
                $user = $objUs->getUsername();
                $stmtres->bind_param('sss', $user, $user, $hashpass);
                $stmtres->execute();
                $result = $stmtres->get_result();
                $stmtres->close();
                
			     $num = $result->num_rows;
            
                if ($num>0) 
                {
                    $get_user_email = $result->fetch_assoc();			
                    $get_user_uname_db = $get_user_email['username'];
                    $fotoPerfil = $get_user_email['foto_perfil'];
                    $idUser = $get_user_email['id'];
                    
                
				    $_SESSION['user_login'] = $get_user_uname_db;
                    
                    if(!isset($fotoPerfil))
                    {
                        $_SESSION['foto_perfil'] = "../img/default_propic.png";  
                    }
                    else
                    {
                        $_SESSION['foto_perfil'] = "../userdata/profile_pics/".$fotoPerfil;
                    }
                    
                    $_SESSION['idUser'] = $idUser;
				    header('location: ../index.php');
				    exit();
			
                }
                else
                {
                    $result1 = "SELECT * FROM users WHERE (username= ? || email= ?) AND password= ? AND blocked_user='1'";
                    $stmtres1 = $db->prepare($result1);
                    $stmtres1->bind_param('sss', $user_login, $user_login, $hashpass);
                    $stmtres1->execute();
                    $result1 = $stmtres1->get_result();
                    $stmtres1->close();
            
					$num1 = $result1->num_rows;
					if ($num1>=1) 
                    {
                        
                        $RegistroOK = '
						<h2><font face="bookman">Opps!!!</font></h2>
				        <button type="button" class="btn btn-labeled btn-success" style="pointer-events: none;">
                        <span class="btn-label"><i class="fa fa-thumbs-down"></i></span>Este cuenta a sido Bloqueada!</button>';
                        
					}
                    else
                    {
                        
						$RegistroOK = '
						<h2><font face="bookman">Alerta!!!</font></h2>
				        <button type="button" class="btn btn-labeled btn-success" style="pointer-events: none;">
                        <span class="btn-label"><i class="fa fa-thumbs-down"></i></span>Login o Pass incorrecto!</button>';
                        
					}
				}
				
			}
            else 
            {
                $RegistroOK = '
                <h2><font face="bookman">Alerta!!!</font></h2>
				<button type="button" class="btn btn-labeled btn-success" style="pointer-events: none;">
                <span class="btn-label"><i class="fa fa-thumbs-down"></i></span>Login o Pass incorrecto!</button>';
            }
        }
    }
}

//check username...
if(isset($_POST["name2check"]) && $_POST["name2check"] != "")
{
    
    $username = preg_replace('#[^a-z0-9]#i', '', $_POST["name2check"]);
    $username = $db->real_escape_string($username);
    
    $sql_uname_check = "SELECT id FROM users WHERE username= ? OR email= ? LIMIT 1";
    $stmtSql = $db->prepare($sql_uname_check);
    $stmtSql->bind_param('ss', $username, $username);
    $stmtSql->execute();
    $sql_uname_check = $stmtSql->get_result();
    $stmtSql->close();
    
    
    if (strlen($username) < 5 || strlen($username) > 15 ) {
	    echo '<p style="color: #C10000; font-size: 13px; font-weight: 600; text-align: center; margin: 3px 0;">5-15 caracteres por favor</p>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<p style="color: #C10000; font-size: 13px; font-weight: 600; text-align: center; margin: 3px 0;">El primer carácter debe ser una letrar</p>';
	    exit();
    }
    
    $uname_check = $sql_uname_check->num_rows;
    if ($uname_check < 1) {
	    echo '<p style="color: #dbf510; font-size: 13px; font-weight: 600; text-align: center; margin: 3px 0;">¡Éxito! Recuerde el nombre de usuario para iniciar sesión</p>';
	    exit();
    } else {
	    echo '<p style="color: #a8cbcc; font-size: 13px; font-weight: 600; text-align: center; margin: 3px 0;"><strong>' . $username . '</strong> *¡Usuario o Email Invalido!*</p>';
	    exit();
    }
}

//check nuevo Usuario...
if (isset($_POST['signup']))
{
    require "users.php";
    $userCaptcha = filter_var($_POST["captcha_code"], FILTER_SANITIZE_STRING);
    
    $isValidCaptcha = $captcha->validateCaptcha($userCaptcha);
    
	try 
    {
		if(empty($_POST['nombre']) || !preg_match("/^[a-zA-Z-ñáéíóú\s]*$/",$_POST['nombre'])) 
        {
			throw new Exception('Ingresa tu nombre');
			
		}
		if (is_numeric($_POST['nombre'][0])) 
        {
			throw new Exception('Esctribe tu Nombre!');

		}
        if(empty($_POST['pregunta'] || !preg_match("/^[a-zA-Z-ñáéíóú\s]*$/",$_POST['pregunta']))) 
        {
			throw new Exception('Ingresa tu respuesta');
			
		}
		if(empty($_POST['username']) || !preg_match("/^[a-zA-Z-ñáéíóú\s]*$/",$_POST['username'])) 
        {
			throw new Exception('Usuario esta vacio o invalido');
			
		}
		if (is_numeric($_POST['username'][0])) 
        {
			throw new Exception('El primer carácter del nombre de usuario debe ser una letra!');

		}
		if(empty($_POST['email'])) 
        {
			throw new Exception('Ingresa tu Email');
			
		}
		if(empty($_POST['password']) || !preg_match("/^[a-zA-Z-ñáéíóú\s]*$/",$_POST['password'])) 
        {
			throw new Exception('Ingresa tu Password o es Invalido');
			
		}
		if(empty($_POST['genero'])) 
        {
			throw new Exception('Elige un genero');
			
		}
        if(empty($_POST['fechnac'])) 
        {
			throw new Exception('Digita tu fecha de nacimiento');
			
		}
        else
        {
            /*  $checEdad = "SELECT Edad( ? )";
                $stmteChecEdad = $db->prepare($chekEdad);
                $stmteChecEdad->bind_param('s', $_POST['fechnac']);
                $stmteChecEdad->execute();
                $edad = $stmteChecEdad->get_result();
            */
            function calculaedad($fechanacimiento)
            {
                list($ano,$mes,$dia) = explode("-",$fechanacimiento);
                $ano_diferencia  = date("Y") - $ano;
                $mes_diferencia = date("m") - $mes;
                $dia_diferencia   = date("d") - $dia;
                if ($dia_diferencia < 0 || $mes_diferencia < 0)
                    $ano_diferencia--;
                    return $ano_diferencia;
            }
            
            $hoy = strftime("%Y-%m-%d", time());
            $edad = calculaedad($_POST['fechnac']);
            
            if($edad < 18 )
            {
                throw new Exception('Eres menor!!');
            }
        }
        
        if (!isset($_POST['terminos']))
        {
            throw new Exception('Debes Leer y Aceptar los terminos y condiciones!');
        }

		if (strlen($_POST['nombre']) <7 || strlen($_POST['nombre']) >20 )  
        {
			throw new Exception('El nombre completo debe tener entre 8 y 20 caracteres!');
		}
        
        $objUs = new NuevoUsuario($_POST['nombre'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['genero'], $_POST['fechnac'], $_POST['username']);
        
        $nombre = $db->real_escape_string($objUs->getFirst_name());
        $nombre = trim($nombre);
        
        $pregunta = $db->real_escape_string($objUs->getPregunta());
        $pregunta = trim($pregunta);
        $pregunta = strtolower($pregunta);
        $pregunta = preg_replace('/\s+/','',$pregunta);
        
        $u_name = $db->real_escape_string($objUs->getUsername());
        $u_name = trim($u_name);
        $u_name = strtolower($u_name);
        $u_name = preg_replace('/\s+/','',$u_name);
        
        $u_email = $db->real_escape_string($objUs->getEmail());
        $u_email = trim($u_email);
        $password = $db->real_escape_string($objUs->getPassword());
        $password = trim($password);
        $genero = $objUs->getGender();
        $fechNac = $objUs->getFechNac();

		
		$u_chec = "SELECT username FROM users WHERE username= ?";
        $stmtChec = $db->prepare($u_chec);
        $stmtChec->bind_param('s', $u_name);
        $stmtChec->execute();
        $u_check = $stmtChec->get_result();
        
		$check = $u_check->num_rows;
		
		$e_chec = "SELECT email FROM users WHERE email= ?";
        $stmteChec = $db->prepare($e_chec);
        $stmteChec->bind_param('s', $u_email);
        $stmteChec->execute();
        $e_check = $stmteChec->get_result();
        
		$email_check = $e_check->num_rows;
        
		if (strlen($u_name) >4 && strlen($u_name) <16 ) 
        {
			if ($check == 0 ) 
            {
				if ($email_check == 0) 
                {
					if (strlen($password) >4 ) 
                    {
                        
                        if ($isValidCaptcha) 
                        {
                            $alta = date("Y-m-d"); //Year - Month - Day
						
                            $nombre = ucwords($nombre);
				            $u_name = strtolower($u_name);
				            $u_name = preg_replace('/\s+/','',$u_name);
                            $hashpass = hash('sha256', $password . $pregunta);
                        
				            $result = "INSERT INTO users (first_name,username,email,password,fechNac,gender,sign_up_date,pregunta) VALUES( ?, ?, ?, ?, ?, ?, ?, ?)";
                        
                            $stmteRes = $db->prepare($result);
                            $stmteRes->bind_param('sssssiss', $nombre, $u_name, $u_email, $hashpass, $fechNac, $genero, $alta, $pregunta);
                            
                        
                            if($stmteRes->execute())
                            {
                                $_SESSION['user_login'] = $u_name;
                            
						          $RegistroOK = '
						          <h2><font face="bookman">Registro exitoso!</font></h2>
						          <div class="maincontent_text" style="text-align: center;">
						          <font face="bookman">Puede iniciar sesión con Usuario o Mail. <br>
							         Mail: '.$u_email.'<br>
							         Usuario: '.$u_name.'
						          </font></div>';
                            }
                            else
                            {
                                $success_message = '<h2><font face="bookman">Fallo Registro!</font></h2>';
                            }
                        
                            $stmteRes->close();
                        
                        }
                        else 
                        {
                            $error_cap ='¡Codigo Captcha Invalido!';
                        }
						
					}
                    else 
                    {
						throw new Exception('¡La contraseña debe tener 5 o más de 5 caracteres!');
					}
                    
				}
                else 
                {
					throw new Exception('El usuario o Email ya existe!');
				}
                
			}
            else 
            {
				throw new Exception('El usuario o Email ya existe!');
			}
            
		}
        else 
        {
			throw new Exception('El nombre de usuario debe tener entre 5 y 15 caracteres!');
		}
        
        $stmtChec->close();
        $stmteChec->close();

	}
	catch(Exception $e) 
    {
		$error_message = $e->getMessage();
	}
}

?>
