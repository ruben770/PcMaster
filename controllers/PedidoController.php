<?php

require_once 'models/pedido.php';
class PedidoController
{
    public function hacer()
    {
        require_once 'views/pedido/hacer.php';
    }

    public function add()
    {
        if (isset($_SESSION['identity'])) {

            if (isset($_POST)) {

                $res = Utils::validateOrder();
                if (gettype($res) === 'array') {
                    // var_dump($res[7]);
                    // die();
                    $pedido = new Pedido();
                    $pedido->setUsuario_id($_SESSION['identity']->id);
                    $pedido->setEntidad($res[0]);
                    $pedido->setMunicipio($res[1]);
                    $pedido->setDireccion($res[2]);
                    $pedido->setCosto(Utils::statsCarrito()['total']);

                    $save = $pedido->save();
                    $save_linea = $pedido->save_linea();

                    if ($save === true && $save_linea === true) {
                        $_SESSION['pedido'] = 'complete';
                    } else {
                        //error de sql
                        $_SESSION['error'] = $save;
                        $_SESSION['pedido'] = 'failed';
                    }
                } else {
                    //error por validacion
                    $_SESSION['pedido'] = 'failed';
                    $_SESSION['error'] = $res;
                }
            } else {
                //error por metodo http incorrecto
                $_SESSION['error'] = "intente de nuevo.";
                $_SESSION['pedido'] = 'failed';
            }
            header('Location:' . base_url . 'Pedido/confirmado');
            // //guardar en bd
            // $pedido = new Pedido();
            // $pedido->setEstado();
        } else {
            //redirect a index
            header('Location:' . base_url);
        }
    }

    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();

            $productos_pedido = new Pedido();
            $productos_pedido = $productos_pedido->getProductsByPedido($pedido->id);
        }
        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos()
    {
        //Falta implementar que en la vista mis pedidos muestre que no tienes pedidos
        //si asi es el caso.
        Utils::isUser();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        require_once 'views/pedido/mis_pedidos.php';
    }
    public function detalle()
    {
        Utils::isUser();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //Sacar pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();
            //Sacar productos
            $productos_pedido = new Pedido();
            $productos_pedido = $productos_pedido->getProductsByPedido($id);

            require_once 'views/pedido/detalle.php';
        } else {

            header('Location:' . base_url . 'Pedido/mis_pedidos');
        }
    }

    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado()
    {
        Utils::isAdmin();
        if (isset($_POST['id_pedido']) && isset($_POST['estado'])) {
            //Updating pedido
            $pedido = new Pedido();
            $pedido->setId($_POST['id_pedido']);
            $pedido->setEstado($_POST['estado']);
            $pedidos = $pedido->updateEstado();
            header('Location:' . base_url . 'Pedido/detalle&id=' . $_POST['id_pedido']);
        } else {
            header('Location:' . base_url);
        }
    }
}
