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
</head>

<body style="background-color: #471831;">

    <?php
    
	if ($num == 1) 
    {

	include ( "header.php");
	include ( "aboutProfile.php");
    ?>
    <li style="float: right;">
        <div>
            <nav>
                <ul>
                    <?php
	               if ($username == $user) 
                    {
	               ?>
                    <li>
                        <a href="photo.php?u=<?php echo $username ?>">Fotos</a>
                    </li>
                    <li>
                        <a href="about.php?u=<?php echo $username ?>" style="background-color: #cdcdcd; color: #0b810b">Datos</a>
                    </li>
                    <?php }?>
                </ul>
            </nav>
        </div>

    </li>
    </div>
    </div>

    <?php
	if ($username == $user) 
    {
	?>
    <div class="uiaccountstyle" style="text-align: left; height: auto; width: 507px; padding: 25px; margin: 15px auto;">
        <div>
            <p style="font-size: 13px; font-weight: bold; color: #959695;">TRABAJO & EDUCACION
                <?php
				if ($user==$username) 
                {
					echo '<a href="workedu_update.php" style="float: right; text-decoration: none; font-size: 12px; color: #0B810B">Editar</a>';	
				}
                else 
                { }
                ?>
            </p>

            <hr style="background-color: #ddd;">

            <p style="font-size: 15px; margin-left: 25px; font-weight: bold; color: #0B810B;">
                <?php echo $user_company ?>
                <br>
            </p>
            <p style=" font-weight: bold; margin-left: 25px; ">
                <?php echo $user_position ?>
                <br>
            </p>
            <br>
            <p style="font-size: 15px; margin-left: 25px; font-weight: bold; color: #0B810B;">
                <?php echo $school_name_user ?>
                <br>
            </p>
            <p style=" font-weight: bold; margin-left: 25px; ">
                <?php echo $concentration_name_user ?>
                <br>
            </p>
        </div>
        <div>
            <br>
            <p style="font-size: 13px; font-weight: bold; color: #959695;">TELEFONO & EMAIL
                <?php
				if ($user==$username) 
                {
					echo '<a href="cbinfo_update.php" style="float: right; text-decoration: none; font-size: 12px; color: #0B810B">Editar</a>';	
				}
                else 
                { } 
                ?>
            </p>
            <hr style="background-color: #ddd;">
            <p style="font-size: 15px; margin-left: 25px; font-weight: bold; color: #0B810B;">
                <?php echo $user_mobile ?>
            </p>
            <p style=" font-weight: bold; margin-left: 25px; ">
                Tel.
            </p>
            <br>
            <p style="font-size: 15px; margin-left: 25px; font-weight: bold; color: #0B810B;">
                <?php echo $user_pub_email ?>
            </p>
            <p style=" font-weight: bold; margin-left: 25px; ">
                Email Publico
            </p>
        </div>
        <div>
            <br>
            <p style="font-size: 13px; font-weight: bold; color: #959695;">LUGAR DE RECIDENCIA & ORIGEN
                <?php
                if ($user==$username) 
                {
                    echo '<a href="location_update.php" style="float: right; text-decoration: none; font-size: 12px; color: #0B810B">Editar</a>';
                }
                else 
                { } 
                ?>
            </p>
            <hr style="background-color: #ddd;">
            <p style="font-size: 15px; margin-left: 25px; font-weight: bold; color: #0B810B;">
                <?php echo $city_name_user ?>
            </p>
            <p style=" font-weight: bold; margin-left: 25px; ">
                Actual
            </p>
            <br>
            <p style="font-size: 15px; margin-left: 25px; font-weight: bold; color: #0B810B;">
                <?php echo $hometown_name_user ?>
            </p>
            <p style=" font-weight: bold; margin-left: 25px; ">
                Origen
            </p>
        </div>
        <div>
            <br>
            <p style="font-size: 13px; font-weight: bold; color: #959695;">DETALLES DE DATOS
                <?php
                if ($user==$username) 
                {
                    echo '<a href="details_update.php" style="float: right; text-decoration: none; font-size: 12px; color: #0B810B">Editar</a>';
                }
                else 
                { } 
                ?>
            </p>
            <hr style="background-color: #ddd;">
            <p style=" color: #0B810B; margin-left: 25px; font-size: 14px; line-height: 18px; ">
                <?php echo nl2br($user_bio) ?>
                <br>
            </p>
            <br>
            <p style="font-size: 13px; font-weight: bold; color: #959695;">
                Frase Favorita

                <?php
                if ($user==$username) 
                {
                    echo '<a href="details_update.php" style="float: right; text-decoration: none; font-size: 12px; color: #0B810B">Editar</a>';
                }
                else 
                { } 
                ?>
            </p>
            <hr style="background-color: #ddd;">
            <p style=" color: #0B810B; margin-left: 25px; font-size: 14px; line-height: 18px; ">
                <?php echo nl2br($user_queote) ?>
            </p>
        </div>
    </div>
    <?php
                    
      }
      else 
      {
        echo "<p style='text-align: center; color: #4A4848; margin: 30px; font-weight: bold; font-size: 36px;'>Disculpe! nada para ver.</p>";
      }
    }
    else 
    {
        header("location: profile.php?u=$user");
    }

    ?>
    <br><br>
</body>

</html>
