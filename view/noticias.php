<?php

if(!isset($_SESSION['user_login']))
{
    header('location: ../index.php');
}

?>
<script language="javascript">
    
    function toggle<?php echo $id; ?>() 
    {
        var ele = document.getElementById("toggleComment<?php echo $id; ?>");
        var text = document.getElementById("displayComment<?php echo $id; ?>");
        if (ele.style.display == "block") {
            ele.style.display = "none"
        } else {
            ele.style.display = "block";
        }
    }

</script>

<?php $postid = $id; ?>

<div class='postBody'>

    <div style='min-height: 55px;'>
        <div style='float: left;'>
            <img src='<?php echo $profile_pic ?>' style='border-radius: 22px' ; title="<?php $added_by ?>" height='45' width='45' />
        </div>

        <div class="posted_by">

            <div style="float: right;">
                <div class="post-action">
                    <!-- Valoracion -->
                    <select class='rating' id='rating_<?php echo $postid; ?>' data-id='rating_<?php echo $postid; ?>'>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div style='clear: both;'></div>
                    Promedio: <span id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?></span>

                    <!-- Valoraciones -->
                    <script type='text/javascript'>
                        $(document).ready(function() 
                        {
                            $('#rating_<?php echo $postid; ?>').barrating('set', <?php echo $rating; ?>);
                        });

                    </script>
                </div>
            </div>

            <span style="color: #9e9e9e;">
                <span style="font-weight: bold;">
                    <?php 
                    
                    if($user == $added_by) {
					echo'<a href="about.php?u='.$added_by.'" style="text-decoration: none; color: #0B810B;">'.$add_by.'</a>';
					}else {
					echo'<a href="profile.php?u='.$added_by.'" style="text-decoration: none; color: #0B810B;">'.$post_to_fname.'</a>';
					} 
                    
                    ?>

                </span>
            </span>
            <div>
                <span>

                    <span style="color: #585858; font-size: 10px;"><?php echo $date_added ?></span>

                </span>
            </div>
        </div>
        <hr>
        <div>
            <a href="../view/viewPost.php?pid=<?php echo $id ?>">
                <img src="<?php echo $photos ?>" style=" box-shadow: 6px 6px 54px -2px rgba(0,0,0,0.75); max-width: 530px; width: 100%; margin-top: 5px; border: 1px solid #ddd;" />
            </a>
        </div>
    </div>
    <br>
    <hr style='margin: 0px 0px 10px 0px;'>
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

        <a href='javascript:;' onClick='javascript:toggle<?php echo $id ?>()' style="">Comentarios (<?php echo $count ?>)</a>
        <a href='viewPost.php?pid=<?php echo $id ?>' style="float: right;">
            <span style="color: #585858; font-size: 15px;">Ver mas</span>
        </a>
    </div>
</div>
<div id='toggleComment<?php echo $id ?>' class='commentBody'>
    <br>
    <iframe src='comment_frame.php?id=<?php echo $id ?>' frameborder='0'></iframe>
</div>
<br>
