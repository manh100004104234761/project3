<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:20 AM
 */

namespace BaoQuan\Models\ResourcesModel;


class CustomerAddressResourcesModel extends AbstractResourceModel
{
    public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
    {
        parent::__construct($objectDatacase);
        $this->_init('customer_address', 'address_id');
    }
}