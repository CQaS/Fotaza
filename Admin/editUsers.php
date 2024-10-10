<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) 
{
	header('location: login.php');
}
	$user = $_SESSION['admin_user'];


    
    include "conn/connect.php";
    
    if (isset($_POST['updateinfo'])) 
    {
			$update_fname = strip_tags(@$_POST['edit_fname']);
			$update_verified = strip_tags(@$_POST['edit_verified']);
			$update_blocked = strip_tags(@$_POST['edit_blocked']);
            $username = strip_tags(@$_POST['username']);

			if (($update_fname == "") || ($update_verified == "")  || ($update_blocked == "")) 
            {
				echo "<script>alert('¡Alguno de los campos está vacío!')</script>";
			}
            else 
            {
				$update_query = "UPDATE users SET first_name= ?, verify_id= ?, blocked_user= ?  WHERE username= ? ";
				$stmtUp = $mysqli->prepare($update_query);
                $stmtUp->bind_param('ssss', $update_fname, $update_verified, $update_blocked, $username);
                
                
                if ($stmtUp->execute()) 
                {
					echo "<script>alert('Información actualizada con éxito.')</script>";
					echo "<script>window.open('users.php','_self')</script>";
				}
                else
                {
                    echo "<script>alert('Algo fallo')</script>";
                }
                $stmtUp->close();
				
			}
		}


    if (isset($_GET['user'])) 
    {
            $username = $_GET['user'];
			$query = "SELECT * FROM users WHERE username= ?";
			$stmtQ = $mysqli->prepare($query);
            $stmtQ->bind_param('s', $username);
            $stmtQ->execute();
            $run = $stmtQ->get_result();
            $stmtQ->close();
        
			while ($row = $run->fetch_assoc()) 
            {
				$id = $row['id'];
				$fullname = $row['first_name'];
				$username = $row['username'];
				$email = $row['email'];
                $mailPub = $row['pub_email'];
				$gender = $row['gender'];
				$signupdate = $row['sign_up_date'];
				$verified = $row['verify_id'];
				$blocked = $row['blocked_user'];
				$profile_pic_db = $row['foto_perfil'];
                
				if ($profile_pic_db == "") 
                {
					$profile_pic = "../img/default_propic.png";
				}
                else 
                {
					$profile_pic = "../userdata/profile_pics/".$profile_pic_db;
				}
			}
		}

    
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Informacion</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="adminStyle.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
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
                        <h1>Editar informacion de Usuario</h1>
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
                <th style="background-color: #b51326;"><a href="users.php">
                        <h1>Usuario</h1>
                    </a></th>
                <th><a href="posts.php">
                        <h1>Posteos</h1>
                    </a></th>
                <th><a href="postEliminados.php">
                        <h1>Posteo Eliminados</h1>
                    </a></th>
                <th><a href="report.php">
                        <h1>Reporte</h1>
                    </a></th>
                <th><a href="logout.php">
                        <h1 style="color: #292929;">Logout</h1>
                    </a></th>
            </tr>
        </table>
        <ul style="background-color: #4d49b8;" class="userinfo">
            <form method="POST" action="editUsers.php?user=<?php echo $username; ?>" enctype="multipart/form-data" style="padding: 22px;">
                <input type="hidden" name="username" value="<?php echo $username ?>">
                <div>
                    <table class="edituserdata" style="float: left;">
                        <tr>
                            <td>
                                <img src="<?php echo $profile_pic; ?>" style="height: 150px; width: 150px; border-radius: 22px;" />
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>E-mail: <?php echo $mailPub; ?></td>
                        </tr>
                    </table>
                </div>
                <div style="margin-left: 370px;">
                    <table class="edituserdata">
                        <tr>
                            <td>Id:</td>
                            <td style="padding: 10px; border: 2px solid #1c87c9; background-color: #190808; text-align: center;"><?php echo $id; ?></td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td><input type="text" name="edit_fname" value="<?php echo $fullname; ?>"></td>
                        </tr>
                        <tr>
                            <td>Usuario:</td>
                            <td style="padding: 10px; border: 2px solid #1c87c9; background-color: #190808; text-align: center;"><?php echo $username; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td style="padding: 10px; border: 2px solid #1c87c9; background-color: #190808; text-align: center;"><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td>Genero: </td>
                            <td style="padding: 10px; border: 2px solid #1c87c9; background-color: #190808; text-align: center;"><?php echo $gender; ?></td>
                        </tr>
                        <tr>
                            <td>Activo desde: </td>
                            <td style="padding: 10px; border: 2px solid #1c87c9; background-color: #190808; text-align: center;"><?php echo $signupdate; ?></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Verificado: </td>
                            <td>
                                <select name="edit_verified" style="width:250px; height:30px; border: 6px solid transparent;">
                                    <option value="Selec.">Seleciona</option>
                                    <option <?php if($verified == 'yes'){echo 'selected';} ?> value="yes">Verificado</option>
                                    <option <?php if($verified == 'no'){echo 'selected';} ?> value="no">No Verificado</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Blockeado: </td>
                            <td>
                                <select name="edit_blocked" style="width:250px; height:30px; border: 6px solid transparent;">
                                    <option value="Selec.">Seleciona</option>
                                    <option <?php if($blocked == 1){echo 'selected';} ?> value="1">Bloqueado</option>
                                    <option <?php if($blocked == 0){echo 'selected';} ?> value="0">No bloqueado</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="updateinfo" class="btn btn-danger" placeholder="Cambiar" value="MODIFICAR" />
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </ul>
    </div>
</body>

</html>
