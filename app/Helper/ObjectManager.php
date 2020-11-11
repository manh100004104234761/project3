<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 8:54 PM
 */

namespace BaoQuan\Helper;


class ObjectManager
{

    private static $_instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$_instance !== null)
            return self::$_instance;
        self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * @param string $type
     * type is name of resourceModel
     */
    public function get($type)
    {
        $connection = new \BaoQuan\Databases\Connection();
        $objectDatabase= new \BaoQuan\Databases\MysqlDatabase($connection);
        $class = new $type($objectDatabase);
        return $class;
    }

}