<?php 

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) 
{
	header('location: view/indexnore.php');
}
else 
{
	$user = $_SESSION['user_login'];
}

$consulta = "UPDATE users SET chatOnlineTime=now() WHERE username = ?";
$stmtChatOnLine = $db->prepare($consulta);
$stmtChatOnLine->bind_param("s", $user);
$stmtChatOnLine->execute();
$stmtChatOnLine->close();

$username ="";

if (isset($_GET['u'])) 
{
	$username = $db->real_escape_string($_GET['u']);
	if (ctype_alnum($username)) 
    {
		
		$check = "SELECT username, first_name FROM users WHERE username = ?";
        $stmtCheck = $db->prepare($check);
        $stmtCheck->bind_param("s", $username);
        $stmtCheck->execute();
        $resu = $stmtCheck->get_result();
        
        $cont = $resu->num_rows;
        
		if ($cont==1) 
        {
			$get = $resu->fetch_assoc();
			$username = $get['username'];
		}
		else 
        {
			die();
		}
        $stmtCheck->close();
	}
}

        $check_cov = "SELECT cover_pic, foto_perfil, first_name FROM users WHERE username= ?";
        $stmt_cov = $db->prepare($check_cov);
        $stmt_cov->bind_param('s', $user);
        $stmt_cov->execute();
        $res = $stmt_cov->get_result();

        $get_pic_row = $res->fetch_assoc();
        $cover_pic_db = $get_pic_row['cover_pic'];
        $profile_pic_d = $get_pic_row['foto_perfil'];
        $first_name_user = $get_pic_row['first_name'];

    //Comprueba si el usuario ha subido una foto de portada o no

        if(empty($cover_pic_db))
        {
			$cover_pic= "../img/default_covpic.png";
		}
        else 
        {
            
			$cover_pic = "../userdata/profile_pics/".$cover_pic_db;
		}		

    //Comprueba si el usuario ha subido una foto de perfil o no
    
        if (!empty($profile_pic_d)) 
        {
            $profile_fot = "../userdata/profile_pics/".$profile_pic_d;
		}
        else 
        {
            $profile_fot = "../img/default_propic.png";
		}

    //logout
        if (isset($_POST['logout'])) 
        {
	       header("location: logout.php");
        }
    //signup
        if (isset($_POST['signup'])) 
        {
	       header("location: signin.php");
        }

        $stmt_cov->close();


        //ver todos los Post... 
        $valMax = "SELECT p.id, p.added_by, p.titulo, p.categoria, p.donde, p.post_time, p.description, p.palabra1, p.palabra2, p.palabra3, p.precio, p.report, p.privado, p.estado, p.photos, AVG(v.valor) as POSTval FROM posts p, valoracion v WHERE p.id = v.post_id AND p.estado = 1 GROUP by v.post_id ORDER by POSTval DESC";
        $stmtvalMax = $db->prepare($valMax);
        $stmtvalMax->execute();
        $valMax = $stmtvalMax->get_result();
        $stmtvalMax->close();

        $posteosMax = $valMax->num_rows;

        //$getpost = "SELECT * FROM posts WHERE estado = '1' ORDER BY id DESC LIMIT 10";
        $getpost = "SELECT * FROM posts WHERE estado = '1' ORDER BY RAND()";
        $stmtGetPost = $db->prepare($getpost);
        $stmtGetPost->execute();
        $getposts = $stmtGetPost->get_result();
        $stmtGetPost->close();

        $posteos = $getposts->num_rows;

?>
