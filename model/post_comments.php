<?php

class Post_comments
{
    //atributos
    protected $id;
    protected $post_body;
    protected $time;
    protected $posted_by;
    protected $posted_to;
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
    
    // __construct con 4 argumentos
    function __4($post_body, $posted_by, $posted_to, $post_id)
    {
        $this->post_body = $post_body;
        $this->posted_by = $posted_by;
        $this->posted_to = $posted_to;
        $this->post_id = $post_id;
    }
}
    
class NuevoComentario extends Post_comments 
{
        function __construct($post_body, $posted_by, $posted_to, $post_id) {
        parent::__construct($post_body, $posted_by, $posted_to, $post_id);
        }
    
    function getPost_body() {
        return $this->post_body;
    }
    
    function getPosted_by() {
        return $this->posted_by;
    }
    
    function getPosted_to() {
        return $this->posted_to;
    }

    function getPost_id() {
        return $this->post_id;
    }
    
  }


?>