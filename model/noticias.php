<?php

    $id = $row['id'];
    $date_added = $row['post_time'];
    $added_by = $row['added_by'];
    $description = $row['description'];
    $photos_db = $row['photos'];
    $photos = "../userdata/profile_pics/".$photos_db;

    $get_user_inf = "SELECT * FROM users WHERE username= ?";
    $stmtgetUI = $db->prepare($get_user_inf);
    $stmtgetUI->bind_param('s', $added_by);
    $stmtgetUI->execute();
    $get_user_info = $stmtgetUI->get_result();


    $get_info = $get_user_info->fetch_assoc();
    $profile_pic_db= $get_info['foto_perfil'];
    $gender_user_db = $get_info['gender'];
    $add_by = $get_info['first_name'];

    $get_fname_inf = "SELECT * FROM users WHERE username= ?";
    $stmtgetFI = $db->prepare($get_fname_inf);
    $stmtgetFI->bind_param('s', $added_by);
    $stmtgetFI->execute();
    $get_fname_info = $stmtgetFI->get_result();

    $get_fname_info = $get_fname_info->fetch_assoc();
    $post_to_fname = $get_fname_info['first_name'];

    if (!empty($profile_pic_db)) {
            $profile_pic = "../userdata/profile_pics/".$profile_pic_db;
		}else {
            $profile_pic = "../img/default_propic.png";
		}
    $stmtgetUI->close();
    $stmtgetFI->close();

//Valoracion
$val = "SELECT * FROM valoracion WHERE post_id= ? and user_name= ? AND estado='1'";
$stmtVal = $db->prepare($val);
$stmtVal->bind_param('is', $id, $user);
$stmtVal->execute();
$fetchRating = $stmtVal->get_result();

if($fetchRating->num_rows >0){
    
$fetchRating = $fetchRating->fetch_assoc();
$rating = $fetchRating['valor'];
    
}else{ $rating = 0; }

//promedio Valoracion
$prom = "SELECT ROUND(AVG(valor),1) as promRating FROM valoracion WHERE post_id= ? AND estado='1'";
$stmtProm = $db->prepare($prom);
$stmtProm->bind_param('i', $id);
$stmtProm->execute();
$fetchAverage = $stmtProm->get_result();

$fetchAverage = $fetchAverage->fetch_assoc();
$averageRating = $fetchAverage['promRating'];

if($averageRating <= 0){
    $averageRating = "Sin Valorar!";
}


//contar comentarios
$get_comment = "SELECT * FROM post_comments WHERE post_id= ? AND estado='1' ORDER BY id DESC ";
$stmtGetCom = $db->prepare($get_comment);
$stmtGetCom->bind_param('i', $id);
$stmtGetCom->execute();
$get_comments = $stmtGetCom->get_result();

$count = $get_comments->num_rows;

//contar likes
$like_quer = "SELECT * FROM post_likes WHERE post_id= ? AND estado='1'";
$stmtGetLi = $db->prepare($like_quer);
$stmtGetLi->bind_param('i', $id);
$stmtGetLi->execute();
$like_query = $stmtGetLi->get_result();

$like_count = $like_query->num_rows;

$like_us = "SELECT * FROM post_likes WHERE user_name= ? AND post_id= ? AND estado='1'";
$stmtGetLikU = $db->prepare($like_us);
$stmtGetLikU->bind_param('si', $user, $id);
$stmtGetLikU->execute();
$like_user = $stmtGetLikU->get_result();
                        
$like_count2 = $like_user->num_rows;
                      
$stmtGetLi->close();
$stmtGetLikU->close();
$stmtVal->close();
$stmtProm->close();

?>
