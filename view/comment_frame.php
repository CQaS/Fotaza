<?php

require_once("../controller/MasterController.php");
$gets = new MasterController();
$res = $gets->getComentarios();

include_once $res;


$user = $_SESSION['user_login'];

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/commentFrame.css">
<script src="../js/commentFrame.js"></script>

<div style='margin: 0 7px;'>
    <form action='comment_frame.php?id=<?php echo $getid ?>' method='POST' name='postComment<?php echo $getid ?>'>
        <input type="text" style='padding: 10px 3px; width: 83%; margin: 0 0 5px 0; resize: none; border: 1px solid #0B810B;' name='post_body' placeholder='Realiza un Comentario!' required>
        <input type='submit' name='postComment<?php echo $getid ?>' class='btn btn-primary' value='Comenta'>
    </form>
</div>


<?php
	if ($count > 0) 
    {
        while ($comment = $get_comments->fetch_assoc())
        {
            $comment_body = $comment['post_body'];
		    $date_added = $comment['time'];
		    $comentario_de = $comment['posted_by'];
            $post_de = $comment['posted_to'];
            $id_coment = $comment['id'];
            $post_id = $comment['post_id'];
            
		    $get_user_info = "SELECT * FROM users WHERE username= ?";
            $stmtinfo = $db->prepare($get_user_info);
            $stmtinfo->bind_param('s', $comentario_de);
            $stmtinfo->execute();
            $get_user_info = $stmtinfo->get_result();
            $stmtinfo->close();
            
		    $get_info = $get_user_info->fetch_assoc();
		    $profile_pic_d = $get_info['foto_perfil'];
		    $posted_by = $get_info['first_name'];
            
            if (!empty($profile_pic_d)) 
            {
                $profile_pic = "../userdata/profile_pics/".$profile_pic_d;
		    }
            else 
            {
                $profile_pic = "../img/default_propic.png";
		    }
?>

            <div class='commentPostText'>

                <div style='float: left; margin: 0 10px 0 0;'>
                    <img src="<?php echo $profile_pic ?>" style='border-radius: 22px' ; title="<?php echo $posted_by?>" height='38' width='38'>
                </div>

                <div style='margin-left: 48px;'>
                    <b>
                        <?php if($user != $comentario_de){ ?>

                        <a href='profile.php?u=<?php echo $comentario_de ?>' title="ir al perfil de <?php echo $posted_by ?>" target='_top' class='posted_by'><?php echo $posted_by ?></a>

                        <?php }else{ ?>

                        <a href='about.php?u=<?php echo $comentario_de ?>' title="ir al perfil de <?php echo $posted_by ?>" target='_top' class='posted_by'><?php echo $posted_by ?></a>

                        <?php } ?>
                    </b>
                    <p>
                    <h3 style="color:#3795f4;">
                        <?php echo $comment_body ?>
                        <span style='color:black; font-size: 10px;'>
                            *<?php echo $date_added ?>*
                        </span>

                        <?php 
                    
                        if($post_de == $user)
                        {
                        
                        ?>

                        <div style="float: right;">
                            <a href='comment_frame.php?delCom=<?php echo $id_coment ?>&pId=<?php echo $post_id ?>' class="btn btn-danger">ELIMINAR</a>
                        </div>

                        <?php 
                    
                        }
                        else if($post_de != $user && $comentario_de == $user)
                        {
                        ?>

                        <div style="float: right;">
                            <a href='comment_frame.php?delCom=<?php echo $id_coment ?>&pId=<?php echo $post_id ?>' class="btn btn-danger">ELIMINAR</a>
                        </div>

                        <?php
                        } 
                        ?>


                    </h3>
                    </p>
                </div>

            </div>

            <hr>

<?php
		
	   }
        
	}
    
    if ($count == 0)
    {
		echo "<center><br><br><br>¡Opps! No hay comentarios para ver.</center>";
	}

?>
