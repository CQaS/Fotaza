<center>
    <div class='postBody'>

        <div style='min-height: 55px;'>
            <div style='float: left;'>
                <img src='<?php echo $profile_pic ?>' style='border-radius: 22px' ; title="<?php echo $added_by ?>" height='45' width='45' />
            </div>

            <div class="posted_by">

                <span style="color: #9e9e9e;">
                    <span style="font-weight: bold;">

                        <a href='signin.php'>
                            <h2 style="text-decoration: none; color: #0B810B;"><?php echo $add_by ?></h2>
                        </a>

                    </span>
                </span>
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
                <div>
                    <span>

                        <span style="color: #585858; font-size: 10px;"><?php echo $date_added ?></span>

                    </span>
                </div>

            </div>
            <hr>
            <div>
                <center>
                    <img src="<?php echo $photos ?>" style="  box-shadow: 6px 6px 54px -2px rgba(0,0,0,0.75); max-height: 100%; max-width: 100%; margin-top: 5px; border: 1px solid #ddd;">
                </center>
            </div>
        </div>
        <br>
        <hr style='margin: 0px 0px 10px 0px;'>
        <div class='likeComShare'>
            <?php
    
			if ($like_count > 0 ) 
            {
				echo "<a href='signin.php'>MG[ $like_count ]</a>";
			}
            else 
            {
				echo "<a href='signin.php'>MG[ 0 ]</a>";
			}
        ?>

            <a href='signin.php'>Comentarios (<?php echo $count ?>)</a>
            <a href='signin.php' style="float: right;">Ver mas</a>
        </div>
    </div>
</center>
<br>
