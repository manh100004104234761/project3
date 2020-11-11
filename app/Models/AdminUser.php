<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:14 AM
 */

namespace BaoQuan\Models;


class AdminUser extends AbstractModel
{
    public function _construct()
    {
        $this->_init('BaoQuan\Models\ResourcesModel\AdminUserResourcesModel');
    }
}