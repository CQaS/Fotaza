<?php 
require_once("../controller/MasterController.php");
$gets=new MasterController();
$res=$gets->getPerfilDetalles();

include_once $res;

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $firstname; ?> • Fotaza</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" href="../css/fotoEffectHover.css">
    <script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
</head>

<body style="background-color: #471831;">

    <?php include "header.php"; ?>
    <div>

        <?php include "aboutProfile.php"; ?>

        <li style="float: right;">


            <div>
                <nav>
                    <ul>
                        <li>
                            <a href="photo.php?u=<?php echo $username ?>" style="background-color: #cdcdcd; color: #0b810b">Foto</a>
                        </li>
                        <li>
                            <a href="about.php?u=<?php echo $username ?>">Datos</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </li>
    </div>
    </div>
    <div style="max-width: 920px; margin-bottom:50px; margin-left: 60px;">
        <?php 
		if ($username == $user) 
        {
        ?>
            <center><br>
                <a href="subir.php" style=" margin: 17px 90px 17px 17px;" title="Subir Fotos">
                    <img src="../img/up.png" style="margin-right:90px; padding: 0 5px;" height="70" width="70">
                    <br><br>
                    <span style="color: #f1f1f4; font-size: 20px;">
                        Subir nuevos Posteos!!!
                    </span>
                </a>
                <br><br><br>
            </center>

            <div class="contenedor">
            <?php
        
                    if($gets > 0)
                    {
                        while ($row = $getpost->fetch_assoc()) 
                        {
                            $id = $row['id'];
                            
							$photos_db = $row['photos'];
							$photos = "../userdata/profile_pics/".$photos_db;
                        
                            echo '<a href="viewPost.php?pid='.$id.'">
                                    <div class="box">
                                        <div class="imgbox">
                                            <img src="'.$photos.'" alt="">
                                        </div>
                                        <div class="content">
                                            <div>
                                                <h2>'.$row['titulo'].'</h2>
                                                <p>'.$row['description'].'</p>
                                            </div>
                                        </div>
                                    </div>
                                  </a>';
                        } 
				    }
                    
        }
        else
        {
            echo "<p style='text-align: center; color: #4A4848; margin: 30px; font-weight: bold; font-size: 36px;'>Disculpe! nada para ver.</p>";
        }
        ?>
        </div>
    </div>

</body>

</html>
