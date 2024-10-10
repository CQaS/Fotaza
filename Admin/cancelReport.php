<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) 
{
	header('location: login.php');
}
else 
{
	$user = $_SESSION['admin_user'];
    
    include "conn/connect.php";
    

    if (isset($_REQUEST['pid'])) 
    {
	   $id = $_REQUEST['pid'];

	   //cancel report
	   $result = "UPDATE posts SET report='0' WHERE id='$id'";
	   if ($mysqli->query($result)) 
       {
		  echo "<script>alert('Se cancela el Reporte.')</script>";
		  echo "<script>window.open('report.php','_self')</script>";
	   }
    } 
} 

?>