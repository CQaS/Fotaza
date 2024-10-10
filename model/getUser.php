<?php 

require_once("connection.php");
$conectar=new Conectar();
$db=$conectar->getConnection();

$search_value = $_GET['keywords'];
$search_value = trim($search_value);
$search_value = preg_replace('/[^\p{L}0-9\s]+/u', '-', $search_value);
        
$search_val = "%$search_value%";
$que = "SELECT * FROM users where (username like ? OR first_name like ?)";
$stmtQ = $db->prepare($que);
$stmtQ->bind_param('ss', $search_val, $search_val);
$stmtQ->execute();
$query = $stmtQ->get_result();

$count = $query->num_rows;

if ($count != 0)
{
                $ok = "";
                
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
						

						include "../view/buscaXusuario.php";

						}
              echo '</div>';
				
			}
else 
{
    echo '<div class="search_banner">Sin Resultados Posibles!</div>';
}

?>
