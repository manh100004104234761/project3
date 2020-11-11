<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:25 AM
 */

namespace BaoQuan\Models\ResourcesModel;


class AdminUserResourcesModel extends AbstractResourceModel
{
   public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
   {
       parent::__construct($objectDatacase);
       $this->_init('admin_user', 'admin_id');
   }
}