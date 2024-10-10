<?php  
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) 
{
	header('location: signin.php');
}
else
{
    $user = $_SESSION['user_login'];
}
?>


<div class="headerLogin">
    <div class="login_menubar clearfix">
        <div class="menu_logo">
            <h1>
                <a title="Volver al Home" href="home.php">
                    <b>Fotaza</b>
                </a>
            </h1>
        </div>
        <div class="menu_login_container">
            <form action="home.php" method="POST">
                <table class="menu_login_container">
                    <tr class="login_">
                        <td>
                            <?php
							if (isset($user)) {
							echo '<input type="submit" name="login" class="uiloginbutton" style="margin-top: 17px;" value="Volver a Inicio">';
						}else {
							echo '
							<input type="submit" name="login" class="uiloginbutton" style="margin-top: 17px;" value="Volver / Crear">
							';
							
							}
						?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
