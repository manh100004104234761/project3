<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 6:24 PM
 */

namespace BaoQuan\Models;


class Attribute extends AbstractModel
{
    public function _construct()
    {
        $this->_init('BaoQuan\Models\ResourcesModel\AttributeResourcesModel');
    }
}