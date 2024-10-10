<?php

if(!isset($_SESSION['user_login']))
{
    header('location: ../index.php');
}

?>

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


<!--Mostrar Publicaciones-->
<div class='postBody'>

    <div style='min-height: 55px;'>
        <div style='float: left;'><img src='<?php echo $profile_pic ?>' style='border-radius: 22px' ; title="<?php echo $added_by ?>" height='45' width='45' /></div>

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
            <span style="color: #585858; font-size: 20px;"><?php echo $description ?></span>

            <?php 
        if(!empty($photos_db)) 
        {
            echo'<div><center>
                    <a href="viewPost.php?pid='.$id.'" >
                        <img src="'.$photos.'" style=" max-width: 530px; width: 100%; margin-top: 5px; border: 1px solid #ddd;" />
                    </a></center>
                </div>';
        } 
        ?>

        </div>
    </div>


    <br>
    <hr style='margin: 0px 0px 10px 0px;' />
    <div class='likeComShare'>

        <?php
        
        if ($like_count2 == 0 ) 
        {
            echo "<div id='".$id."' class='like' style='float: left; cursor: pointer;'><img src='../img/me-gusta.png'>(".$like_count.")</div>";
            
        }else {
            
            echo "<div id='".$id."' class='like' style='float: left; cursor: pointer;'><img src='../img/me-gusta2.png'>(".$like_count.")</div>";
        }
        
        ?>

        <a href='javascript:;' onClick='javascript:toggle<?php echo $id ?>()'>Comentarios (<?php echo $count ?>)</a>

        <div style="float: right;">
            <a href='viewPost.php?pid=<?php echo $id ?>'>
                <span style="color: #585858; font-size: 15px;">Ver</span>
            </a>
        </div>
    </div>
</div>
<div id='toggleComment<?php echo $id ?>' class='commentBody'>
    <br>
    <iframe src='comment_frame ?id=<?php echo $id ?>' frameborder='0'></iframe>
</div>

<br>
