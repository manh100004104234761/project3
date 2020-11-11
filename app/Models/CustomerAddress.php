<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:18 AM
 */

namespace BaoQuan\Models;


class CustomerAddress extends AbstractModel
{
    public function _construct()
    {
        $this->_init('BaoQuan\Models\ResourcesModel\CustomerAddressResourcesModel');
    }
}