<?php

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

ob_start();
session_start();
if (isset($_SESSION['user_login'])) 
{
	header('location: signin.php');
}

//verifica Email o Usuario
if(isset($_POST['searchId']))
{
    
    if(!empty($_POST['username']))
    {
        $error = "";
        $username = $db->real_escape_string($_POST['username']);    

        //Comprobaciones
        $check_pic = "SELECT * FROM users WHERE username= ? || email= ?";
        $stmtc = $db->prepare($check_pic);
        $stmtc->bind_param('ss', $username, $username);
        $stmtc->execute();
        $check_pic = $stmtc->get_result();
        $stmtc->close();
        
        $res = $check_pic->num_rows;
    
        if($res > 0)
        {
            $username_fetch_query = $check_pic->fetch_assoc();
            $profile_pic_db = $username_fetch_query['foto_perfil'];
            $pic_uname = $username_fetch_query['username'];
            $fullname_db = $username_fetch_query['first_name'];
            $get_username_fetch_query = $username_fetch_query['username'];
		    $get_email_fetch_query = $username_fetch_query['email'];
		    $get_active_fetch_query = $username_fetch_query['activated'];
		    $get_block_fetch_query = $username_fetch_query['blocked_user'];
    
            if (!empty($profile_pic_db)) 
            {
                $profile_pic = "../userdata/profile_pics/".$profile_pic_db;
            }
            else
            {
                $profile_pic = "../img/default_propic.png";
            }
        
        
            if ($get_block_fetch_query == 1 ) 
            {
                $error = "<p class='error_echo'>Esta cuenta esta bloqueada!</p>";
        
            }
            else
            {
                $_SESSION['username'] = $username;
                $error = "<p class='succes_echo'>Verifica tu información personal</p>";
			     
                $succes_echoEmail = "
				<div>
					<img src=".$profile_pic." style='height: 115px;  width: 115px; border: 1px solid #ddd;'/>
				</div>
				<form action='passRecover.php' method='POST'>
					<span style='font-size:  margin: 13px 0 0 13px;  font-weight: 800; color: #088A08'>".$fullname_db."</span></br>
					<span style='font-size:  margin-left: 13px;  font-weight: 500; color: #575454'>".$username."</span></br></br>
						Ingresa tu Respuesta secreta:</br></br><input type='text' name='respuesta' class='placeholder' size='30' required autofocus></br></br>
					</hr>
					<input class='submRecov' type='submit' name='recuperar' id='senddata' value='Continue'>
				</form>
		    	";

            }
            
        }
        else 
        {
            $error = "<p class='error_echo'>¡No pudimos encontrar su cuenta con esa información!</p>";
        echo $error;
        }
        
    }
    else 
    {
		$error = "<p class='error_echo'>Ingresa un E-mail o Usuario Valido!</p>";
	}
}

//check respuesta
if (isset($_POST['recuperar'])) 
{
    $pregunta = strip_tags($_POST['respuesta']);
    $pregunta = $db->real_escape_string($pregunta);
    
    $username = $_SESSION['username'];
    
	$search = "SELECT * FROM users WHERE pregunta= ? AND (username= ? || email= ?)";
    $stmtS = $db->prepare($search);
    $stmtS->bind_param('sss', $pregunta, $username, $username);
    $stmtS->execute();
    $search = $stmtS->get_result();
    $stmtS->close();
    
	$search_num = $search->num_rows;
    
	if ($search_num > 0)
    {
        
        $usernm_fetch_query = $search->fetch_assoc();
        $get_first_nm_fetch_query = $usernm_fetch_query['first_name'];
        
        $_SESSION['name'] = $username;
        
        $success_email_cnfrm = "
				<form action='#' method='POST'>
						Nuevo Password:</br></br><input type='password' name='newpassword' class='placeholder' size='30' required></br></br>
					</hr>
						Repite Password:</br></br><input type='password' name='newpassword2' class='placeholder' size='30' required></br></br>
					</hr>
					<input class='submRessetp' type='submit' name='confirmRessetpass' id='senddata' value='Recupera Password'>
				</form>";
        
    }
    else
    {
        
        $error = "<p class='error_echo'>Respuesta incorrecta!</p>";
    }
    
}
else 
{
    $error = "<p class='error_echo'>Recupera tu cuenta Fotaza!</p>";
}

//Nuevo pass..
if (isset($_POST['confirmRessetpass']))
{
    $newpassword = strip_tags($_POST['newpassword']);
    $repeat_password = strip_tags($_POST['newpassword2']);
    $newpassword = $db->real_escape_string($newpassword);
    $repeat_password = $db->real_escape_string($repeat_password);
    $unameCnfrm = $_SESSION['name'];
    
    
	if (isset($unameCnfrm)) 
    {
        
		$Cnfrm = "SELECT pregunta FROM users WHERE username= ? || email = ?";
        $stmtC = $db->prepare($Cnfrm);
        $stmtC->bind_param('ss', $unameCnfrm, $unameCnfrm);
        $stmtC->execute();
        $Cnfrm = $stmtC->get_result();
        $stmtC->close();
        
		$Cnfrm_num = $Cnfrm->num_rows;
        
		if ($Cnfrm_num >= 1) 
        {
            
            if ($newpassword == $repeat_password)
            {
                $Cnfrm_fetch = $Cnfrm->fetch_assoc();
                $pre = $Cnfrm_fetch['pregunta'];
                    
                    $hashpass = hash('sha256', $newpassword . $pre);
                    
					$updatePass = "UPDATE users SET password= ? WHERE username= ? || email = ?";
                    $stmtUp = $db->prepare($updatePass);
                    $stmtUp->bind_param('sss', $hashpass, $unameCnfrm, $unameCnfrm);
                
					
                    if ($stmtUp->execute()) 
                    {
                        
						$error = "<p class='succes_echo'>Contraseña cambiada correctamente.</p>";
                        header("Refresh: 2; URL=../view/signin.php");
                    
                    }
                    else
                    { 
                        $error = "<p class='error_echo'>Algo fallo, repite la operacion 2!</p>"; 
                    }
                
                $stmtUp->close();
            }
            else 
            {
					$error = "<p class='error_echo'>La contraseña no coincide!</p>";
					$success_email_cnfrm = "
						<form action='#' method='POST'>
								Nuevo Password:</br></br><input type='password' name='newpassword' class='placeholder' size='30' required></br></br>
							</hr>
								Repite Password:</br></br><input type='password' name='newpassword2' class='placeholder' size='30' required></br></br>
							</hr>
							<input class='submRessetp' type='submit' name='confrmRessetpass' id='senddata' value='Recuperar Pass'>
						</form>
					";
            }
		}
        else
        { 
            $error = "<p class='error_echo'>Algo fallo, repite la operacion 1!</p>"; 
        }
        
	}
    else 
    {
		header('Location: recuperaPass.php');
	}
}


?>
