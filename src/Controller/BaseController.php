<?php

namespace App\Controller;

class BaseController
{
    public function render($viewName, $params = [])
    {
        ob_start();
        require __DIR__ . "/../views/" . $viewName;
        $bodyContent = ob_get_clean();
        require __DIR__ . "/../views/base.view.php";
    }

    public function error404($viewName = 'base/error404.view.php')
    {
        $this->render($viewName);
    }
}
