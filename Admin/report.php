<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) 
{
	header('location: login.php');
}
	$user = $_SESSION['admin_user'];
    
    include "conn/connect.php";
    $query = "SELECT * FROM posts WHERE report='1' ORDER BY id DESC";
    $run = $mysqli->query($query);
    $num = $run->num_rows;

?>
<!DOCTYPE html>
<html>

<head>
    <title>Listar Reportes</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
                        <h1>Ver Reportes de Posteos</h1>
                    </a>
                </th>
                <th class="search">
                    <form action="search.php" method="get">
                        <input type="text" id="search" name="keywords" placeholder="Search..." />
                        <select name="topic" class="search_topic">
                            <option>Selec.</option>
                            <option>Usuario</option>
                            <option>Posteo</option>
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
                <th style="background-color: #b51326;"><a href="report.php">
                        <h1>Reportes</h1>
                    </a></th>
                <th><a href="logout.php">
                        <h1 style="color: #292929;">Logout</h1>
                    </a></th>
            </tr>
        </table>
        <div class="">
            <center>
                <div class="container">
                    <table class="table table-striped table-bordered table-hover table-dark">
                        <thead class="table-danger">
                            <tr style="font-weight: bold;" colspan="10">
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Agregado por</th>
                                <th>Descripcion</th>
                                <th>Report</th>
                                <th></th>
                            </tr>
                        </thead>

                        <?php            
    
                        while ($row = $run->fetch_assoc())
                        {
                        $id = $row['id'];
                        $date_added = $row['post_time'];
                        $added_by = $row['added_by'];
                        $descripcion = $row['description'];
                        $report = $row['report'];
                        ?>
                        <tr bgcolor="#3f396a">
                            <th><?php echo $id; ?></th>
                            <th><?php echo $date_added; ?></th>
                            <th><?php echo $added_by; ?></th>
                            <th><?php echo $descripcion; ?></th>
                            <th><?php echo $report; ?></th>
                            <th class="editpost"><a class="btn btn-primary" href="viewfullPost.php?post=<?php echo $id; ?>">Ver</a></th>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </center>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>
