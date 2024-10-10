<?php 
	include "conn/connect.php";

	if (isset($_POST['login'])) 
    {
		if (isset($_POST['admin_user']) && isset($_POST['admin_pass'])) 
        {
			$admin_user = $mysqli->real_escape_string($_POST['admin_user']);	
			$admin_pass = $mysqli->real_escape_string($_POST['admin_pass']);	
			$num = 0;
			$result = "SELECT * FROM admin_login WHERE user_name= ? AND user_pass= ?";
            $stmtQ = $mysqli->prepare($result);
            $stmtQ->bind_param('ss', $admin_user, $admin_pass);
            $stmtQ->execute();
            $result = $stmtQ->get_result();
            $stmtQ->close();
            
			$num = $result->num_rows;
            
			if ($num>0) 
            {
				session_start();
				$_SESSION['admin_user'] = $admin_user;
				echo "<script>window.open('index.php','_self')</script>";
			}
			else 
            {
				echo "<script>alert('Usuario o Password es incorrecto!')</script>";
			}
		}

	}
 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Administracion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="adminStyle.css">
</head>

<body style="background-image: linear-gradient(5deg, #ff81ff 0, #fd74ff 16.67%, #c465ff 33.33%, #8953f2 50%, #4e40cb 66.67%, #0030a7 83.33%, #002286 100%);">
    <form method="POST" action="login.php" style="padding: 84px 15px;">
        <table class="admintable" width="450px" border="10" align="center" bgcolor="#125612" style="margin: 0 auto;">
            <tr>
                <td class="login_header" colspan="4" align="center">
                    <h1>Login Administracion</h1>
                </td>
            </tr>
            <tr class="login_body">
                <td>Usuario:</td>
                <td><input type="text" name="admin_user" /></td>
            </tr>
            <tr class="login_body">
                <td>Password:</td>
                <td><input type="password" name="admin_pass" /></td>
            </tr>
            <tr class="login_footer">
                <td colspan="4" align="center"><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>
