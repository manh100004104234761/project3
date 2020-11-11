<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 2:46 AM
 */

namespace BaoQuan\Models;


class ProductAttribute extends AbstractModel
{
    public function _construct()
    {
        $this->_init('BaoQuan\Models\ResourcesModel\ProductAttributeResourcesModel');
    }
}