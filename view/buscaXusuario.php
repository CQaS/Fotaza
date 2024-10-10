<?php

if(!isset($_SESSION['user_login']))
{
    header('location: ../index.php');
}

?>

<?php $user = $_SESSION['user_login']; ?>

<div class="user_search_result_box">

    <div style="background: url(<?php echo $cover_pic ?>) repeat center center; height: 130px; width: 300px; border-radius: 2px;margin: -1px 0 0 -1px;background-size: cover !important; border-bottom: 1px solid #d3d6db;">

        <div class="coll1">
            <img src="<?php echo $profile_pic ?>" />
        </div>

        <?php 
        if ($user == $username) 
        { 
        ?>

        <div class="coll3">
            <form action="profile_update.php" method="POST">
                <button value="button" style="float: right; margin-top: 104px;" name="updateProfile">Editar Perfil</button>
            </form>
        </div>

        <?php 
        }
        else 
        { 
        ?>

        <div class="coll3" style="float: right; margin-top: 104px;">
            <form action="profile.php?u=<?php echo $username ?>" method="POST">
                <button value="button" name="viewProfile">Ver Perfil</button>
            </form>
        </div>

        <?php } ?>

    </div>

    <div class="coll2">

        <?php 
        if ($verify_id_user == 'yes') 
        { 
        ?>

        <span class="coll2_spn" style="margin-right: 3px; float: left;">
            <a href="profile?u=<?php echo $username ?>"><?php echo $first_name ?></a>
        </span>
        <div class="verifiedicon" style="background: url(../img/verifiLogo.png) repeat; background-size: cover !important; margin-top: -2px; width: 19px; height: 19px;" title="Perfil Verificado">
        </div>

        <?php 
        }
        else 
        {
            echo '<span class="coll2_spn"><a href="profile.php?u='.$username.'">'.$first_name.'</a></span>';
        } 
        ?>

    </div>

    <br><br>

    <div class="coll4">

        Trabajo: <span style="color: #0B810B;"><?php echo $company ?></span><br>

        Estudios: <span style="color: #0B810B;"><?php echo $school ?></span><br>

        Es de: <span style="color: #0B810B;"><?php echo $hometown ?></span> - Vive en: <span style="color: #0B810B;"><?php echo $city ?></span><br>

        E-mail Publico: <span style="color: #0B810B;"><?php echo $email_pub ?></span>

    </div>
</div>
