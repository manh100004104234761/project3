<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/16/20
 * Time: 3:09 PM
 */

namespace BaoQuan\Controllers;


class AdminController extends BaseController
{
    protected $folder = 'Admin';

    public function home()
    {
        $data = [
            1 => 'hihi',
            'hai' => 'hoho'
        ];
        $this->render('home', $data);
    }

}