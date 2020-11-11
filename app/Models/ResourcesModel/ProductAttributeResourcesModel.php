<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 2:47 AM
 */

namespace BaoQuan\Models\ResourcesModel;


class ProductAttributeResourcesModel extends AbstractResourceModel
{
    public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
    {
        parent::__construct($objectDatacase);
        $this->_init('product_attribute_value', ['product_id','attribute_value_id']);

    }
}