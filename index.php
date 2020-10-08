<?php
session_start();
ob_start();

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layouts/header.php';


$db = Database::connect();

function err404()
{
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    //var_dump($_GET['controller']);
    $nombre_controlador = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = defaultController;
} else {
    err404();
    echo "<h1>Primer error</h1>";
}

try {


    if (class_exists($nombre_controlador)) {
        //var_dump(class_exists($nombre_controlador, false));

        $controlador = new $nombre_controlador();

        if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
            $action = $_GET['action'];
            $controlador->$action();
        } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
            $action = defaultMethod;
            $controlador->$action();
        } else {
            err404();
            echo "<h1>seg error</h1>";
        }
    } else {
        err404();
        echo "<h1>terc error</h1>";

        //echo 'Error 404, Not Found';
    }
} catch (ClassNotFoundException $e) {
    err404();
    echo "<h1>cuart error</h1>";
}
// require_once 'views/layouts/sidebar.php';
require_once 'views/layouts/footer.php';
