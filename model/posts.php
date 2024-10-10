<?php

class Posts
{
    //atributos
    protected $id;
    protected $post_time;
    protected $added_by;
    protected $titulo;
    protected $categoria;
    protected $donde;
    protected $description;
    protected $palabra1;
    protected $palabra2;
    protected $palabra3;
    protected $photos;
    protected $precio;
    protected $report;
    protected $privado;
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
    
    // __construct con 9 argumentos
    function __9($titulo, $categoria, $donde, $description, $palabra1, $palabra2, $palabra3, $photos, $precio)
    {
        $this->titulo = $titulo;
        $this->categoria = $categoria;
        $this->donde = $donde;
        $this->description = $description;
        $this->palabra1 = $palabra1;
        $this->palabra2 = $palabra2;
        $this->palabra3 = $palabra3;
        $this->photos = $photos;
        $this->precio = $precio;
        
    }
}
    
class NuevoPosts extends Posts 
{
        function __construct($titulo, $categoria, $donde, $description, $palabra1, $palabra2, $palabra3, $photos, $precio) {
        parent::__construct($titulo, $categoria, $donde, $description, $palabra1, $palabra2, $palabra3, $photos, $precio);
        }
    
    function getTitulo() {
        return $this->titulo;
    }
    
    function getCategoria() {
        return $this->categoria;
    }
    
    function getDonde() {
        return $this->donde;
    }

    function getDescription() {
        return $this->description;
    }
    
    function getPalabra1() {
        return $this->palabra1;
    }
    
    function getPalabra2() {
        return $this->palabra2;
    }
    
    function getPalabra3() {
        return $this->palabra3;
    }
        
    function getPothos() {
        return $this->pothos;
    }
    
    function getPrecio() {
        return $this->precio;
    }
    
  }


?>
