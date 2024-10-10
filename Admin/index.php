<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) 
{
	header('location: login.php');
}
	$user = $_SESSION['admin_user'];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="adminStyle.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('body').on('keydown', '#search', function(e) {
                console.log(this.value);
                if (e.which === 32 && e.target.selectionStart === 0) {
                    return false;
                }
            });
        });

    </script>
</head>

<body>
    <div class="main">
        <table class="adminHeader">
            <tr>
                <th>
                    <a href="index.php">
                        <h1>Admin Panel</h1>
                    </a>
                </th>
                <th class="search">
                    <form action="search.php" method="get">
                        <input type="text" id="search" name="keywords" placeholder="Buscar..." />
                        <select name="topic" class="search_topic">
                            <option value="usuario">Usuario</option>
                            <option value="posteos">Posteos</option>
                        </select>
                        <button type="submit" name="search"><img src="../img/search.png" style="margin: 0 0 -12px 1px; padding: 0;" height="33" width="33"></button>
                    </form>
                </th>
            </tr>
        </table>
        <table class="adminmenu">
            <tr>
                <th><a href="users.php">
                        <h1>Usuario</h1>
                    </a></th>
                <th><a href="posts.php">
                        <h1>Posteos</h1>
                    </a></th>
                <th><a href="postEliminados.php">
                        <h1>Posteo Eliminados</h1>
                    </a></th>
                <th><a href="report.php">
                        <h1>Reportes</h1>
                    </a></th>
                <th><a href="logout.php">
                        <h1 style="color: #292929;">Logout</h1>
                    </a></th>
            </tr>
        </table>
        <div class="welcomeContent">
            <p>Bienvenido <?php echo "** ".$user." **"; ?></p>
            <p>Seccion de Administracion de cuentas en Fotaza</p>
        </div>
    </div>
</body>

</html>
