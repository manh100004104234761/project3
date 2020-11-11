<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 6:23 PM
 */

namespace BaoQuan\Models;


class Product extends AbstractModel
{
    public function _construct()
    {
        $this->_init('BaoQuan\Models\ResourcesModel\ProductResourcesModel');
    }

}