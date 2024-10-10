<?php

class Users
{
	//atributos
	protected $id;
	protected $first_name;
	protected $username;
	protected $email;
    protected $password;
    protected $gender;
    protected $fechNac;
    protected $coutry;
    protected $city;
    protected $hometon;
    protected $bio;
    protected $queote;
    protected $foto_perfil;
    protected $cover_pic;
    protected $mobile;
    protected $pub_email;
    protected $company;
    protected $position;
    protected $school;
    protected $concentration;
    protected $verify_id;
    protected $pregunta;

	//constructor de la clase
    public function __construct() 
    {
        // obtener los argumentos
        $arg = func_get_args();
        // obtener el numero de argumentos
        $num = func_num_args();
        // comprobar si exite el método en $this
        if (method_exists($this, '__'.$num)) 
        {
            // llamar al método dentro en $this
            call_user_func_array(array($this, '__'.$num), $arg);
        } 
        else 
        {
            throw new Exception('No existe un __construct con este número ('.$num.') de parametros');
        }
    }
    
    // __construct sin argumentos
    function __0(){}
    
    // __construct con 1 argumento
    function __1($username)
    {
      $this->username = $username;  
    }

    // __construct con dos argumentos
    function __2($username, $password)
    {
        $this->username = $username;        
        $this->password = $password;
    }
    
    // __construct con 7 argumentos
    function __7($first_name, $username,$email,$password, $gender,$fechNac, $pregunta)
    {
        $this->first_name = $first_name;
	    $this->username = $username;
	    $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
        $this->fechNac = $fechNac;
        $this->pregunta = $pregunta;
    }
}

class CheckUsername extends Users 
{
    function __construct($username) {
        parent::__construct($username);
    }
    
    function getUsername() {
        return $this->username;
    }
}

class LoginUsuario extends Users 
{
    function __construct($username, $password) {
        parent::__construct($username, $password);
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }
}

class NuevoUsuario extends Users 
{
    function __construct($first_name, $username, $email, $password, $gender, $fechNac, $pregunta) {
        parent::__construct($first_name, $username, $email, $password, $gender, $fechNac, $pregunta);
    }
    
    function getFirst_name() {
        return $this->first_name;
    }
    
    function getUsername() {
        return $this->username;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }
    
    function getGender() {
        return $this->gender;
    }
    
    function getFechNac() {
        return $this->fechNac;
    }
    
    function getPregunta() {
        return $this->pregunta;
    }
}

?>
