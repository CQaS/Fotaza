<?php

if (($_GET['keywords'] && $_GET['topic']) == NULL) 
            {
				header("location: index.php");
			} 
            if (($_GET['keywords'] || $_GET['topic']) == NULL) 
            {
				header("location: index.php");
			} 
            if (($_GET['keywords'] && $_GET['topic']) != NULL) 
            {
				$search_value = "";
				$count = "";
				if (isset($_GET['keywords'])) 
                {
					if ($_GET['topic'] == "Usuario") 
                    {
						$search_value = $_GET['keywords'];
						$search_value = trim($search_value);
					   if ($search_value == "") 
                       {
                           echo '<div class="search_banner">Por favor ingrese algo!</div>';
				        }
                        else 
                        {
					       $search_for = $search_value;
                            $search_val = "%$search_value%";
					       $query = "SELECT * FROM users where username like ? OR first_name like ? OR email like ? ";
					       $stmtQ = $mysqli->prepare($query);
                           $stmtQ->bind_param('sss', $search_val, $search_val, $search_val);
                           $stmtQ->execute();
                           $query = $stmtQ->get_result();
                           $stmtQ->close();
                            
					       $count = $query->num_rows;
				            
                            if ($count == 0)
                            {
					           echo '<div class="search_banner">¡No se encontraron coincidencias!</div>';
				            }
                            else 
                            {
					           echo '<div class="search_banner">Resultado para: 
							     <span class="search_for">'.$search_value.'</span><br>
							     <div class="search_found_num">'.$count.' coincidencia...</div>
						          </div><br>
                                <div class="container">
						          <table class="table table-striped table-bordered table-hover table-dark">
                                    <thead class="table-danger">
						              <tr style="font-weight: bold;" colspan="10">
							             <th>Id</th>
							             <th>Nombre</th>
							             <th>Usuario</th>
							             <th>Email</th>
							             <th>Genero</th>
							             <th>Creado desde</th>
							             <th>Verificado</th>
							             <th>Bloqueado</th>
							             <th>Editar</th>
						              </tr>
                                    </thead>';
                                
                                
						      while ($row = $query->fetch_array()) 
                              {
                                  $id = $row['id'];
							       $fullname = $row['first_name'];
							       $username = $row['username'];
							       $email = $row['email'];
							       $gender = $row['gender'];
							       $signupdate = $row['sign_up_date'];
							       $verified = $row['verify_id'];
							       $blocked_user = $row['blocked_user'];
							 ?>
<tr>
    <th><?php echo $id; ?></th>
    <th><?php echo $fullname; ?></th>
    <th><?php echo $username; ?></th>
    <th><?php echo $email; ?></th>
    <th><?php echo $gender; ?></th>
    <th><?php echo $signupdate; ?></th>
    <th><?php echo $verified; ?></th>
    <th><?php echo $blocked_user; ?></th>
    <th class="edituser"><a class="btn btn-danger" href="editUsers.php?user=<?php echo $username; ?>">Editar</a></th>
    <?php
							 echo '</tr>';
							 }    
							echo '</table></div>';
						}
					}
				}
                
                    if ($_GET['topic'] == "Posteo") 
                    {
                        $search_value = $_GET['keywords'];
					   $search_value = trim($search_value);
					   $search_value = preg_replace('/[^\p{L}0-9\s]+/u', '-', $search_value);
					if ($search_value == "") 
                    {
					   echo '<div class="search_banner">Por favor ingrese algo!</div>';
				    }
                    else 
                    {

					$search_for = $search_value;
                    $search_val = "%$search_value%";
				    $que = "SELECT * FROM posts where (added_by LIKE ? OR titulo LIKE ? OR palabra1 LIKE ? OR palabra2 LIKE ? OR palabra3 LIKE ? OR donde LIKE ? OR description LIKE ?) and estado = '1' ORDER BY id DESC";
                    $stmtQ = $mysqli->prepare($que);
                    $stmtQ->bind_param('sssssss', $search_val, $search_val, $search_val, $search_val, $search_val, $search_val, $search_val);
                    $stmtQ->execute();
                    $query = $stmtQ->get_result();
                    $stmtQ->close();
                        
					$count = $query->num_rows;
				if ($count == 0)
                {
					echo '<div class="search_banner">Sin coincidencias!</div>';
				}
                else 
                {
					echo '<div class="search_banner">Resultaros para: 
							<span class="search_for">'.$search_value.'</span><br>
							<div class="search_found_num">'.$count.' coincidencias...</div>
						</div>
                        <br>
						<div class="container">
						<table class="table table-striped table-bordered table-hover table-dark">
				          <thead class="table-danger">
                            <tr style="font-weight: bold;" colspan="10">
								<th>Id</th>
								<th>Fecha</th>
								<th>Usuario</th>
								<th>Discripcion</th>
								<th>Reportes</th>
								<th></th>
							</tr>
                          </thead>
							<tr>';
						while ($row = $query->fetch_array()) 
                        {
								$id = $row['id'];
								$post_time = $row['post_time'];
								$added_by = $row['added_by'];
								$description = $row['description'];
								$report = $row['report'];
							
							 ?>
    <th><?php echo $id; ?></th>
    <th><?php echo $post_time; ?></th>
    <th><?php echo $added_by; ?></th>
    <th><?php echo $description; ?></th>
    <th><?php echo $report; ?></th>
    <th class="editpost"><a class="btn btn-primary" href="viewfullPost.php?post=<?php echo $id; ?>">Ver Post</a></th>
</tr>
<?php 
						}
						echo '</table></div>';
						}
					}
				}
			    }
		    }

?>
