<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/16/20
 * Time: 2:52 PM
 */

namespace BaoQuan\Controllers;


abstract class BaseController
{
    protected $folder;

    protected function render($view, $data = [])
    {
        $root = 'app/';

        $view_file = $root . 'Views' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $view . '.php';

        if (is_file($view_file)) {
            extract($data); # Convert data array to params
            require_once($view_file);

        } else {
            echo 'can\'t find view file '.$view_file;
        }
    }
}