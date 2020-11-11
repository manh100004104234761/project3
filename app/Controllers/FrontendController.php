<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/16/20
 * Time: 3:10 PM
 */

namespace BaoQuan\Controllers;


class FrontendController extends BaseController
{
    protected $folder = 'Frontend';

    public function home(){
        $objectProduct = new \BaoQuan\Models\Product();
        $products = $objectProduct->_getResource()->load(null);
        $objectCategory = new \BaoQuan\Models\Category();
        $categories = $objectCategory->_getResource()->load();
        $this->render('home',[
            'products'=>$products,
            'categories'=>$categories
        ]);
    }

    public function productDetail(){
        $this->render('productDetail',[
            'data'=>'hihi'
        ]);
    }

    public function login(){
        $this->render('login',[
            'data'=>'hieu'
        ]);
    }

}