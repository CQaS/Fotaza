<?php 
require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection(); 

require "post_likes.php";

ob_start();
session_start();

$objLike = new NuevoLike($_SESSION['user_login'], $_POST['id']);


$u = $objLike->getUser_name();
$p = $objLike->getPost_id();

$countLs = "SELECT * FROM post_likes WHERE post_id = ? AND estado = 1";
$stmtCLs = $db->prepare($countLs);
$stmtCLs->bind_param('i', $p);
$stmtCLs->execute();
$countLike = $stmtCLs->get_result();

$cLikes = $countLike->num_rows;


$countLike = "SELECT * FROM post_likes WHERE user_name = ? AND post_id = ?";
$stmtCL = $db->prepare($countLike);
$stmtCL->bind_param('si', $u, $p);
$stmtCL->execute();
$countLikes = $stmtCL->get_result();

$cLike = $countLikes->num_rows;
$row = $countLikes->fetch_array();

if($cLike == 0) 
{
    $insertLike = "INSERT INTO post_likes (user_name,post_id) VALUES (?, ?)";
    $stmtIL = $db->prepare($insertLike);
    $stmtIL->bind_param('si', $u, $p);
    $stmtIL->execute();
    $stmtIL->close();
    
    $cLikes = $cLikes+1;    
    $megusta = "<img src='../img/me-gusta2.png'>(Tu y ".$cLikes."+!)";
    
} 
else
{
    
    if($row['estado'] == 1)
    {
        $baja = "UPDATE post_likes SET estado = '0' WHERE user_name = ? AND post_id = ?";
        $stmtBaja = $db->prepare($baja);
        $stmtBaja->bind_param('si', $u, $p);
        $stmtBaja->execute();
        $stmtBaja->close();
        
        $cLikes = $cLikes-1;
        $megusta = "<img src='../img/me-gusta.png'>(".$cLikes." mas!)";
    }
    else
    {
        $alta = "UPDATE post_likes SET estado = '1' WHERE user_name = ? AND post_id = ?";
        $stmtAlta = $db->prepare($alta);
        $stmtAlta->bind_param('si', $u, $p);
        $stmtAlta->execute();
        $stmtAlta->close();
        
        $cLikes = $cLikes+1;
        $megusta = "<img src='../img/me-gusta2.png'>(Tu y ".$cLikes."+!)";
    }
}
$stmtCL->close();
$stmtCLs->close();

$return = array("img"=>$megusta);

echo json_encode($return);

?>
