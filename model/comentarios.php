<?php

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

require "posts.php";

ob_start();
session_start();
if (!isset($_SESSION['user_login']) && !isset($_REQUEST['id'])) 
{
	header('location: ../index.php');
}
else 
{
	$user = $_SESSION['user_login'];
    if(isset($_REQUEST['id'])){ $getid = $_REQUEST['id']; }
}

//eliminar comentario...
if (isset($_REQUEST['delCom']) && isset($_REQUEST['pId'])) 
{
	$id = $_REQUEST['delCom'];
    $getid = $_REQUEST['pId'];
	
    //delete
    $delete = "UPDATE post_comments SET estado = '0' WHERE id = ? ";
    $stmtDel = $db->prepare($delete);
    $stmtDel->bind_param('i', $id);
    $stmtDel->execute();
    $stmtDel->get_result();
    $stmtDel->close();
	
}

//insert comentario....
if (isset($_POST['post_body']) && $_POST['post_body'] != "")
{
    if (isset($_POST['postComment' . $getid . '']))
    {
    
        $query = "SELECT added_by FROM posts WHERE id= ?  AND estado='1'";
        $stmtquery = $db->prepare($query);
        $stmtquery->bind_param('i', $getid);
        $stmtquery->execute();
        $query = $stmtquery->get_result();
        $stmtquery->close();
            
        $query_row = $query->fetch_assoc();
        $posted_to = $query_row['added_by'];
            
        $post_body = $_POST['post_body'];
            
        $gets->limpiarComentario($_POST['post_body'], $_SESSION['user_login'], $query_row['added_by'], $_REQUEST['id'], $obMsg, $db);
            
        $a = $obMsg->getPost_body();
        $b = $obMsg->getPosted_by();
        $c = $obMsg->getPosted_to();
        $d = $obMsg->getPost_id();
            
        $insertPost = "INSERT INTO post_comments(post_body, posted_by, posted_to, post_id) VALUES (? , ? , ?, ?)";
        $stmtIp = $db->prepare($insertPost);
        $stmtIp->bind_param('sssi', $a,$b,$c,$d);
        $stmtIp->execute();
        $stmtIp->close();
            
    }
}

//Get comentarios
$get_comments = "SELECT * FROM post_comments WHERE post_id= ? AND estado='1' ORDER BY id DESC";
$stmtComent = $db->prepare($get_comments);
$stmtComent->bind_param('i', $getid);
$stmtComent->execute();
$get_comments = $stmtComent->get_result();
$stmtComent->close();

$count = $get_comments->num_rows;

?>
