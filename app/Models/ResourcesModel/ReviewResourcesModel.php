<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:19 AM
 */

namespace BaoQuan\Models\ResourcesModel;


class ReviewResourcesModel extends AbstractResourceModel
{
    public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
    {
        parent::__construct($objectDatacase);
        $this->_init('review', 'review_id');
    }
}