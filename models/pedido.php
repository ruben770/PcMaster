<?php

class Pedido
{
    private $id;
    private $usuario_id;
    private $entidad;
    private $municipio;
    private $direccion;
    private $costo;
    private $estado;
    private $fecha;
    private $hora;
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

    function getUsuario_id()
    {
        return $this->usuario_id;
    }

    function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $this->db->real_escape_string($usuario_id);
    }
    function getEntidad()
    {
        return $this->entidad;
    }

    function setEntidad($entidad)
    {
        $this->entidad = $this->db->real_escape_string($entidad);
    }

    function getMunicipio()
    {
        return $this->municipio;
    }

    function setMunicipio($municipio)
    {
        $this->municipio = $this->db->real_escape_string($municipio);
    }

    function getDireccion()
    {
        return $this->direccion;
    }

    function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function getCosto()
    {
        return $this->costo;
    }

    function setCosto($costo)
    {
        $this->costo = $this->db->real_escape_string($costo);
    }

    function getEstado()
    {
        return $this->estado;
    }

    function setEstado($estado)
    {
        $this->estado = $this->db->real_escape_string($estado);
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function setFecha($fecha)
    {
        $this->fecha = $this->db->real_escape_string($fecha);
    }

    function getHora()
    {
        return $this->hora;
    }

    function setHora($hora)
    {
        $this->hora = $hora;
    }

    function getAll()
    {
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");
        return $pedidos;
    }

    function getOne()
    {
        $pedido = $this->db->query("SELECT * FROM pedidos WHERE id={$this->getId()};");
        return $pedido->fetch_object();
    }
    function getOneByUser()
    {
        $sql = "SELECT p.id, p.costo FROM pedidos p
        WHERE p.usuario_id={$this->getUsuario_id()} ORDER BY id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);

        return $pedido->fetch_object();
    }
    function getAllByUser()
    {
        $sql = "SELECT p.* FROM pedidos p
        WHERE p.usuario_id={$this->getUsuario_id()} ORDER BY id;";
        $pedidos = $this->db->query($sql);

        return $pedidos;
    }
    function getProductsByPedido($id)
    {
        $sql = "SELECT * FROM productos WHERE id IN
        (SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id});";

        $sql = "SELECT p.*, lp.unidades FROM productos p
        INNER JOIN lineas_pedidos lp ON p.id = lp.producto_id
        WHERE lp.pedido_id = {$id}";
        $productos = $this->db->query($sql);
        // var_dump($sql);
        // echo $this->db->error;
        // die();

        return $productos;
    }

    public function save()
    {
        $sql = "INSERT INTO pedidos VALUES
        (NULL,{$this->getUsuario_id()},'{$this->getEntidad()}', 
        '{$this->getMunicipio()}', 
        '{$this->getDireccion()}', 
        {$this->getCosto()}, 
        'Confirmed', CURDATE(), CURTIME());";

        if ($save = $this->db->query($sql)) {
            $result = true;
        } else {
            $result = $this->db->error;
        }
        return $result;
    }

    public function save_linea()
    {
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido'";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        //var_dump($pedido_id);

        foreach ($_SESSION['carrito'] as $indice => $elemento) {
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES (
                NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']}
            )";
            $save = $this->db->query($insert);
            // var_dump($producto);
            // var_dump($insert);
            // echo $this->db->error;
            // die();
        }
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function updateEstado()
    {
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
        $sql .= "WHERE id={$this->getId()};";
        // var_dump($sql);
        // die();

        if ($save = $this->db->query($sql)) {
            $result = true;
        } else {
            $result = $this->db->error;
        }
        return $result;
    }
}//End clase