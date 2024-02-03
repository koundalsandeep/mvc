<?php

class Controller
{


    function view($view, $variables = null)
    {
        if (!empty($variables)) {
            extract($variables);
        }
        return require_once VIEW_PATH . $view . '.php';
    }

    function model($model)
    {
        require_once MODEL_PATH . $model . '.php';
        $this->$model = new $model();
        return $this;
    }

    function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die;
    }
}
