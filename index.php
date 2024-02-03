<?php
include_once 'config.php';
$query = explode('/', $_REQUEST['url']);
$controller = ucfirst($query[0]);
array_shift($query);
if (!empty($query[0]))
{
    $action = $query[0];
}
else
{
    $action = 'index';
}
array_shift($query);
spl_autoload_register(function ($class)
{
    $path = str_replace('_', '/', $class);

    if (file_exists(CONTROLLERS_PATH . "$path.php"))
    {
        $path = CONTROLLERS_PATH . "$path.php";
    }
    else if (file_exists(LIB_PATH . "$path.php"))
    {
        $path = LIB_PATH . "$path.php";
    }
    require_once $path;
});

if (!empty($query))
{
    call_user_func_array(array(new $controller(), $action), $query);
}
else
{
    call_user_func(array(new $controller(), $action));
}
