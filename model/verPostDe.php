<?php
require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

ob_start();
session_start();

$user = $_SESSION['user_login'];

$username ="";
$firstname ="";
if (isset($_GET['u']) && $_GET['u'] != $user) 
{
    $username = $db->real_escape_string($_GET['u']);
    
    
    if (ctype_alnum($username)) 
    {
        
        $chec = "SELECT * FROM users WHERE username= ?";
        $stmtChe = $db->prepare($chec);
        $stmtChe->bind_param('s', $username);
        $stmtChe->execute();
        $check = $stmtChe->get_result();
        $stmtChe->close();
        
        $chec = $check->num_rows;
        
        if ($chec ==1) 
        {
            $get = $check->fetch_assoc();
			$title_fname = $get['first_name'];
            
            $getposts = "SELECT * FROM posts WHERE added_by = ? AND estado='1' ORDER BY id DESC LIMIT 2";
            $stmtGet = $db->prepare($getposts);
            $stmtGet->bind_param('s', $username);
            $stmtGet->execute();
            $getposts = $stmtGet->get_result();
            $stmtGet->close();
            
            $posteos = $getposts->num_rows;
        
        }
        else
        {
            echo "<script>alert('Usuario inexistente!')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        }
    }
    
}
else
{
    header('location: ../index.php');
}

?>
