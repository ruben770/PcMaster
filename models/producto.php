<?php

class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
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

    function getCategoria_id()
    {
        return $this->categoria_id;
    }

    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }
    function getNombre()
    {
        return $this->nombre;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function getStock()
    {
        return $this->stock;
    }

    function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function getOferta()
    {
        return $this->oferta;
    }

    function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function setFecha($fecha)
    {
        $this->fecha = $this->db->real_escape_string($fecha);
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    function getAll()
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC;");
        return $productos;
    }
    function getAllCategory()
    {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p
        INNER JOIN categorias c ON c.id = p.categoria_id
        WHERE p.categoria_id = {$this->getCategoria_id()}
        ORDER BY id DESC;";
        $productos = $this->db->query($sql);
        return $productos;
    }
    function getOne()
    {
        $producto = $this->db->query("SELECT * FROM productos WHERE id={$this->getId()};");
        return $producto->fetch_object();
    }
    function getRandom($limit)
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit;");
        return $productos;
    }
    public function save()
    {
        $sql = "INSERT INTO productos VALUES
        (NULL,{$this->getCategoria_id()},'{$this->getNombre()}', 
        '{$this->getDescripcion()}', 
        {$this->getPrecio()}, 
        {$this->getStock()}, 
        '{$this->getOferta()}', '{$this->getFecha()}',
        IF ('{$this->getImagen()}' = '', NULL,'{$this->getImagen()}'));";

        if ($save = $this->db->query($sql)) {
            $result = true;
        } else {
            $result = $this->db->error;
        }
        return $result;
    }
    public function edit()
    {
        $sql = "UPDATE productos SET categoria_id={$this->getCategoria_id()}, nombre='{$this->getNombre()}', 
        descripcion='{$this->getDescripcion()}', 
        precio={$this->getPrecio()}, 
        stock={$this->getStock()}, 
        oferta='{$this->getOferta()}', fecha='{$this->getFecha()}'";
        if ($this->getImagen() != null) {
            $sql .= ",imagen=IF ('{$this->getImagen()}' = '', NULL,'{$this->getImagen()}')";
        }
        $sql .= "WHERE id={$this->id};";
        // var_dump($sql);
        // die();

        if ($save = $this->db->query($sql)) {
            $result = true;
        } else {
            $result = $this->db->error;
        }
        return $result;
    }

    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        if ($delete = $this->db->query($sql)) {
            $result = true;
        } else {
            $result = $this->db->error;
        }
        return $result;
    }
}//End clase