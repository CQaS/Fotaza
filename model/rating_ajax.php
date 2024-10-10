<?php
require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

require "valoracion.php";

ob_start();
session_start();

$objVal = new NuevaValoracion($_SESSION['user_login'], $_POST['postid'], $_POST['rating']);

// Check valoracion existente
$quer = "SELECT COUNT(*) AS cntpost FROM valoracion WHERE post_id= ? and user_name= ? AND estado = 1";
$a = $objVal->getUser_name();
$b = $objVal->getPost_id();

$stmtCh = $db->prepare($quer);
$stmtCh->bind_param('is', $b, $a);
$stmtCh->execute();
$fetchdata = $stmtCh->get_result();
$stmtCh->close();

$fetchdat = $fetchdata->fetch_assoc();
$count = $fetchdat['cntpost'];

if($count == 0)
{
    $insertquery = "INSERT INTO valoracion(user_name,post_id,valor) values(?, ?, ?)";
    $a = $objVal->getUser_name();
    $b = $objVal->getPost_id();
    $c = $objVal->getValor();
    
    $stmtIn= $db->prepare($insertquery);
    $stmtIn->bind_param('sii', $a, $b, $c);
    $stmtIn->execute();
    $stmtIn->close();
    
}

if($count == 1) 
{
    $updatequery = "UPDATE valoracion SET valor= ? where user_name= ? and post_id= ?";
    $a = $objVal->getUser_name();
    $b = $objVal->getPost_id();
    $c = $objVal->getValor();
    
    $stmtUp= $db->prepare($updatequery);
    $stmtUp->bind_param('isi', $c, $a, $b);
    $stmtUp->execute();
    $stmtUp->close();
}


//promedio de valoracion
$query = "SELECT ROUND(AVG(valor),1) as averageRating FROM valoracion WHERE post_id= ? AND estado = 1";
$b = $objVal->getPost_id();

$stmtProm = $db->prepare($query);
$stmtProm->bind_param('i', $b);
$stmtProm->execute();
$res = $stmtProm->get_result();
$stmtProm->close();

$fetchAverage = $res->fetch_array();
$averageRating = $fetchAverage['averageRating'];

$return_arr = array("averageRating"=>$averageRating);

echo json_encode($return_arr);
?>