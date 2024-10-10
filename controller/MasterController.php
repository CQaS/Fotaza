<?php 

class MasterController
{
    
    //trae los post en la vista sin loguear
    public function getIndexnoRe()
    {        
        $getIndexnoRe = '../model/todoPost.php';
        
        return $getIndexnoRe;
    }
    
    //loguea
    public function getLog()
    {        
        $getLog = '../model/log.php';
        
        return $getLog;
    }
    
    //limpiar log y pass...
    public function limpiarInputLogin($log, $pass, &$objUs, &$RegistroOK, $db)
    {
        
        $user_login = $db->real_escape_string($log);
        $user_login = trim($user_login);
        $password_login = $db->real_escape_string($pass);
        $password_login = trim($password_login);
        
        if(!preg_match("/^[a-zA-Z-ñáéíóú\s]*$/",$password_login))
        {
            $RegistroOK = '
                <h2><font face="bookman">Alerta!!!</font></h2>
				<button type="button" class="btn btn-labeled btn-success" style="pointer-events: none;">
                <span class="btn-label"><i class="fa fa-thumbs-down"></i></span>Login o Pass incorrecto!</button>';
        }
        else
        {
            require "../model/users.php";
            $objUs = new LoginUsuario($user_login, $password_login);
        
        }
    }
    
    //recuperar password
    public function getPass(){
        
        $getPass = '../model/recuperaPass.php';
        
        return $getPass;
    }
    
    //trae los post en Home
    public function getHome(){
        
        $getHome = '../model/home.php';
        
        return $getHome;
    }
    
    //trae las noticias
    public function getNoticiasModel(){
        
        $getNoticiasModel = '../model/noticias.php';
        
        return $getNoticiasModel;
    }
    
    public function getNoticiasView(){
        
        $getNoticiasView = '../view/noticias.php';
        
        return $getNoticiasView;
    }
    
    //detalles de un posteo
    public function verPost(){
        
        $verPost = '../model/verPost.php';
        
        return $verPost;
    }
    
    //listar posteos de otro usuario
    public function verPostDe(){
        
        $verPostDe = '../model/verPostDe.php';
        
        return $verPostDe;
    }
    
    //subir posteos
    public function subirPost(){
        
        $subir = '../model/subir.php';
        
        return $subir;
    }
    
    //validar posteos
    public function validarPost($titulo, $categoria, $donde, $descripcion, $palabra1, $palabra2, $palabra3, $sentfile, $precio, &$objPos, &$error, $db)
    {
        $error = [];
        
        if(isset($titulo) && $titulo !="")
        {
            $titulo =  trim($titulo);
            $titulo = $db->real_escape_string($titulo);
        
            if (!preg_match("/^[a-zA-Z ]*$/",$titulo)) 
            {
                $error[] = "<p class='error_echo'>Solo se permiten letras en Titulo";
            }
        }
        else
        {
            $error[]= "<p class='error_echo'>¡Falta el Titulo!</p>";
        }
    
        if(!isset($categoria) || $categoria == "Selecciona")
        {
            $error[]= "<p class='error_echo'>¡Faltan la Categoria!</p>";
        }
    
        if(isset($donde) && $donde !="")
        {
            $donde =  trim($donde);
            $donde = $db->real_escape_string($donde);
        
            if (!preg_match("/^[a-zA-Z-ñáéíóú\s]*$/",$donde))
            {
                $error[] = "<p class='error_echo'>Solo se permiten letras en Donde"; 
            }
        
        }
        else
        {
            $error[]= "<p class='error_echo'>¡Faltan en Donde es?!</p>";
        }
    
        if(isset($descripcion) && $descripcion !="")
        {
            $descripcion =  trim($descripcion);
            $descripcion = $db->real_escape_string($descripcion);
        
            if (!preg_match("/^[a-zA-Z-ñáéíóú\s]*$/",$descripcion))
            {
                $error[] = "<p class='error_echo'>Solo se permiten letras en Descripcion"; 
            }
        
        }
        else
        {
            $error[]= "<p class='error_echo'>¡Faltan Descripcion?!</p>";
        }
    
        if(isset($precio) && $precio !="")
        {
            $precio =  trim($precio);
            $precio = $db->real_escape_string($precio);
        
            if (!is_numeric($precio))
            {
                $error = "Solo se permiten numeros en Precio"; 
            }
        
        }
        else
        {
            $error[]= "<p class='error_echo'>¡Falta el Precio?!</p>";
        }
    
        if(isset($palabra1) && $palabra1 !="" && isset($palabra2) && $palabra2 !="" && isset($palabra3) && $palabra3 !="")
        {
            $palabra1 =  trim($palabra1);
            $palabra1 = $db->real_escape_string($palabra1);
        
            if (!preg_match("/^[a-zA-Z ]*$/",$palabra1)) 
            {
                $error[] = "<p class='error_echo'>Solo se permiten letras en Palabras palabra"; 
            }
        
            
            $palabra2 =  trim($palabra2);
            $palabra2 = $db->real_escape_string($palabra2);
        
            if (!preg_match("/^[a-zA-Z ]*$/",$palabra2)) 
            {
                $error[] = "<p class='error_echo'>Solo se permiten letras en Palabras palabra"; 
            }
        
            
            $palabra3 =  trim($palabra3);
            $palabra3 = $db->real_escape_string($palabra3);
        
            if (!preg_match("/^[a-zA-Z ]*$/",$palabra3)) 
            {
                    $error[] = "<p class='error_echo'>Solo se permiten letras en Palabras claves"; 
            }
        
        }
        else
        {
            $error[]= "<p class='error_echo'>¡Faltan Palabras Claves?!</p>";
        }
        
        if(empty($error))
        {
            require "../model/posts.php";
            $objPos = new NuevoPosts($titulo, $categoria, $donde, $descripcion, $palabra1, $palabra2, $palabra3, $sentfile, $precio);
        
        }
                            
                            
    }
    
    //trae los detalles del perfil logueado
    public function getPerfilDetalles(){
        
        $getPerfilDetalles = '../model/perfilDetalles.php';
        
        return $getPerfilDetalles;
    }
    
    //comentarios
    public function getComentarios(){
        
        $getComentario = '../model/comentarios.php';
        
        return $getComentario;
    }
    
    //limpiar comentario...
    public function limpiarComentario($post_body, $user_login, $added_by, $id, &$obMsg, $db)
    {
        $post_body = $db->real_escape_string($post_body);
	    $post_body = trim($post_body);
        
        require "../model/post_comments.php";
        $obMsg = new NuevoComentario($post_body, $user_login, $added_by, $id);
    }
    
    
    //Buscar por Usuario o Post
    static function search()
    {
        if($_GET['keywords'] == NULL && $_GET['topic'] != "Selec."){
            header("location: ../index");
        }else if($_GET['keywords'] != NULL && $_GET['topic'] == "Selec."){
            header("location: ../index");
        }else if ($_GET['keywords'] == NULL && $_GET['topic'] == "Selec.") {
			header("location: ../index");
		}else if ($_GET['keywords'] != NULL && $_GET['topic'] != "Selec.") { $ok = "ok"; }
        
        if ($ok == "ok" && $_GET['topic'] == "User") 
        {
                    
                include_once "../model/getUser.php";
			
        }
        
        if ($ok == "ok" && $_GET['topic'] == "Post") 
        {
            
                
				include_once "../model/getPost.php";    
        }        
       	        
    }
    
    //actualizar perfil
    public function actualizar()
    {
        $actualizar = '../model/editaPerfil.php';
        
        return $actualizar;
    }
}

?>
