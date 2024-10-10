<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) 
{
	header('location: login.php');
}
	$user = $_SESSION['admin_user'];

include "conn/connect.php"; 
if (isset($_REQUEST['dpid'])) 
{
	$id = $_REQUEST['dpid'];
	//borrar post
	$delete = "UPDATE posts p, post_comments c, post_likes l, valoracion v
        SET p.estado = '0', c.estado = '0', l.estado = '0', v.estado = '0'
        WHERE p.id = ? AND c.post_id = ? AND l.post_id = ? AND v.post_id = ?";
    $stmtDel = $mysqli->prepare($delete);
    $stmtDel->bind_param('iiii', $id, $id, $id, $id);
    $stmtDel->execute();
    $get_file = $stmtDel->get_result();
    $stmtDel->close();
   
    echo "<script>alert('Se Elimino el Posteo.')</script>";
    echo "<script>window.open('posts.php','_self')</script>";
}
else
{
    echo "<script>alert('Faltan algun dato.')</script>";
    echo "<script>window.open('posts.php','_self')</script>";
}

?>