<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 6:25 PM
 */

namespace BaoQuan\Models\ResourcesModel;

class ProductResourcesModel extends \BaoQuan\Models\ResourcesModel\AbstractResourceModel
{
    public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
    {
        parent::__construct($objectDatacase);
        $this->_init('product', 'product_id');
    }

    // get all
    public function getAllProduct()
    {
        var_dump($this->fetch());
    }

    // update
    public function updateProduct()
    {
        $data = [
            [
                'name' => "iPhone 2G (20)",
                'price' => "4",
                'image' => "cac-doi-iphone-tung-ra-mat-1.jpg",
                'description' => "Không có mô tả nào"
            ]
        ];

        var_dump($this->update($data));
    }

    // insert
    public function insertProduct()
    {
        $data = [
            [
                'idProduct' => 60,
                'name' => "iPhone 2G (2008)",
                'price' => "4",
                'image' => "cac-doi-iphone-tung-ra-mat-1.jpg",
                'description' => "Không có mô tả nào"
            ]
        ];

        var_dump($this->insert($data));
    }

    //delete
    public function deteleProduct()
    {
        var_dump($this->delete(60));
    }
}
