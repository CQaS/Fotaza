<?php

require_once "../controller/MasterController.php ";
$gets = new MasterController();

$ver = $gets->verPost();
include_once $ver;



?>
<!DOCTYPE html>
<html>

<head>
    <title>Ver post - Fotaza</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".like").click(function() {

                var id = this.id; // obtenemos la id
                $.ajax({
                    url: '../model/like ',
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        var img = data['img'];

                        $('#' + id).html(img);
                    }
                });

            });

        });

    </script>
    <script type="text/javascript">
        function confirm_delete() {
            return confirm('¿Estás segura de que quieres eliminar esto?');
        }

    </script>
    <script type="text/javascript">
        function confirm_report() {
            return confirm('¿Estás seguro de querer reportar esto?');
        }

    </script>
    <script language="javascript">
        function toggle<?php echo $id; ?>() {
            var ele = document.getElementById("toggleComment<?php echo $id; ?>");
            var text = document.getElementById("displayComment<?php echo $id; ?>");
            if (ele.style.display == "block") {
                ele.style.display = "none"
            } else {
                ele.style.display = "block";

            }
        }

    </script>
</head>

<body style="background: url(../img/madera.jpg) center center; background-size: 100%; ">
    <?php
    include "header.php";
    ?>
    <div style='max-width: 960px; margin: 0 auto;'>
        <div class='profilePosts' style='margin: 55px auto' ;>
            <div class='postBody'>

                <div style='min-height: 55px;'>
                    <div style='float: left;'>
                        <img src='<?php echo $profile_pic ?>' style='border-radius: 22px' ; title="<?php echo $added_by ?>" height='45' width='45' />
                    </div>

                    <div class="posted_by">
                        <div>
                            <span>

                                <span style="color: #585858; font-size: 20px;">Titulo: <?php echo $titulo ?> - Categoria: <?php echo $categoria ?></span>

                            </span>
                        </div>
                        <div style="float: right;">

                            <?php 
                            if($precio != null)
                            { 
                                echo "<span style='text-decoration: underline; text-decoration-color: red; color: #585858; font-size: 24px;'>$$".$precio."</span>"; 
                            }
                            else
                            { 
                                echo "Sin valor!";
                            } 
                            ?>

                        </div>
                        <span style="color: #9e9e9e;">
                            <span style="font-weight: bold;">
                                <?php
                                if($user == $added_by) 
                                {
                                    echo'<a href="about.php?u='.$added_by.'" style="text-decoration: none; color: #0B810B;">'.$add_by.'</a>';
                                }
                                else 
                                {
                                    echo'<a href="profile.php?u='.$added_by.'" style="text-decoration: none; color: #0B810B;">'.$add_by.'</a>';
                                }
                                ?>

                            </span>
                        </span>
                        <div>
                            <span>

                                <span style="color: #585858; font-size: 10px;">Posteada el: <?php echo $date_added ?> - en <?php echo $donde ?></span>

                            </span>
                        </div>
                    </div>
                    <div>
                        <br>
                        <hr>

                        <?php
					if($photos_db != NULL) 
                    {
						echo'<div>
                         <img src="'.$photos.'" style=" max-width: 530px; width: 100%; margin-top: 5px; border: 1px solid #ddd;" />
					    </div>';
					}
                    ?>
                    </div>
                </div>
                <div>
                    <span style="color: #585858; font-size: 20px;">Descripcion: <?php echo $descripcion ?></span>
                </div>
                <br>
                <hr style='margin: 0px 0px 10px 0px;' />
                <div class='likeComShare'>

                    <?php
    
			if ($like_count2 == 0 ) 
            {
				echo "<div id='".$id."' class='like' style='float: left; cursor: pointer;'><img src='../img/me-gusta.png'>(".$like_count." mas!)</div>";
            }
            else 
            {
                echo "<div id='".$id."' class='like' style='float: left; cursor: pointer;'><img src='../img/me-gusta2.png'>(Tu y ".$like_count."+!)</div>";
            }
            ?>

                    <a href='javascript:;' onClick='javascript:toggle<?php echo $id ?>()'>Comentarios (<?php echo $count ?>)</a>

                    <?php
			if($added_by == $user) 
            {
				echo"<a href='../view/viewPost.php?e=".$id."' >Eliminar</a>";
			}
            else 
            {
				echo"<a href='../view/viewPost.php?r=".$id."' >Reportar</a>";
			}
            ?>

                    <div style="float: right;">
                        Contactar: <span style="color: #585858; font-size: 15px;">
                            <?php echo $pub_email; ?></span>
                    </div>

                </div>
            </div>
            <hr>
            <div id='toggleComment<?php echo $id ?>' class='commentBody' style='display: none;'>
                <br>
                <iframe src='./comment_frame.php?id=<?php echo $id ?>' frameborder='0'></iframe>
            </div> <br>
        </div>
    </div>
</body>

</html>
