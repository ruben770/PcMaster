<?php

class Categoria
{
    private $id;
    private $nombre;
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

    function getAll()
    {
        $categrorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categrorias;
    }
    function getOne()
    {
        $categroria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()};");
        return $categroria->fetch_object();
    }

    function save()
    {
        $sql_n = "SELECT * FROM categorias WHERE nombre='{$this->getNombre()}'";
        $sql = "INSERT INTO categorias VALUES
        (NULL, '{$this->getNombre()}');";
        //$save = $this->db->query($sql);

        //$result = false;
        $res_n = $this->db->query($sql_n);
        if ($res_n->num_rows > 0) {
            $result = "la categoría ya está registrada";
            return $result;
        } elseif ($save = $this->db->query($sql)) {
            $result = true;
        }
        return $result;
    }
}//Cierra clase