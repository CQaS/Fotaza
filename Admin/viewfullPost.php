<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) 
{
	header('location: login.php');
}
	$user = $_SESSION['admin_user'];
 
if (isset($_REQUEST['post'])) 
{
	$postid = $_REQUEST['post'];
}
else 
{
	header('location: index.php');
}

include "conn/connect.php";

$getposts = "SELECT * FROM posts WHERE id = ?";
$stmtQ = $mysqli->prepare($getposts);
$stmtQ->bind_param('i', $postid);
$stmtQ->execute();
$getposts = $stmtQ->get_result();
$stmtQ->close();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Ver Posteo</title>
    <link rel="stylesheet" type="text/css" href="adminStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="adminStyle.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

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
    <script type="text/javascript">
        $(function() {
            $('body').on('keydown', '#post', function(e) {
                console.log(this.value);
                if (e.which === 32 && e.target.selectionStart === 0) {
                    return false;
                }
            });
        });

    </script>
    <script type="text/javascript">
        function confirm_delete() {
            return confirm('Quieres eliminar?');
        }

    </script>
    <script type="text/javascript">
        function confirm_report() {
            return confirm('Quieres reportar?');
        }

    </script>
</head>

<body style="background-color: #471831;">
    <div class="main">
        <table class="adminHeader">
            <tr>
                <th>
                    <a href="index.php">
                        <h1>Ver Posteos</h1>
                    </a>
                </th>
                <th class="search">
                    <form action="search.php" method="get">
                        <input type="text" id="search" name="keywords" placeholder="Buscar..." />
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
                <th style="background-color: #686B68;"><a href="posts.php">
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
        <div class="rightsidemenu">

            <div style='max-width: 960px; margin: 0 auto;'>
                <div class='profilePosts' style='margin: 15px auto' ;>
                    <?php 	
		
		while ($row = $getposts->fetch_assoc()) 
        {
				$id = $row['id'];
                $precio = $row['precio'];
				$date_added = $row['post_time'];
				$added_by = $row['added_by'];
				$discription = $row['description'];
				$photos_db = $row['photos'];
				$report_db = $row['report'];
				$photos = "../userdata/profile_pics/".$photos_db;
				$get_posted_to_info = $mysqli->query("SELECT * FROM users WHERE username='$added_by'");
				$get_posted_info = $get_posted_to_info->fetch_assoc();
				$posted_to_fname = $get_posted_info['first_name'];
				$get_user_info = $mysqli->query("SELECT * FROM users WHERE username='$added_by'");
				$get_info = $get_user_info->fetch_assoc();
				$profilepic_info = $get_info['foto_perfil'];
				$add_by_fname = $get_info['first_name'];
				
				//count comment
				$get_comments = $mysqli->query("SELECT * FROM post_comments WHERE post_id='$id' ORDER BY id DESC");
				$count = $get_comments->num_rows;
				//getting all like
				$get_like = $mysqli->query("SELECT * FROM post_likes WHERE post_id='$id' ORDER BY id DESC");
				$count_like = $get_like->num_rows;
            
				
				echo "<div class='postBody post_search_result_box'>";
				if ($profilepic_info == "") 
                {
				    echo "<div style='float: left; margin-left: 10px;'>
                            <img src='../img/default_propic.png' style= 'border-radius: 22px'; title=\"$added_by\" height='45' width='45'  />
                          </div>";
				}
                else 
                {
				    echo "<div style='float: left; margin-left: 10px;'>
                            <img src='../userdata/profile_pics/$profilepic_info' style= 'border-radius: 22px'; title=\"$added_by\" height='45' width='45' />
                          </div>";
				}
				
                
				echo "<div class='posted_by'>
                        <a href='editUsers.php?user=$added_by' title=\"$added_by\">$add_by_fname</a> - 
                        <span style='color: #9E9E9E; font-weight: normal;'>$discription</span>
                            <br><br>$date_added
                            <div style='float: right;'>";
                            
                         
                        if($precio != null)
                        { 
                            echo "Precio: $$ ".$precio; 
                        }
                        else
                        { 
                            echo "Sin valor!";
                        } 
                        
                        echo "</div>
                     </div>";
				
							
                echo "<div class='posted_body'>";
									
                echo "<img src='".$photos."' style=' max-width: 530px; width: 100%; margin-top: 5px; border: 1px solid #ddd;' />";
				
                echo "</div>
						<br><hr />
				        <div class='likeComShare'>
				        <a href='like.php?pid=".$id."' >Like ($count_like)</a>";
								
				echo "<a class='btn btn-danger' onclick='return confirm_delete();' href='deletePost.php?dpid=".$id."' >Borrar</a>";
								
                if ($report_db == 1) 
                {
				    echo "<div style='float: right;'><a class='btn btn-danger' onclick='return cancel_report();' href='cancelReport.php?pid=".$id."' >Cancelar</a></div>";
								
                }
                else
                { 
                    echo "<div style='float: right;'>Sin Reportes!</div>";
                }
				
                echo "</div>
				    </div>";
            }
		 ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
