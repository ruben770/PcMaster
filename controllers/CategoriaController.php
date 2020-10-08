<?php

require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoriaController
{
    public function index()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    public function ver()
    {
        //Conseguir Categoria
        if (isset($_GET['id'])) {
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $categoria = $categoria->getOne();
        }
        //Conseguir Productos
        $producto = new Producto();
        $producto->setCategoria_id($_GET['id']);
        $productos = $producto->getAllCategory();
        require_once 'views/categoria/ver.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();



        if (isset($_POST) && isset($_POST['nombre'])) {

            //Guardar categoria en bd
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

            $save = $categoria->save();

            if ($save === true) {
                $_SESSION['register'] = 'complete';
                header('Location:' . base_url . 'Categoria/crear');
            } else {
                $_SESSION['error'] = $save;
                $_SESSION['register'] = 'failed';
                header('Location:' . base_url . 'Categoria/crear');
            }
        } else {
            $_SESSION['error'] = "intente de nuevo.";
            $_SESSION['register'] = 'failed';
            header(('Location:' . base_url . "Categoria/crear"));
        }
    }
}
