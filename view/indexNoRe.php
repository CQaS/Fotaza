<?php

require_once("../controller/MasterController.php");
$gets = new MasterController();
$res = $gets->getIndexnoRe();

ob_start();
session_start();

if (isset($_SESSION['user_login'])) 
{
	header('location: home.php');
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Fotaza</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="../js/body.js"></script>
</head>

<body style="background-color: #38212d;">

    <?php include "headernore.php"; ?>

    <div class="search_body">
        <center>
            <div class="search_nav">
                <ul class="search_nav_menu"></ul>
            </div>
            <br><br>
            <?php
                
                include_once $res;
                
                ?>
        </center>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="../js/siguienteIndex.js"></script>
</body>

</html>
