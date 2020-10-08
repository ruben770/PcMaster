<?php
require_once 'models/usuario.php';

class UsuarioController
{
    public function index()
    {
        echo "Controlador Usuarios, Acción index.";
    }

    public function register()
    {

        require_once 'views/usuario/registro.php';
    }

    public function save()
    {
        if (isset($_POST)) {


            // $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            // $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            // $email = isset($_POST['email']) ? $_POST['email'] : false;
            // $password = isset($_POST['password']) ? $_POST['password'] : false;

            $res = Utils::validateUser();
            if (gettype($res) === 'array') {
                //var_dump($res);
                $usuario = new Usuario();
                $usuario->setNombre($res[0]);
                $usuario->setApellidos($res[1]);
                $usuario->setEmail($res[2]);
                $usuario->setPassword($res[3]);

                $save = $usuario->save();

                if ($save === true) {
                    $_SESSION['register'] = 'complete';
                    header('Location:' . base_url . 'Usuario/register');
                } else {
                    $_SESSION['error'] = $save;
                    $_SESSION['register'] = 'failed';
                    header('Location:' . base_url . 'Usuario/register');
                }
            } else {
                $_SESSION['register'] = 'failed';
                $_SESSION['error'] = $res;
                header('Location:' . base_url . 'Usuario/register');
            }
        } else {
            $_SESSION['error'] = "intente de nuevo.";
            $_SESSION['register'] = 'failed';
            header('Location:' . base_url . 'Usuario/register');
        }
    }

    public function login()
    {
        if (isset($_POST)) {
            //identificar al usuario
            //Query a bd
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'Identificación fallida';
            }
            //Crear sesion
        }
        header('Location:' . base_url);
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header('Location:' . base_url);
    }
}
