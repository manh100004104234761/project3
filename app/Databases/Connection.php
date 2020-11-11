<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 3:53 PM
 */

namespace BaoQuan\Databases;
require_once "Config.php";


class Connection
{

    private $Connection;

    public function __construct($databaseName = DB_NAME,
                                $userName = DB_USERNAME,
                                $password = DB_PASSWORD,
                                $serverName = DB_HOST)
    {

        try {
            if (isset($databaseName))
                $con = new \mysqli($serverName, $userName, $password, $databaseName);
            else
                $con = new \mysqli($serverName, $userName, $password);
            $this->Connection = $con;
            $this->Connection->set_charset('utf8');
        } catch (\Exception $exception) {
            throw new \Exception('Unable to connect, user name or password is incorrect');
        }
    }

    public function getConnection()
    {
        return $this->Connection;
    }
}
