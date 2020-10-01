<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function getApellidos()
    {
        return $this->apellidos;
    }

    function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT);
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function getRol()
    {
        return $this->rol;
    }

    function setRol($rol)
    {
        $this->rol = $rol;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function save()
    {
        $sql_e = "SELECT * FROM usuarios WHERE email='{$this->getEmail()}'";
        $sql = "INSERT INTO usuarios VALUES
        (NULL, '{$this->getNombre()}', 
        '{$this->getApellidos()}', 
        '{$this->getEmail()}', 
        '{$this->getPassword()}', 
        'user', null);";
        //$save = $this->db->query($sql);

        //$result = false;
        $res_e = $this->db->query($sql_e);
        if ($res_e->num_rows > 0) {
            $result = "El correo electrónico usado ya está registrado";
            return $result;
        } elseif ($save = $this->db->query($sql)) {
            $result = true;
        }
        return $result;
    }

    public function login()
    {
        $email = $this->email;
        $password = $this->password;
        $result = false;
        $sql_e = "SELECT * FROM usuarios WHERE email='$email'";
        $login = $this->db->query($sql_e);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            //verificar password
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
    }
}
