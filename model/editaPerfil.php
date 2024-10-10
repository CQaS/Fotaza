<?php

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

//get user info
$check_user = "SELECT * FROM users WHERE username = ?";
$stmt = $db->prepare($check_user);
$stmt->bind_param('s', $user);
$stmt->execute();
$res = $stmt->get_result();

$get_row = $res->fetch_assoc();
$gender_user_db = $get_row['gender'];

//define veriable
$error= "";

//Comprueba si la usuario ha subido una foto de portada o no
$cover_pic_db = $get_row['cover_pic'];

        
if(empty($cover_pic_db))
{
    $cover_pic= "../img/default_covpic.png";
}
else 
{
    $cover_pic = "../userdata/profile_pics/".$cover_pic_db;
}

//Comprueba si el usuario ha subido una foto de perfil o no.
$profile_pic_d = $get_row['foto_perfil'];
    
if (!empty($profile_pic_d)) 
{
    $profile_pic = "../userdata/profile_pics/".$profile_pic_d;
    $profile_fot = $profile_pic;
}
else 
{
    $profile_pic = "../img/default_propic.png";
    $profile_fot = $profile_pic;
}

//buscar nombre actual de usuario
$db_firstname = $get_row['first_name'];

//buscar trabajo y educacion
$db_company = $get_row['company'];
$db_position = $get_row['position'];
$db_school = $get_row['school'];
$db_concentration = $get_row['concentration'];

//buscar telefono
$db_mobile = $get_row['mobile'];
$db_pub_email = $get_row['pub_email'];
$db_email = $get_row['email'];

//buscar ciudad
$db_country = $get_row['country'];
$db_city = $get_row['city'];
$db_hometown = $get_row['hometown'];

//buscar bio
$db_bio = $get_row['bio'];
$db_queote = $get_row['queote'];

$stmt->close();


//Subir foto perfil
if (isset($_POST['upperfil'])) 
{
    
	if ($_FILES['upfoto'] == "") 
    {
		$error= "<p class='error_echo'>Por favor selecciona una foto!</p>";
	}
    else 
    {
		//extencion de archivo
		$profile_pic_name = @$_FILES['upfoto']['name'];
		$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
		$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

	   if (((@$_FILES['upfoto']['type']=='image/jpeg') || (@$_FILES['upfoto']['type']=='image/png') || (@$_FILES['upfoto']['type']=='image/gif')) && (@$_FILES['upfoto']['size'] < 200000)) 
        {
           $chare = $user;
           if (file_exists("../userdata/profile_pics/$chare"))
           {
			 //nn
           }
           else 
           {
               mkdir("../userdata/profile_pics/$chare");
           }
		
		
           $filename = strtotime(date('Y-m-d H:i:s')) . $file_ext;

           if(file_exists("../userdata/profile_pics/$chare/".$filename)) 
           {
               echo @$_FILES["upfoto"]["name"]."Ya Existe";
           }
           else 
           {
			
               $added_by = $user;
            
               $description = "Foto de Perfil cambiada";
			
               $photos = "$chare/$filename";
               $id_user = $_SESSION['idUser'];
               
               $sqlCommand = "INSERT INTO posts(added_by, id_user, description, photos) VALUES(?,?,?,?)";
            
               $stmtSube = $db->prepare($sqlCommand);
               $stmtSube->bind_param('siss', $added_by, $id_user, $description, $photos);
            
               if($stmtSube->execute())
               {
                   move_uploaded_file(@$_FILES["upfoto"]["tmp_name"], "../userdata/profile_pics/$chare/".$filename);
                   
                   $profile_pic_query = "UPDATE users SET foto_perfil= ? WHERE username= ?";
                   $stmtUp = $db->prepare($profile_pic_query);
                   $stmtUp->bind_param('ss', $photos, $user);
                   
                   if($stmtUp->execute())
                   {
                    
                       header("Location: about.php?u=$user");
                    
                   }
                   else
                   {
                       $error= "<p class='error_echo'>Algo Fallo1!</p>";
                   }
                   
                    $stmtUp->close();
               }
               else
               {
                   $error= "<p class='error_echo'>Algo Fallo2!</p>";
               }
            
               $stmtSube->close();
           }
       }
	   else
       {
		   $error= "<p class='error_echo'>¡Archivo inválido! Su imagen no debe tener más de 200 KB y debe ser un .jpg, .jpeg, .png o .gif</p>";
	   }
    }
}
		
    
//carga de imagen de portada
if (isset($_POST['upportada'])) 
{

	if ($_FILES['portada'] == "") 
    {
		$error= "<p class='error_echo'>Por favor elija una foto!</p>";
	}
    else 
    {
		//extensión de archivo
		$profile_pic_name = @$_FILES['portada']['name'];
		$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
		$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

	  if (((@$_FILES['portada']['type']=='image/jpeg') || (@$_FILES['portada']['type']=='image/png') || (@$_FILES['portada']['type']=='image/gif')) && (@$_FILES['portada']['size'] < 2000000)) 
      {
		$chare = $user;
        
		if (file_exists("../userdata/profile_pics/$chare")) 
        {
			$error= "<p class='error_echo'>¡Archivo inválido! Ya existe.</p>";
		}
        else 
        {
			mkdir("../userdata/profile_pics/$chare");
		}
		
		
		$filename = strtotime(date('Y-m-d H:i:s')) . $file_ext;

		if (file_exists("../userdata/profile_pics/$chare/".@$_FILES["portada"]["name"])) 
        {
			echo @$_FILES["portada"]["name"]."Ya existe";
		}
        else 
        {
			$added_by = $user;
            $description = "Foto Portada";
            $id_user = $_SESSION['idUser'];
			
			$photos = "$chare/$filename"; 
			$sqlCommand = "INSERT INTO posts(added_by, id_user, description,photos) VALUES(?,?,?,?)";
            
            $stmtPortada = $db->prepare($sqlCommand);
            $stmtPortada->bind_param('siss', $added_by, $id_user, $description, $photos);
            
            
            if($stmtPortada->execute())
            {
                move_uploaded_file(@$_FILES["portada"]["tmp_name"], "../userdata/profile_pics/$chare/".$filename);
                
			    $cover_pic_query = "UPDATE users SET cover_pic= ? WHERE username= ?";
                $stmtUpPortada = $db->prepare($cover_pic_query);
                $stmtUpPortada->bind_param('ss', $photos, $user);
			 
                if($stmtUpPortada->execute())
                {
                    header("Location: about.php?u=$user");
                
                }
                else
                { 
                    $error= "<p class='error_echo'>Algo Fallo 2!</p>";
                }
            }
            else
            {
                $error= "<p class='error_echo'>Algo Fallo 1!</p>";
            }
            
            $stmtPortada->close();
            $stmtUpPortada->close();
		}
	}
	else 
    {
		$error= "<p class='error_echo'>¡Archivo inválido! Su imagen no debe tener más de 200 KB y debe ser un .jpg, .jpeg, .png o .gif</p>";
	}
  }
}


//cambiar nombre de Usuario
if (isset($_POST['cambiarNombre'])) 
{
    $error = "";
    $updateinfo = @$_POST['cambiarNombre'];
    $update = @$_POST['update'];

    //modificar nombre
    if ($updateinfo) {
	   $firstname = strip_tags(@$_POST['fname']);
	   $firstname = trim($firstname);
	   $firstname = $db->real_escape_string($firstname);
	   $firstname = ucwords($firstname);

	   if(strlen($firstname) < 7 || strlen($firstname) > 20 )  {
		  $error = "<p class='error_echo'>Su nombre completo debe tener entre 8 y 20 caracteres.</p>";
	   }else {
		  //guardar en base
		  $info_submit_query = "UPDATE users SET first_name= ? WHERE username= ?";
          $stmtNombre = $db->prepare($info_submit_query);
          $stmtNombre->bind_param('ss', $firstname, $user); 
           
           if($stmtNombre->execute()){               
               
               $error = "<p class='error_echo'>Se ha actualizado la información de su perfil.</p>";
		       header("Location: about.php?u=$user");
               
           }else{ $error= "<p class='error_echo'>Algo Fallo 2!</p>";}
	   }
    }
}


//cambiar Pass
if(isset($_POST['cambiar']))
{
    //
    $senddata = @$_POST['cambiar'];
    //
    $passwordantes = strip_tags(@$_POST['passwordantes']);
    $newpassword = strip_tags(@$_POST['newpassword']);
    $repear_password = strip_tags(@$_POST['newpassword2']);
    $passwordantes = trim($passwordantes);
    $newpassword = trim($newpassword);
    $repear_password = trim($repear_password);
    
    //
    if ($senddata) 
    {
	   //
	   $password_query = "SELECT * FROM users WHERE username= ?";
        $stmtPassQ = $db->prepare($password_query);
        $stmtPassQ->bind_param('s', $user);
        $stmtPassQ->execute();
        $resPass = $stmtPassQ->get_result();
    
        $pass = $resPass->num_rows;
        
	   if($pass > 0) 
       {
           $row = $resPass->fetch_assoc();
		   $db_password = $row['password'];
           $db_pregunta = $row['pregunta'];
		   $db_email = $row['email'];
		   $db_first_name = $row['first_name'];
           $hashpass = hash('sha256', $passwordantes . $db_pregunta);
		   if ($hashpass == $db_password) 
           {
               if ($newpassword == $repear_password) 
               {
                   $hashpass2 = hash('sha256', $newpassword . $db_pregunta);
				   if (strlen($newpassword) <= 3) 
                   {
                       $error = "<p class='error_echo'>¡Perdón! ¡Pero su nueva contraseña debe tener 3 o más de 5 caracteres!</p>";
                    
				   }
                   else 
                   {
                       $password_update_query = "UPDATE users SET password= ? WHERE username= ?";
                       $stmtPass = $db->prepare($password_update_query);
                       $stmtPass->bind_param('ss', $hashpass2, $user);
                    
                       if($stmtPass->execute())
                       {
                           $error = "<p class='succes_echo'>¡Éxito! Tu contraseña actualizada.</p>";
				           // send email
				           $msg = "Hola  ".$db_first_name." Su contraseña se ha cambiado correctamente.";
                       
                       }
                       else
                       { 
                           $error= "<p class='error_echo'>Algo Fallo!</p>";
                       }
                    
                    $stmtPass->close();
                   }
               }
               else
               {
                   $error = "<p class='error_echo'>Las nuevas contraseñas no coinciden!</p>";
			   }
           
           }
           else 
           {
               $error = "<p class='error_echo'>La contraseña anterior es incorrecta!</p>";
           }
       }
        
        $stmtPassQ->close();
    
    }
    else 
    {
	   $error = "<p class='error_echo'>Algo Fallo!</p>";
    }
}

//editar trabajo y educacion
if(isset($_POST['trabajo']) || isset($_POST['estudios']))
{
    $trabajo = @$_POST['trabajo'];
    $estudios = @$_POST['estudios'];

    //trabajo
    if ($trabajo) 
    {
        $compania = strip_tags(@$_POST['compania']);
        $compania = trim($compania);
	    $compania = ucwords($compania);
	    $posicion = strip_tags(@$_POST['posicion']);
	    $posicion = trim($posicion);
	    $posicion = ucwords($posicion);
		//
		$info_submit_query = "UPDATE users SET company= ?, position= ? WHERE username= ?";
        $stmtTrabajo = $db->prepare($info_submit_query);
        $stmtTrabajo->bind_param('sss', $compania, $posicion, $user);
        
        if($stmtTrabajo->execute())
        {
            echo "<p class='error_echo'>La información de su perfil se ha actualizado.</p>";
            header("Location: about.php?u=$user");
            
        }
        else
        { 
            $error= "<p class='error_echo'>Algo Fallo!</p>";
        }
        
        $stmtTrabajo->close();
    }
    
    //educacion
    if ($estudios) 
    {
        $lugar = strip_tags(@$_POST['lugar']);
	    $lugar = trim($lugar);
	    $lugar = ucwords($lugar);
	    $titulo = strip_tags(@$_POST['titulo']);
	    $titulo = trim($titulo);
	    $titulo = ucwords($titulo);

		//
		$info_submit_query = "UPDATE users SET school= ?, concentration= ? WHERE username= ?";
        $stmtEdu = $db->prepare($info_submit_query);
        $stmtEdu->bind_param('sss', $lugar, $titulo, $user);
        
        if($stmtEdu->execute())
        {
    
		  echo "<p class='error_echo'>La información de su perfil se ha actualizado.</p>";
		  header("Location: about.php?u=$user");
            
        }
        else
        { 
            $error= "<p class='error_echo'>Algo Fallo!</p>";
        }
        
        $stmtEdu->close();
    }
}

//editar telefono & email
if(isset($_POST['tel']))
{
    
    $error = "";
    $send = @$_POST['send'];
    $sendemail = @$_POST['sendemail'];
    $emaildata = @$_POST['emaildata'];

    //
    if ($sendemail || $emaildata) 
    {
        $tel = strip_tags(@$_POST['tel']);
	    $tel = trim($tel);
	    $tel = $db->real_escape_string($tel);
	    $pub_email = strip_tags(@$_POST['pub_email']);
	    $pub_email = trim($pub_email);
	    $pub_email = $db->real_escape_string($pub_email);
		//
		$info_submit_query = "UPDATE users SET mobile= ?, pub_email= ? WHERE username= ?";
        $stmtTelE = $db->prepare($info_submit_query);
        $stmtTelE->bind_param('iss', $tel, $pub_email, $user);
    
        if($stmtTelE->execute())
        {
            
		  echo "<script>alert('Información actualizada con éxito.')</script>";
		  echo "<script>window.open('cbinfo_update.php','_self')</script>";
		  $error = "<p class='succes_echo'>Información actualizada con éxito.</p>";
            
        }
        else
        { 
            $error= "<p class='error_echo'>Algo Fallo!</p>";
        }
        $stmtTelE->close();
    }
}

//editar ciudad
if(isset($_POST['send']))
{
    
    $error = "";
    $send = @$_POST['send'];
    //

    if ($send) 
    {
        $pais = strip_tags(@$_POST['pais']);
        $pais = trim($pais);
	    $pais = $db->real_escape_string($pais);
	    $pais = ucwords($pais);
	    $city = strip_tags(@$_POST['city']);
	    $city = trim($city);
	    $city = $db->real_escape_string($city);
	    $city = ucwords($city);
	    $origen = strip_tags(@$_POST['origen']);
	    $origen = trim($origen);
	    $origen = $db->real_escape_string($origen);
	    $origen = ucwords($origen);
		//
		$info_submit_query = "UPDATE users SET city= ?, country= ?, hometown= ? WHERE username= ?";
        $stmtCity = $db->prepare($info_submit_query);
        $stmtCity->bind_param('ssss', $city, $pais, $origen, $user);
        
        if($stmtCity->execute())
        {
            
		  echo "<script>alert('Información actualizada con éxito.')</script>";
		  echo "<script>window.open('location_update.php','_self')</script>";
		  $error = "<p class='succes_echo'>Información actualizada con éxito.</p>";
            
        }
        else
        { 
            $error= "<p class='error_echo'>Algo Fallo!</p>";
        }
        $stmtCity->close();
    }
}

//editar bio
if(isset($_POST['deti']) || isset($_POST['cita']))
{
    
    $bio = @$_POST['bio'];
    $citas = @$_POST['citas'];

    //
    if ($bio) 
    {
	    $bio = $_POST['bio'];
	    $bio = trim($bio);
	    $bio = $db->real_escape_string($bio);
		//
		$info_submit_query = "UPDATE users SET bio= ? WHERE username= ?";
        $stmtBio = $db->prepare($info_submit_query);
        $stmtBio->bind_param('ss', $bio, $user);
        
        if($stmtBio->execute())
        {
            
		  echo "<p class='error_echo'>Su biografía de perfil ha sido actualizada.</p>";
		  header("Location: about.php?u=$user");
            
        }
        else
        { 
            $error= "<p class='error_echo'>Algo Fallo!</p>";
        }
        $stmtBio->close();
    }
    
    
    if ($citas) 
    {
	    $citas = $_POST['citas'];
	    $citas = trim($citas);
	    $citas = $db->real_escape_string($citas);
		//
		$info_submit_query = "UPDATE users SET queote= ? WHERE username= ?";
        $stmtCita = $db->prepare($info_submit_query);
        $stmtCita->bind_param('ss', $citas, $user);
    
        if($stmtCita->execute())
        {
            echo "<p class='error_echo'>Su biografía de perfil ha sido actualizada.</p>";
            header("Location: about.php?u=$user");
            
        }
        else
        { 
            $error= "<p class='error_echo'>Algo Fallo!</p>";
        }
        $stmtCita->close();
    }
}

if (isset($_POST['cancel'])) 
{
    header("Location: about.php?u=$user");
}


?>
