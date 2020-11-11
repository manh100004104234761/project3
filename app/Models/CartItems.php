<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:15 AM
 */

namespace BaoQuan\Models;


class CartItems extends AbstractModel
{
    public function _construct()
    {
        $this->_init('BaoQuan\Models\ResourcesModel\CartItemsResourcesModel');
    }
}