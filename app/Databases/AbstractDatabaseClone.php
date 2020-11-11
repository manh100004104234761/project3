<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:58 AM
 */

namespace BaoQuan\Databases;


abstract class AbstractDatabaseClone
{
    protected $_databaseName = 'project3';
    protected $_connection;
    protected $_objectConnection;
    /**
     * @param null $tableName
     * @param null $condition
     * @return mixed
     * load data from tableName with condition
     */
    abstract protected function _fetch($tableName , $condition = null);

    /**
     * @param null $tableName
     * @param $data
     * @return mixed
     */
    abstract protected function _insert($tableName , $data);

    /**
     * @param null $tableName
     * @param $data
     * @param null $condition
     * @return mixed
     */
    abstract protected function _update($tableName , $data, $condition = null);

    /**
     * @param null $tableName
     * @param $id
     * @return mixed
     */
    abstract protected function _delete($tableName , $condition);

    /**
     * @return \mysqli
     */
    public function getConnection(){
        return $this->_connection;
    }

}