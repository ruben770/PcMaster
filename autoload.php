<?php
class ClassNotFoundException extends Exception
{
}
function controllers_autoload($classname)
{

    $file = 'controllers' . DIRECTORY_SEPARATOR . $classname . '.php';
    if (!file_exists($file)) {
        throw new ClassNotFoundException($classname . "yyy " .  $file);
    }
    include($file);
    echo "<h4>$file incluido</h4>";
}

spl_autoload_register('controllers_autoload');
