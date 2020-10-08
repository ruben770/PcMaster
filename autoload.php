<?php
class ClassNotFoundException extends Exception
{
}
function controllers_autoload($classname)
{

    $file = __DIR__ . '/' . 'controllers/' . $classname . '.php';
    if (!file_exists($file)) {
        throw new ClassNotFoundException($classname . "yyy " .  $file);
    }
    include($file);
}

spl_autoload_register('controllers_autoload');
