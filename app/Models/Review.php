<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:14 AM
 */

namespace BaoQuan\Models;


class Review extends AbstractModel
{
    public function _construct()
    {
        $this->_init('BaoQuan\Models\ResourcesModel\ReviewResourcesModel');
    }
}