<?php 

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();


//Buscar por Usuario
if (isset($_GET['topic']) && $_GET['topic'] == "User") 
{
    $search_value = $_GET['keywords'];
    $search_value = trim($search_value);
	$search_value = preg_replace('/[^\p{L}0-9\s]+/u', '-', $search_value);
                    
	if ($search_value == "") 
    {
        echo '<div class="search_banner">Por favor ingresa un palabra!</div>';
    }
    else
    {
        $search_val = "%$search_value%";
        $que = "SELECT * FROM users where (username like ? OR first_name like ?)";
        $stmtQ = $db->prepare($que);
        $stmtQ->bind_param('ss', $search_val, $search_val);
        $stmtQ->execute();
        $query = $stmtQ->get_result();
        $stmtQ->close();
        
		$count = $query->num_rows;
		
        if ($count == 0)
        {
            echo '<div class="search_banner">Sin Resultados Posibles!</div>';
        }
        else 
        {
            echo '<div class="search_banner">Resultados para: 
						<span class="search_for">'.$search_value.'</span><br>
						<div class="search_found_num">'.$count.' coincidencias...</div>
					</div>
					<div class="search_result_container">';
            
                    while ($row = $query->fetch_array()) 
                    {
                        $id = $row['id'];
				        $username = $row['username'];
				        $first_name = $row['first_name'];
				        $city = $row['city'];
				        $hometown = $row['hometown'];
				        $company = $row['company'];
				        $school = $row['school'];
				        $profile_pic_d = $row['foto_perfil'];
				        $cover_pic_db = $row['cover_pic'];
                        $verify_id_user = $row['verify_id'];
                        $email_pub = $row['pub_email'];
						
                        if (!empty($profile_pic_d)) 
                        {
                            $profile_pic = "../userdata/profile_pics/".$profile_pic_d;
                        }
                        else 
                        {
                            $profile_pic = "../img/default_propic.png";
                        }
                
                        if(empty($cover_pic_db))
                        {
                            $cover_pic= "../img/default_covpic.png";
                        }
                        else 
                        {
                            $cover_pic = "../userdata/profile_pics/".$cover_pic_db;
                        }
                        ?>

<div class="user_search_result_box">

    <div style="background: url( '<?php echo $cover_pic ?>') repeat center center; height: 130px; width: 300px; border-radius: 2px;margin: -1px 0 0 -1px;background-size: cover !important; border-bottom: 1px solid #d3d6db;">

        <div class="coll1">

            <img src="<?php echo $profile_pic ?>" />

        </div>

        <div class="coll3" style="float: right; margin-top: 104px;">
            <a href="signin.php">
                <button value="button" name="viewProfile">Ver Perfil</button>
            </a>
        </div>

    </div>

    <div class="coll2">

        <?php
                        if ($verify_id_user == 'yes') 
                        {
                            echo '<span class="coll2_spn" style="margin-right: 3px; float: left;">'.$first_name.'
                            </span>
                                <div class="verifiedicon" style="background: url(../img/verifiLogo.png) repeat; background-size: cover !important; margin-top: -2px; width: 19px; height: 19px;" title="Perfil Verificado">
                                </div>';
                        }
                        else 
                        {
                            echo '<span class="coll2_spn"><a href="signin">'.$first_name.'</a></span>';
                        }
                        ?>
    </div>

    <br><br>

    <div class="coll4">

        Trabajo: <span style="color: #0B810B;"><?php echo $company ?></span>
        <br>

        Estudios: <span style="color: #0B810B;"><?php echo $school ?></span>
        <br>

        Es de: <span style="color: #0B810B;"><?php echo $hometown ?></span> - Vive en: <span style="color: #0B810B;"><?php echo $city ?></span>
        <br>

        E-mail Publico: <span style="color: #0B810B;"><?php echo $email_pub ?></span>

    </div>
</div>

<?php
            }            
              
        }
    }
}

//Buscar por Post
if (isset($_GET['topic']) && $_GET['topic'] == "Post") 
{
        $search_value = $_GET['keywords'];
		$search_value = trim($search_value);
		$search_value = preg_replace('/[^\p{L}0-9\s]+/u', '-', $search_value);
                
		if ($search_value == "") 
        {
            echo '<div class="search_banner">Por favor ingresa una palabra!</div>';
        }
        else 
        {
            $search_val = "%$search_value%";
            $que = "SELECT * FROM posts where (added_by LIKE ? OR titulo LIKE ? OR palabra1 LIKE ? OR palabra2 LIKE ? OR palabra3 LIKE ? OR donde LIKE ? OR description LIKE ?) AND privado ='0' AND estado = 1 ORDER BY id DESC";
            
			$stmtQ = $db->prepare($que);
            $stmtQ->bind_param('sssssss', $search_val, $search_val, $search_val, $search_val, $search_val, $search_val, $search_val);
            $stmtQ->execute();
            $query = $stmtQ->get_result();
            $stmtQ->close();
            
			$count = $query->num_rows;
			
            if ($count == 0)
            {
				echo '<div class="search_banner">Sin Resultados Posibles!</div>';
			}
            else 
            {
                echo '<div class="search_banner">Resultado para: 
						<span class="search_for">'.$search_value.'</span><br>
						<div class="search_found_num">'.$count.' coincidecias...</div>
					</div>
					<div class="profilePosts">';
                
                echo '<ul id="recs">';
                
                while ($row = $query->fetch_array()) 
                {
                    $id = $row['id'];
                    $precio = $row['precio'];
                    $date_added = $row['post_time'];
                    $added_by = $row['added_by'];
                    $description = $row['description'];
                    $photos_db = $row['photos'];
                    $photos = "../userdata/profile_pics/".$photos_db;

                    $get_user_info = "SELECT * FROM users WHERE username= ?";
                    $stmtG = $db->prepare($get_user_info);
                    $stmtG->bind_param('s', $added_by);
                    $stmtG->execute();
                    $get_user_info = $stmtG->get_result();
                    $stmtG->close();
                    
                    $get_info = $get_user_info->fetch_assoc();
                    $profile_pic_db= $get_info['foto_perfil'];
                    $gender_user_db = $get_info['gender'];
                    $add_by = $get_info['first_name'];

                    $get_fname_info = "SELECT * FROM users WHERE username= ?";
                    $stmtF = $db->prepare($get_fname_info);
                    $stmtF->bind_param('s', $added_by);
                    $stmtF->execute();
                    $get_fname_info = $stmtF->get_result();
                    $stmtF->close();
                    
                    $get_fname_info = $get_fname_info->fetch_assoc();
                    $post_to_fname = $get_fname_info['first_name'];

                    if (!empty($profile_pic_db))
                    {
                        $profile_pic = "../userdata/profile_pics/".$profile_pic_db;
		            }
                    else
                    {
                        $profile_pic = "../img/default_propic.png";
		            }
                    
                    //contar comentarios
                    $get_comments = "SELECT * FROM post_comments WHERE post_id= ? AND estado = 1 ORDER BY id DESC ";
                    $stmtC = $db->prepare($get_comments);
                    $stmtC->bind_param('i', $id);
                    $stmtC->execute();
                    $get_comments = $stmtC->get_result();
                    $stmtC->close();
                    
                    $count = $get_comments->num_rows;

                    //contar likes
                    $like_query = "SELECT * FROM post_likes WHERE post_id= ? AND estado='1'";
                    $stmtL = $db->prepare($like_query);
                    $stmtL->bind_param('i', $id);
                    $stmtL->execute();
                    $like_query = $stmtL->get_result();
                    $stmtL->close();
                    
			        $like_count = $like_query->num_rows;
                    
                    include ( "../view/noticiasNore.php" );
                
                }
                
                echo '</ul>';
                echo '</div>';
            
            }
        }
    } 

//todos los post Publicos
if(!isset($_GET['topic']))
{
        //traer todos los post
        $getposts = "SELECT * FROM posts WHERE privado = '0' AND estado = '1' ORDER BY RAND()";
        $stmtGetPost = $db->prepare($getposts);
        $stmtGetPost->execute();
        $getpost = $stmtGetPost->get_result();
        $stmtGetPost->close();
        
        $posteos = $getpost->num_rows;
        if ($posteos > 0) 
        {
            echo '<div style="height: 150px; width: 600px;">
                    <ul id="recs">';
            
            while ($row = $getpost->fetch_assoc()) 
            {
                $id = $row['id'];
                $precio = $row['precio'];
                $date_added = $row['post_time'];
                $added_by = $row['added_by'];
                $description = $row['description'];
                $photos_db = $row['photos'];
                $photos = "../userdata/profile_pics/".$photos_db;

                $get_user_info = "SELECT * FROM users WHERE username= ?";
                $stmtQ = $db->prepare($get_user_info);
                $stmtQ->bind_param('s', $added_by);
                $stmtQ->execute();
                $get_user_info = $stmtQ->get_result();
                $stmtQ->close();
                
                $get_info = $get_user_info->fetch_assoc();
                $profile_pic_db= $get_info['foto_perfil'];
                $gender_user_db = $get_info['gender'];
                $add_by = $get_info['first_name'];

                $get_fname_info = "SELECT * FROM users WHERE username= ?";
                $stmtF = $db->prepare($get_fname_info);
                $stmtF->bind_param('s', $added_by);
                $stmtF->execute();
                $get_fname_info = $stmtF->get_result();
                $stmtF->close();
                
                $get_fname_info = $get_fname_info->fetch_assoc();
                $post_to_fname = $get_fname_info['first_name'];

                if (!empty($profile_pic_db)) 
                {
                    $profile_pic = "../userdata/profile_pics/".$profile_pic_db;
		        }
                else 
                {
                    $profile_pic = "../img/default_propic.png";
		        }
                    
                    //contar comentarios
                    $get_comments = "SELECT * FROM post_comments WHERE post_id= ? AND estado = 1 ORDER BY id DESC ";
                    $stmtC = $db->prepare($get_comments);
                    $stmtC->bind_param('i', $id);
                    $stmtC->execute();
                    $get_comments = $stmtC->get_result();
                    $stmtC->close();
                
                    $count = $get_comments->num_rows;

                    //contar likes
                    $like_query = "SELECT * FROM post_likes WHERE post_id= ? AND estado='1'";
                    $stmtLK = $db->prepare($like_query);
                    $stmtLK->bind_param('i', $id);
                    $stmtLK->execute();
                    $like_query = $stmtLK->get_result();
                    $stmtLK->close();
                
			        $like_count = $like_query->num_rows;
                    
                    include "../view/noticiasNore.php";
                    
                    $lastid = $row['id'];
            }
            
            echo   '</ul>
                </div>';
        }
    }

?>
