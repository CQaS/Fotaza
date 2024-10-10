<?php
require_once "connection.php";
$conectar=new Conectar();
$db=$conectar->getConnection();


ob_start();
session_start();
if (!isset($_SESSION['user_login'])) 
{
	header('location: ../index.php');
}
else 
{
	$user = $_SESSION['user_login'];
    $idUser = $_SESSION['idUser'];
}

//subir post
if(isset($_POST['subir']))
{
    
    //validar campos de formulario...
    $gets->validarPost($_POST['titulo'], $_POST['categoria'], $_POST['donde'], $_POST['descripcion'], $_POST['palabra1'], $_POST['palabra2'], $_POST['palabra3'], $_FILES['sentfile'], $_POST['precio'], $objPos, $error, $db);
    
   

    if(isset($_POST['privada']))
    {
        $privada = "1";
    }
    else
    {
        $privada = "0";
    }   

    if(empty($error))
    {
        
        $pic = @$_FILES['sentfile'];    
        if ($_FILES['sentfile']['size'] > 0) 
        {
            //extencion de archivo
            $profile_pic_name = @$_FILES['sentfile']['name'];
            $t = @$_FILES['sentfile']['size'];
            $vol_archi = round($t / 1024, 2);
            
            $file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
            $file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));
            
            if (((@$_FILES['sentfile']['type']=='image/jpeg') || (@$_FILES['sentfile']['type']=='image/png') || (@$_FILES['sentfile']['type']=='image/gif')) && (@$_FILES['sentfile']['size'] < 5000000))
            {
                $chare = $user;
                if (!file_exists("../userdata/profile_pics/$chare")) 
                {
                    mkdir("../userdata/profile_pics/$chare");
                }
                
                $filename = strtotime(date('Y-m-d H:i:s')) . $file_ext;
                
                if (file_exists("../userdata/profile_pics/$chare/".@$_FILES["sentfile"]["name"])) 
                {
                    $error[]= "ya existe ".@$_FILES["sentfile"]["name"]." Sube otra!";
		        }
                else 
                {
                    
                    $added_by = $user;
                    $titulo = $objPos->getTitulo();
                    $categoria = $objPos->getCategoria();
                    $donde = $objPos->getDonde();
                    $descripcion = $objPos->getDescription();
                    $claves = $objPos->getPalabra1();
                    $claves2 = $objPos->getPalabra2();
                    $claves3 = $objPos->getPalabra3();
                    $photos = "$chare/$filename";
                    $precio = $objPos->getPrecio();
                    
                  try 
                  {
            
			        $sqlCommand = "INSERT INTO posts (added_by, id_user, titulo,categoria,donde,description,palabra1,palabra2,palabra3,photos, precio,privado) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmtSubir = $db->prepare($sqlCommand);
                    $stmtSubir->bind_param('ssssssssssii', $added_by, $idUser, $titulo, $categoria, $donde, $descripcion, $claves, $claves2, $claves3, $photos, $precio, $privada);
                    
                    if($stmtSubir->execute())
                    {
                        //mover archivo...
                        move_uploaded_file(@$_FILES["sentfile"]["tmp_name"], "../userdata/profile_pics/$chare/".$filename);
                        
                        //marca de agua...                        
                        include('../controller/MarcaDeAguaController.php');
                        
                        $file_name = "../userdata/profile_pics/".$photos;
                    
                        // Verificar que tipo de marca de agua esta seleccionado
                        if(isset($_POST['imagen_marca']) && $_POST['imagen_marca'] == 'texto_copyright')
                        {
                        // Añadir marca de agua de texto sobre la imagen
                        $watermark = "©Copyright"; // Añade marca de agua 
                        addTextWatermark($file_name, $watermark, $file_name);
                        }

                        if(isset($_POST['imagen_marca']) && $_POST['imagen_marca'] == 'texto_copyleft')
                        {
                        // Añadir marca de agua de texto sobre la imagen
                        $watermark = "@Copyleft"; // Añade marca de agua
                        addTextWatermark($file_name, $watermark, $file_name);
                        }

                        if(isset($_POST['imagen_marca']) && $_POST['imagen_marca'] == 'texto_creative')
                        {
                        // Añadir marca de agua de texto sobre la imagen
                        $watermark = "(CC)Creative"; // Añade marca de agua
                        addTextWatermark($file_name, $watermark, $file_name);
                        }

                        if(isset($_POST['imagen_marca']) && $_POST['imagen_marca'] == 'texto_fotaza')
                        {
                        // Añadir marca de agua de imagen sobre imagen
                        $WaterMark = '../img/fotaza.png';  // Añade marca de agua
                        addImageWatermark ($file_name, $WaterMark, $file_name, 30);
                        }
                        
                        
                        echo "<script>alert('Exito! foto publicada.')</script>";
                        header("Location: photo.php?u=$user");
                    }
                    else
                    {
                        $error2[]= "<p class='error_echo'>Fallo SUBIDA"; 
                        $error2[]= "<p class='error_echo'>Mensaje de Error: ".$db->error; 
                    }
                    
                    $stmtSubir->close();
                  
                  }
                  catch(Exception $e) 
                  {
                      $error2[] = $e->getMessage();
	              }
                }
            }
            else 
            {
                $error2[]= "<p class='error_echo'>¡Archivo inválido! Su imagen no debe tener más de 5 MB y debe ser un .jpg, .jpeg, .png o .gif</p>";
            }
        
        }
        else
        { 
            $error2[] = "<p class='error_echo'>Falta seleccionar Foto!"; 
        }
    
    }

}

?>
