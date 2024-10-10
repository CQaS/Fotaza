<?php

if(!isset($_SESSION['user_login']))
{
    header('location: ../index.php');
}

?>

<div class="prifile_cov" style="background: url(<?php echo $cover_pic; ?>) repeat center center;">
    <div style="width: 100%; height: 280px;">
        <div style="width: 960px; padding-top: 55px; margin: 0 auto;">
            <ul>
                <li>
                    <div class="u_profile" style="background: url(<?php echo $profile_pi; ?>) repeat;"></div>
                </li>
                <li style="float: left; margin: 84px 0 0 24px; text-shadow: 0px 0px 7px #000; text-align: center;">
                    <ul style="line-height: 1.3;">
                        <?php 
				        if ($verify_id_user == 'yes') 
                        {
                            echo '<span style="font-size: 25px; margin-right: 8px; float: left; font-weight: 800; color: #ffffff">'.$first_name_user.'</span>
                            <div class="verifiedicon" style="background: url(../img/verifiLogo.png) repeat; background-size: cover !important;" title="Verified profile">
                            </div>';
				        }
                        else 
                        {
                            echo '<span style="font-size: 25px; margin-right: 13px; float: left; font-weight: 800; color: #ffffff">'.$first_name_user.'</span>';
				        }
				        ?>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="profileMainmenu">
    <div>
        <ul style="width: 900px; margin: 0 auto;">
            <li style="float: left; padding: 8px 0;">
                <form action="" method="POST">
                    <?php
					if ($user == $username) 
                    {
						echo "<button value='button' name='updateProfile' class='frndPokMsg'>Editar tu Perfil</button>";
					}
					?>
                </form>

            </li>
