<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:23 AM
 */

namespace BaoQuan\Models\ResourcesModel;


class CartItemsResourcesModel extends AbstractResourceModel
{
    public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
    {
        parent::__construct($objectDatacase);
        $this->_init('cart_items', 'item_id');
    }
}