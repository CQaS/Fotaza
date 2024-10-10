<?php
$user = $_SESSION['user_login'];

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();


$search_value = $_GET['keywords'];
$search_value = trim($search_value);
$search_value = preg_replace('/[^\p{L}0-9\s]+/u', '-', $search_value);

$search_val = "%$search_value%";
$que = "SELECT * FROM posts where (added_by LIKE ? OR titulo LIKE ? OR palabra1 LIKE ? OR palabra2 LIKE ? OR palabra3 LIKE ? OR donde LIKE ? OR description LIKE ?) and estado = '1' ORDER BY id DESC";
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
					<div class="profilePosts">
						';
                echo '<ul id="recs">';
                
				while ($row = $query->fetch_array()) 
                {
                        $id = $row['id'];
                        $precio = $row['precio'];
                        $titulo = $row['titulo'];
                        $categoria = $row['categoria'];
                        $donde = $row['donde'];
                        $date_added = $row['post_time'];
                        $added_by = $row['added_by'];
                        $description = $row['description'];
                        $photos_db = $row['photos'];
                        $photos = "../userdata/profile_pics/".$photos_db;
                        
                        $get_user_in = "SELECT * FROM users WHERE username= ?";
                        $stmtUI = $db->prepare($get_user_in);
                        $stmtUI->bind_param('s', $added_by);
                        $stmtUI->execute();
                        $get_user_info = $stmtUI->get_result();
                        $stmtUI->close();
                        
                        $get_info = $get_user_info->fetch_assoc();
                        $profile_pic_db= $get_info['foto_perfil'];
                        $gender_user_db = $get_info['gender'];
                        $add_by = $get_info['first_name'];
                        $post_to_fname = $get_info['first_name'];

                        if (!empty($profile_pic_db)) 
                        {
                            $profile_pic = "../userdata/profile_pics/".$profile_pic_db;
		                }
                        else 
                        {
                            $profile_pic = "../img/default_propic.png";
		                }

                        //contar comentarios
                        $get_comment = "SELECT * FROM post_comments WHERE post_id= ? and estado = '1' ORDER BY id DESC ";
                        $stmtGetCom = $db->prepare($get_comment);
                        $stmtGetCom->bind_param('i', $id);
                        $stmtGetCom->execute();
                        $get_comments = $stmtGetCom->get_result();
                        $stmtGetCom->close();
                        
                        $count = $get_comments->num_rows;

                        //contar likes
                        $like_quer = "SELECT post_id FROM post_likes WHERE post_id= ? AND estado='1'";
                        $stmtGetLi = $db->prepare($like_quer);
                        $stmtGetLi->bind_param('i', $id);
                        $stmtGetLi->execute();
                        $like_query = $stmtGetLi->get_result();
                        $stmtGetLi->close();
                        
                        $like_count = $like_query->num_rows;
                        
                        $like_us = "SELECT * FROM post_likes WHERE user_name= ? AND post_id= ? AND estado='1'";
                        $stmtGetLikU = $db->prepare($like_us);
                        $stmtGetLikU->bind_param('si', $user, $id);
                        $stmtGetLikU->execute();
                        $like_user = $stmtGetLikU->get_result();
                        $stmtGetLikU->close();
                        
                        $like_count2 = $like_user->num_rows;
                        
							include "../view/buscarXpost.php";
                        
						}
                
                echo '</ul>';
              echo '</div>';
            }

?>
