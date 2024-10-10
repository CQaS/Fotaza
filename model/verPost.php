<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) 
{
	header('location: signin.php');
}

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

if (isset($_REQUEST['pid'])) 
{
	
    $user = $_SESSION['user_login'];
	$id = $db->real_escape_string($_REQUEST['pid']);



//buscar post
$getpost = "SELECT * FROM posts WHERE id = ? AND estado = 1";
$stmtGetPost = $db->prepare($getpost);
$stmtGetPost->bind_param('i', $id);
$stmtGetPost->execute();
$getposts = $stmtGetPost->get_result();
$stmtGetPost->close();

$getposts_num = $getposts->num_rows;

if ($getposts_num == 0)
{
	echo "<script>alert('Post inexistente!')</script>";
    echo "<script>window.open('../index.php','_self')</script>";
}

$row = $getposts->fetch_assoc();
$id = $row['id'];
$date_added = $row['post_time'];
$added_by = $row['added_by'];
$titulo = $row['titulo'];
$categoria = $row['categoria'];
$donde = $row['donde'];
$descripcion = $row['description'];
$precio = $row['precio'];
$photos_db = $row['photos'];
$photos = "../userdata/profile_pics/".$photos_db;
    
$get_user_in = "SELECT * FROM users WHERE username= ?";
$stmtUI = $db->prepare($get_user_in);
$stmtUI->bind_param('s', $added_by);
$stmtUI->execute();
$get_user_info = $stmtUI->get_result();
$stmtUI->close();

$get_info = $get_user_info->fetch_assoc();
$profile_pic_db= $get_info['foto_perfil'];
$gender_user_db = $get_info['gender'];
$pub_email = $get_info['pub_email'];
$add_by = $get_info['first_name'];
$post_to_fname = $get_info['first_name'];
$profile_pic_d = $get_info['foto_perfil'];
    
    //foto pefil
    if (!empty($profile_pic_d)) 
    {
        $profile_pic = "../userdata/profile_pics/".$profile_pic_d;
    }
    else 
    {
        $profile_pic = "../img/default_propic.png";
    }

//Comentarios
$get_comment = "SELECT * FROM post_comments WHERE post_id= ? AND estado = 1 ORDER BY id DESC ";
$stmtGetCom = $db->prepare($get_comment);
$stmtGetCom->bind_param('i', $id);
$stmtGetCom->execute();
$get_comments = $stmtGetCom->get_result();
$stmtGetCom->close();

$count = $get_comments->num_rows;

//Likes
$get_likes = "SELECT * FROM post_likes WHERE post_id= ? AND estado = 1 ORDER BY id DESC";
$stmtGetLi = $db->prepare($get_likes);
$stmtGetLi->bind_param('i', $id);
$stmtGetLi->execute();
$get_like = $stmtGetLi->get_result();
$stmtGetLi->close();

$count_like = $get_like->num_rows;

    
//Like
$like_quer = "SELECT post_id FROM post_likes WHERE post_id= ?  AND estado='1'";
$stmtGetLik = $db->prepare($like_quer);
$stmtGetLik->bind_param('i', $id);
$stmtGetLik->execute();
$like_query = $stmtGetLik->get_result();
$stmtGetLik->close();

$like_count = $like_query->num_rows;

$like_us = "SELECT * FROM post_likes WHERE user_name= ? AND post_id= ? AND estado='1'";
$stmtGetLikU = $db->prepare($like_us);
$stmtGetLikU->bind_param('si', $user, $id);
$stmtGetLikU->execute();
$like_user = $stmtGetLikU->get_result();
$stmtGetLikU->close();

$like_count2 = $like_user->num_rows;

}
else if(isset($_REQUEST['e']))
{
    $user = $_SESSION['user_login'];
    $id = $_REQUEST['e'];
	//delete
	$get_file = "SELECT added_by FROM posts WHERE id= ?";
    $stmtDel = $db->prepare($get_file);
    $stmtDel->bind_param('i', $id);
    $stmtDel->execute();
    $get_file = $stmtDel->get_result();
    $stmtDel->close();
    
	$get_file_name = $get_file->fetch_assoc();
	$db_username = $get_file_name['added_by'];
    
	if($db_username == $user) 
    {
        /*DELIMITER $$

        CREATE TRIGGER post_delete BEFORE UPDATE ON posts
        FOR EACH ROW BEGIN
            INSERT INTO auditor_post_delete (id_del, titulo_del, username_del, decrip_del, foto_del, fecha_del) VALUES (OLD.id, OLD.titulo, OLD.added_by, OLD.description, OLD.photos, NOW());
        END
        $$

        DELIMITER ;*/
        
		$delete = "call deletePost(?)";
        $stmtDel = $db->prepare($delete);
        $stmtDel->bind_param('i', $id);
        
        if($stmtDel->execute())
        {
            echo "<script>alert('Publicacion Eliminda!.')</script>";
            echo "<script>window.open('../view/photo.php?u=$user','_self')</script>";
        }
        else
        {
            echo "<script>alert('Algo fallo!.')</script>";
            echo "<script>window.open('../view/photo.php?u=$user','_self')</script>";
        }
        $stmtDel->close();
        
	}
    else 
    {
		header('location: ../index.php');
	} 
}
else if(isset($_REQUEST['r']))
{
    $user = $_SESSION['user_login'];
    $id = $_REQUEST['r'];

	//report post
	$result = "UPDATE posts SET report='1' WHERE id= ? AND estado = 1";
	$stmtRe = $db->prepare($result);
    $stmtRe->bind_param('i', $id);
    
    
    if($stmtRe->execute())
    {
        echo "<script>alert('Publicacion Denunciada!.')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Algo fallo!.')</script>";
        echo "<script>window.open('../index.php','_self')</script>"; 
    }
    $stmtRe->close();
}
else
{
	header('location: ../index.php');
}

?>
