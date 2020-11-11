<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:31 AM
 */

namespace BaoQuan\Models\ResourcesModel;


class AbstractResourceModel
{
    protected $_databaseName = 'project3';
    protected $_connection;
    protected $_mainTable;
    protected $_idFieldName;
    protected $_objectDatabase;

    protected $_columnsName;

    public function __construct(\BaoQuan\Databases\MysqlDatabase $objectDatacase)
    {
        $this->_objectDatabase = $objectDatacase;
    }


    protected function _init($mainTable, $idFieldName)
    {
        $this->_setMainTable($mainTable, $idFieldName);
        $columnsName = $this->_getColumnNames();
        $this->_setColumnNames($columnsName);
    }


    /**
     * @return array
     */
    public function getColumnNames()
    {
        return $this->_columnsName;
    }

    /**
     * @param array $columnName
     */
    public function _setColumnNames($columnNames)
    {
        $this->_columnsName = $columnNames;
    }

    /**
     * @return string
     */
    public function _getDatabaseName()
    {
        return $this->_databaseName;
    }

    /**
     * @param string $databaseName
     */
    public function _setDatabaseName($databaseName)
    {
        $this->_databaseName = $databaseName;
    }

    /**
     * @return \mysqli
     */
    public function _getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param mixed $connection
     */
    public function _setConnection($connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @return mixed
     */
    public function _getMainTable()
    {
        return $this->_mainTable;
    }

    /**
     * @param mixed $mainTable
     */
    public function _setMainTable($mainTable, $idFieldName)
    {
        $this->_mainTable = $mainTable;
        if (null === $idFieldName) {
            $idFieldName = $mainTable . '_id';
        }
        $this->_idFieldName = $idFieldName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function _getIdFieldName()
    {
        if (empty($this->_idFieldName)) {
            throw new Exception("Model do not exist key");
        }
        return $this->_idFieldName;
    }

    /**
     * @param mixed $idFieldName
     */
    public function _setIdFieldName($idFieldName)
    {
        $this->_idFieldName = $idFieldName;
    }

    /**
     * @return \BaoQuan\Databases\MysqlDatabase
     */
    public function _getObjectDatabase()
    {
        return $this->_objectDatabase;
    }

    /**
     * @param \BaoQuan\Databases\MysqlDatabase $objectDatabase
     */
    public function _setObjectDatabase($objectDatabase)
    {
        $this->_objectDatabase = $objectDatabase;
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
        $result = $this->_objectDatabase->getConnection()->query($sql);
        $outArray = [];
        for ($i = 0; $i < $result->num_rows; $i++) {
            $attribute = $result->fetch_assoc();
            $outArray[$i] = array_values($attribute)[0];
        }
        return $outArray;
    }


    /**
     * @param \BaoQuan\Models\AbstractModel $object
     */
    public function delete(\BaoQuan\Models\AbstractModel $object)
    {
//        $id = $object->getIdFieldName();
        $condition = $this->getCondition($object->getArrayKey());
            $this->_objectDatabase->_delete($this->_mainTable, $condition);
        return $this;
    }

    /**
     *
     * @return array
     * Nếu đã có trong csdl => update
     * Ngược lại thì insert
     */
    public function save(\BaoQuan\Models\AbstractModel $object)
    {
        $data = $this->_prepareDataBeforeSave($object);
        if ($this->isNew($object)) {
            $result = $this->_objectDatabase->_insert($this->_mainTable, $data);
        } else {
            //Todo
            // Build condition update
            if ($this->isValidPrimaryKeyValue($object))
                $condition = $this->getCondition($object->getArrayKey());
            else
                $condition = NULL;
            $result = $this->_objectDatabase->_update($this->_mainTable, $data, $condition);
        }
        $this->_prepareDataAfterSave($result[0]);
        return $this;
    }

    public function _prepareDataAfterSave($result)
    {

    }

    public function _prepareDataBeforeSave(\BaoQuan\Models\AbstractModel $object)
    {
        $outArray = [];
        $data = $object->getData();
        foreach ($this->_columnsName as $index => $key) {
            if (isset($data[$key]))
                $outArray[$key] = $data[$key];
            else
                $outArray[$key] = NULL;
        }
        return array($outArray);
    }

    /**
     * @param int|array $id
     * @return array
     * Nếu load thành công thì trả về mảng chứ dữ liệu
     * Ngược lại trả về mảng rỗng
     */
    public function load($id=null)
    {
        //Todo
        // Build condition
        if (is_array($id))
            $condition = $this->getCondition($id);
        else if (is_string($id))
            $condition = $this->_idFieldName . " = $id";
        else
            $condition = null;
        $result = $this->_objectDatabase->_fetch($this->_mainTable, $condition);
        // Check result va tra ket qua
        if (!empty($result))
            return $result;
        return array();
    }


    /**
     * @return bool
     * nếu chưa set key => true
     * nếu đã có key và key chưa tồn tại trong db => true
     * nếu đã có key và key  tồn tại trong db => false
     */
    public function isNew(\BaoQuan\Models\AbstractModel $object)
    {
        //Todo
        // Logic check có tồn tại giá trị của primary key
        // nếu chưa set key => true
        // nếu đã có key và key chưa tồn tại trong db => true
        // nếu đã có key và key  tồn tại trong db => false
        if ($this->isValidPrimaryKeyValue($object)) {
            if (!empty($this->load($object->getArrayKey())))
                return false;
        }
        return true;
    }

    /**
     *
     * @return string
     * Hàm có khóa là nhiều cột hợp thành
     * Thì phải kiểm tra điều kiện theo các cột đó
     */
    public function getCondition($array)
    {
        $condition = array();
        foreach ($array as $key => $value) {
            array_push($condition, $key . " = " . "'$array[$key]'");
        }
        $condition = implode(" AND ", $condition);
        return $condition;
    }

    /**
     * @param \BaoQuan\Models\AbstractModel $object
     * @return bool
     * Nếu tồn tại giá trị của primary key thì trả về true
     * Ngược lại trả về false
     */
    public function isValidPrimaryKeyValue(\BaoQuan\Models\AbstractModel $object)
    {
        // neu la array
        if (is_array($object->getIdFieldName())) {
            $idFieldNames = $object->getIdFieldName();
            foreach ($idFieldNames as $index => $key) {
                if (!isset($object->getData()[$key]) || empty($object->getData()[$key]))
                    return false;
            }
            return true;
        }

        // neu la string
        $id = $this->_idFieldName;
        if (isset($object->getData()[$id]) && !empty($object->getData()[$id]))
            return true;
        return false;
    }


}