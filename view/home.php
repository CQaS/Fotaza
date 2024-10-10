<?php 

require_once("../controller/MasterController.php");
$gets = new MasterController();
$res = $gets->getHome();

include_once $res;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Fotaza</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="../css/fontawesome-stars.css" rel='stylesheet' type='text/css'>
    <!--Like-->
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!--valoracion-->
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
    <script src="../js/body.js"></script>
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
            $('body').on('keydown', '#comment', function(e) {
                console.log(this.value);
                if (e.which === 32 && e.target.selectionStart === 0) {
                    return false;
                }
            });
        });

    </script>
    <style type="text/css">
        .uiloginbutton {
            float: right;
            color: #FFFFFF;
            background: #088A08;
            border: 1px solid #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-size: 17px;
            font-weight: bold;
            line-height: 15px;
            padding: 4px;
            text-align: center;
            text-decoration: none;
        }

    </style>
</head>

<body style="background-color: #471831;">

    <?php include "header.php"; ?>

    <div style="width: 900px; margin: 52px auto;">
        <div style="float: left;">
            <div class="homeLeftSideContent">
                <div class="home_cov" style="background: url(<?php echo $cover_pic; ?>) repeat center center;">
                    <div style="float: left;">
                        <img src="<?php echo $profile_fot; ?>" height="70" width="70" style="border-radius: 40px; margin: 20px 0 0 10px;border: 2px solid #fff;">
                    </div>
                    <div class="home_cov_data">
                        <a href="profile_update" class="home_cov_nm">Editar Perfil</a><br>
                    </div>
                    <br>
                    <div class="homenavemanu">
                        <div>
                            <div>
                                <a href="home.php" style="color: #0B810B">Inicio</a>
                            </div>
                            <div>
                                <a href="photo.php?u=<?php echo $user; ?>">Fotos</a>
                            </div>
                            <div>
                                <a href="about.php?u=<?php echo $user; ?>">Mis Datos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="settingsleftcontent" style="width: 301px;  margin-top: 15px;">

                <?php include 'profilefooter.php'; ?>

            </div>
        </div>
        <div style="float: right;">

            <div class="profilePosts">
                <?php
                //Noticias nuevas
                if ($posteos > 0 && $posteosMax > 0) 
                {
                    echo '<ul id="recs">';
                    while ($row = $valMax->fetch_assoc()) 
                    {
                        if($row["POSTval"] >= 4)
                        {
                        $res = $gets->getNoticiasModel();
                        include $res;
                        
                        $res2 = $gets->getNoticiasView();
                        include $res2;
                        }
                    }
                    
                    while ($row = $getposts->fetch_assoc()) 
                    {
                        $res = $gets->getNoticiasModel();
                        include $res;
                        
                        $res2 = $gets->getNoticiasView();
                        include $res2;
                    }
                    echo '</ul>';
                    
                }
                ?>
            </div>
            <a href="#top" class="backtotop">Ir Arriba</a>
            <br>

        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</body>

</html>
