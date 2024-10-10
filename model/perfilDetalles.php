<?php 

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

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


$username ="";
$firstname ="";
if (isset($_GET['u']) && $_GET['u'] != null) 
{
		$username = $db->real_escape_string($_GET['u']);
		if (ctype_alnum($username)) 
        {
			//check user exists
			$chec = "SELECT * FROM users WHERE username= ?";
            $stmtCheck = $db->prepare($chec);
            $stmtCheck->bind_param('s', $username);
            $stmtCheck->execute();
            $check = $stmtCheck->get_result();
            $stmtCheck->close();
            
            $num = $check->num_rows;
			if ($num == 1) 
            {
				$get = $check->fetch_assoc();
				$username = $get['username'];
				$firstname = $get['first_name'];
                $profile_pic_d = $get['foto_perfil'];
                $school_name_user = $get['school'];
				$concentration_name_user = $get['concentration'];
				$city_name_user = $get['city'];
				$hometown_name_user = $get['hometown'];
				$user_queote = $get['queote'];
				$user_bio = $get['bio'];
				$user_company = $get['company'];
				$user_position = $get['position'];
				$user_mobile = $get['mobile'];
				$user_pub_email = $get['pub_email'];
			}
			else 
            {
				header('location: ../index.php');
			}
		}
	

        //Comprueba si el usuario ha subido una foto de perfil o no
    
        if (!empty($profile_pic_d)) 
        {
            $profile_fot = "../userdata/profile_pics/".$profile_pic_d;
		}
        else 
        {
            $profile_fot = "../img/default_propic.png";
		}


        $check_co = "SELECT * FROM users WHERE username= ?";
        $stmtCheckC = $db->prepare($check_co);
        $stmtCheckC->bind_param('s', $user);
        $stmtCheckC->execute();
        $check_cov = $stmtCheckC->get_result();
        $stmtCheckC->close();

        $get_pic_row = $check_cov->fetch_assoc();
        $cover_pic_db = $get_pic_row['cover_pic'];
        $first_name_user = $get_pic_row['first_name'];
        $verify_id_user = $get_pic_row['verify_id'];
        $profile_pic_d = $get_pic_row['foto_perfil'];

        //Comprueba si la usuario ha subido una foto de portada o no
        if(empty($cover_pic_db))
        {
			$cover_pic= "../img/default_covpic.png";
		}
        else 
        {
            
			$cover_pic = "../userdata/profile_pics/".$cover_pic_db;
		}

	    //Comprueba foto de perfil
        if (!empty($profile_pic_d)) 
        {
            $profile_pi = "../userdata/profile_pics/".$profile_pic_d;
		}
        else 
        {
            $profile_pi = "../img/default_propic.png";
		}		

        //edit profile
        if (isset($_POST['updateProfile'])) 
        {
            header("location: profile_update");
        }

        $getposts = "SELECT * FROM posts WHERE added_by = ? AND estado = 1 ORDER BY id DESC ";
        $stmtPos = $db->prepare($getposts);
        $stmtPos->bind_param('s', $username);
        $stmtPos->execute();
        $getpost = $stmtPos->get_result();
        $stmtPos->close();
        $gets = $getpost->num_rows;
    
}
else
{
    header('location: ../index.php');
}

?>
