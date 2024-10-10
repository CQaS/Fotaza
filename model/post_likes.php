<?php

class Post_likes
{
    //atributos
    protected $id;
    protected $user_name;
    protected $post_id;
    protected $estado;
    
    //constructor de la clase
    public function __construct() 
    {
        // obtener los argumentos
        $arg = func_get_args();
        // obtener el numero de argumentos
        $num = func_num_args();
        // comprobar si exite el método en $this
        if (method_exists($this, '__'.$num)) {
            // llamar al método dentro en $this
            call_user_func_array(array($this, '__'.$num), $arg);
        } else {
            throw new Exception('No existe un __construct con este número ('.$num.') de parametros');
        }
    }
    
    // __construct con 2 argumentos
    function __2($user_name, $post_id)
    {
        $this->user_name = $user_name;
        $this->post_id = $post_id;
        
    }
}
    
class NuevoLike extends Post_likes 
{
    function __construct($user_name, $post_id) 
    {
        parent::__construct($user_name, $post_id);
    }
    
    function getUser_name() {
        return $this->user_name;
    }
    
    function getPost_id() {
        return $this->post_id;
    }   
    
    
  }


?>