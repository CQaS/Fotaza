<?php 

class IndexController
{
    static function main()
    {
        ob_start();
        session_start();
        if (!isset($_SESSION['user_login'])) 
        {
            
	       header('location: view/indexnore.php');
            
        }
        else 
        {
            
	       header('location: view/home.php');
            
        }
    }   
}

?>
