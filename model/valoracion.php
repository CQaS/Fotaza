<?php

class Valoracion
{
    //atributos
    protected $id;
    protected $user_name;
    protected $post_id;
    protected $valor;
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
    
    // __construct con 3 argumentos
    function __3($user_name, $post_id, $valor)
    {
        $this->user_name = $user_name;
        $this->post_id = $post_id;
        $this->valor = $valor;
        
    }
}
    
class NuevaValoracion extends Valoracion 
{
        function __construct($user_name, $post_id, $valor) {
        parent::__construct($user_name, $post_id, $valor);
        }
    
    function getUser_name() {
        return $this->user_name;
    }
    
    function getPost_id() {
        return $this->post_id;
    }
    
    function getValor() {
        return $this->valor;
    }
    
  }


?>