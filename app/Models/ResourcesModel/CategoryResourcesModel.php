<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 6:25 PM
 */

namespace BaoQuan\Models\ResourcesModel;


class CategoryResourcesModel extends AbstractResourceModel
{
    public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
    {
        parent::__construct($objectDatacase);
        $this->_init('category', 'category_id');
    }
}