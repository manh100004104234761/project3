<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 5:08 PM
 */

namespace BaoQuan\Databases;


use mysql_xdevapi\Exception;

abstract class AbstractDatabase
{

    protected $_databaseName = 'project3';
    protected $_connection;
    protected $_mainTable;
    protected $_idFieldName;

    /** @var $_columnNames array */
    protected $_columnNames;


    /**
     * @param null $tableName
     * @param null $condition
     * @return mixed
     * load data from tableName with condition
     */
    abstract protected function _fetch($tableName = null, $condition = null);

    /**
     * @param null $tableName
     * @param $data
     * @return mixed
     */
    abstract protected function _insert($tableName = null, $data);

    /**
     * @param null $tableName
     * @param $data
     * @param null $condition
     * @return mixed
     */
    abstract protected function _update($tableName = null, $data, $condition = null);

    /**
     * @param null $tableName
     * @param $id
     * @return mixed
     */
    abstract protected function _delete($tableName = null, $id);

    /**
     * @return array
     */
    public function getColumnNames()
    {
        return $this->_columnNames;
    }

    /**
     * @param array $columnName
     */
    public function setColumnNames($columnNames)
    {
        $this->_columnNames = $columnNames;
    }


    protected function _init($mainTable, $idFieldName)
    {
        $this->_setMainTable($mainTable, $idFieldName);
        $columnsName = $this->_getColumnNames();
        $this->setColumnNames($columnsName);
    }

    protected function _setMainTable($mainTable, $idFieldName)
    {
        $this->_mainTable = $mainTable;
        if (null === $idFieldName) {
            $idFieldName = $mainTable . '_id';
        }
        $this->_idFieldName = $idFieldName;
        return $this;
    }

    /**
     * @return array
     * load columnNames from database
     */
    protected function _getColumnNames()
    {
        $sql = "SELECT `COLUMN_NAME` 
                FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                WHERE `TABLE_SCHEMA`='$this->_databaseName' 
                AND `TABLE_NAME`='$this->_mainTable';";
        $result = $this->_connection->query($sql);
        $outArray = [];
        for ($i = 0; $i < $result->num_rows; $i++) {
            $attribute = $result->fetch_assoc();
            $outArray[$i] = array_values($attribute)[0];
        }
        return $outArray;
    }

    /**
     * Get primary key field name
     *
     * @throws LocalizedException
     * @return string
     * @api
     */
    public function getIdFieldName()
    {
        if (empty($this->_idFieldName)) {
            throw new Exception("Model do not exist key");
        }
        return $this->_idFieldName;
    }
}
