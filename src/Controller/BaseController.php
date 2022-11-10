<?php

namespace App\Controller;

class BaseController
{
    function render($viewName, $params = [])
    {
        ob_start();
        require __DIR__ . "/../views/" . $viewName;
        $bodyContent = ob_get_clean();
        require __DIR__ . "/../views/base.view.php";
    }
}
