<?php
class ClassNotFoundException extends Exception
{
}
function controllers_autoload($classname)
{

    $file = 'controllers/' . $classname . '.php';
    if (!file_exists($file)) {
        throw new ClassNotFoundException($classname);
    }
    include($file);
}

spl_autoload_register('controllers_autoload');
