<?php 
require_once("../controller/MasterController.php");
$gets = new MasterController();

$verDe = $gets->verPostDe();
include_once $verDe;

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title_fname; ?> • Fotaza</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="../css/fontawesome-stars.css" rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="../js/jquery-3.0.0.js" type="text/javascript"></script>
    <script src="../js/jquery.barrating.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".like").click(function() {

                var id = this.id; // obtenemos la id
                $.ajax({
                    url: '../model/like.php',
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
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {

                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');

                    // rating was selected by a user
                    if (typeof(event) !== 'undefined') {

                        var split_id = el_id.split("_");

                        var postid = split_id[1]; // postid

                        // AJAX Request
                        $.ajax({
                            url: '../model/rating_ajax.php',
                            type: 'post',
                            data: {
                                postid: postid,
                                rating: value
                            },
                            dataType: 'json',
                            success: function(data) {
                                // Update average
                                var average = data['averageRating'];
                                $('#avgrating_' + postid).text(average);
                            }
                        });
                    }
                }
            });
        });

    </script>

</head>

<body style="background-color: #471831;">
    <div id="top"></div>

    <?php include "header.php"; ?>

    <div id="top">
        <div style="width: 560px; margin: 0 auto;">
            <br><br><br><br>
            <div class="profilePosts">

                <?php
                
                if($posteos == 0)
                {
                    
                    echo "<p style='text-align: center; color: #4A4848; margin: 30px; font-weight: bold; font-size: 36px;'>Disculpe! nada para ver.</p>"; 
                    
                }
                else
                {
                    echo '<ul id="profilehmpost">';
				    while ($row = $getposts->fetch_assoc()) 
                    {
                        
                        $res = $gets->getNoticiasModel();
                        include $res;
                        
                        $res2 = $gets->getNoticiasView();
                        include $res2;
                        
						$profilehmlastid = $row['id'];
						$profilehm_uname = $row['added_by'];
                    }
                }
                
                if ($posteos >= 1) 
                {
                    
						//echo '<li class="profilehmmore" id="'.$profilehmlastid.'" >Siguiente...</li>';
						echo '</ul>';
						echo '
						</div>
						<a href="#top" class="backtotop">Ir Arriba</a>
						<br>
					</div>
				</div>
			</div>
			</div>';
                    
				}
                else 
                {
					echo '</ul>';
					echo '
					</div>
				<br>
			</div>
		</div>
	</div>
</div>';
				}

	
?>
                <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
                <script src="../js/siguientePerfil.js"></script>
</body>

</html>
