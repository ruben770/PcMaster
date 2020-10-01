<?php
require_once 'models/producto.php';

class ProductoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        //renderizar vista
        require_once 'views/producto/destacados.php';
        //echo "Controlador Producto, Acción index.";
    }
    public function ver()
    {
        if (isset($_GET['id'])) {
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $prod = $producto->getOne();
        }
        require_once 'views/producto/ver.php';
    }

    function gestion()
    {
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/gestion.php';
    }

    function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {

            $res = Utils::validateProduct();
            if (gettype($res) === 'array') {
                // var_dump($res[7]);
                // die();
                $producto = new Producto();
                $producto->setCategoria_id($res[0]);
                $producto->setNombre($res[1]);
                $producto->setDescripcion($res[2]);
                $producto->setPrecio($res[3]);
                $producto->setStock($res[4]);
                $producto->setOferta($res[5]);
                $producto->setFecha($res[6]);
                $producto->setImagen($res[7]);

                if (isset($_GET['id'])) {
                    $producto->setId($_GET['id']);
                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }


                if ($save === true) {
                    $_SESSION['register'] = 'complete';
                } else {
                    $_SESSION['error'] = $save;
                    $_SESSION['register'] = 'failed';
                }
            } else {
                $_SESSION['register'] = 'failed';
                $_SESSION['error'] = $res;
            }
        } else {
            $_SESSION['error'] = "intente de nuevo.";
            $_SESSION['register'] = 'failed';
        }
        header('Location:' . base_url . '/producto/crear');
    }

    function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $edit = true;
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $prod = $producto->getOne();
            require_once 'views/producto/crear.php';
        } else {
            header('Location:' . base_url . 'producto/gestion');
        }
    }

    function eliminar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $delete = $producto->delete();
            if ($delete === true) {
                $_SESSION['deledit'] = 'deleted';
            } else {
                $_SESSION['errord'] = $delete;
                $_SESSION['deledit'] = 'deletefail';
            }
        } else {
            $_SESSION['errord'] = "intente de nuevo.";
            $_SESSION['deledit'] = 'deletefail';
        }

        header('Location:' . base_url . 'producto/gestion');
    }
}
