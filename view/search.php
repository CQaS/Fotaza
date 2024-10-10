<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) 
{
	header('location: ../view/signin.php');
}
else 
{
	$user = $_SESSION['user_login'];
}

if(isset($_GET['search']))
{
    
?>

<!DOCTYPE html>
<html>

<head>
    <title>Buscar • Fotaza</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".like").click(function() {

                var id = this.id; // obtenemos la id
                $.ajax({
                    url: '../model/like.php',
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        var img = data['img'];

                        $('#' + id).html(img);
                    }
                });

            });

        });

    </script>
    <script src="../js/body.js"></script>
    <style type="text/css">
        .uiloginbutton {
            float: right;
            color: #FFFFFF;
            background: #088A08;
            border: 1px solid #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-size: 17px;
            font-weight: bold;
            line-height: 15px;
            padding: 4px;
            text-align: center;
            text-decoration: none;
        }

    </style>
</head>

<body style="background-color: #471831;">

    <?php include "header.php"; ?>

    <div class="search_body">
        <center>
            <div class="search_nav">
                <ul class="search_nav_menu"></ul>
            </div>
            <br><br>
            <?php   
    
                    require_once "../Controller/MasterController.php";
                    MasterController::search();
    
                ?>
        </center>
    </div>

</body>

</html>


<?php }else{ header("location: ../index"); } ?>
