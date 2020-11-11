<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 3:53 PM
 */

namespace BaoQuan\Databases;


class Database extends AbstractDatabase
{

    public function __construct($databaseName = NULL)
    {
        if (isset($databaseName))
            $this->_databaseName = $databaseName;
        $objectConnection = new Connection($this->_databaseName);
        $this->_connection = $objectConnection->getConnection();
    }

    /**
     * @return \mysqli
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param \mysqli $connection
     */
    public function setConnection($connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @return string|null
     */
    public function getDatabaseName()
    {
        return $this->_databaseName;
    }

    /**
     * @param string|null $databaseName
     */
    public function setDatabaseName($databaseName)
    {
        $this->_databaseName = $databaseName;
    }

    /**
     * @return mixed
     */
    public function getMainTable()
    {
        return $this->_mainTable;
    }

    /**
     * @param mixed $mainTable
     */
    public function setMainTable($mainTable)
    {
        $this->_mainTable = $mainTable;
    }

    /**
     * @return mixed
     */
    public function getIdFieldName()
    {
        return $this->_idFieldName;
    }

    /**
     * @param mixed $idFieldName
     */
    public function setIdFieldName($idFieldName)
    {
        $this->_idFieldName = $idFieldName;
    }


    /**
     * @param $tableName
     * @param null $condition
     * @return array 2 dim | empty array
     */
    protected function _fetch($tableName = null, $condition = null)
    {
        if ($tableName == null)
            $tableName = $this->getMainTable();
        // TODO: Implement _fetch() method.
        if (!isset($condition))
            $sql = "SELECT * FROM $tableName";
        else
            $sql = "SELECT * FROM $tableName WHERE $condition";
        $result = $this->_connection->query($sql);
        if ($result == false)
            return [];
        $rows = [];
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_assoc();
            $rows[$i] = $row;
        }
        $result->free();
        return $rows;
    }

    /**
     * @param string $tableName
     * @param $data = [
     *             0=>['id'=>2,'name'=>'first',...],
     *             1=>['id'=>3,'name'=>'two',...]
     *          ]
     * @return array bool of result
     */
    protected function _insert($tableName = null, $data)
    {
        if ($tableName == null)
            $tableName = $this->getMainTable();

        // TODO: Implement _insert() method.
        if (!$this->isValidData($data))
            return array('FALSE');
        $results = array();
        $typeString = $this->getTypeString($data[0]);
        $maskString = $this->getMaskString($data[0]);
        foreach ($data as $key => $value) {
            $stmt = $this->_connection->prepare("INSERT INTO $tableName VALUES($maskString)");
            $param = array($typeString);
            $array = array_values($value);
            $count = count($array);
            for ($i = 0; $i < $count; $i++) {
                $param[$i + 1] = &$array[$i];
            }
            call_user_func_array(array($stmt, 'bind_param'), $param);
            if ($stmt->execute() == true)
                $results[$key] = 'TRUE';
            else
                $results[$key] = 'FALSE';
            $stmt->close();
        }
        return $results;
    }

    /**
     * @param $data
     * @return bool
     */
    protected function isValidData($data)
    {
        if (empty($data) || !isset($data))
            return FALSE;
        return TRUE;
    }

    /**
     * @param type $data
     * @return string
     * $data = ['id'=>2,'name'=>'first']
     * thì chuỗi trả về là : "is";
     */
    protected function getTypeString($data)
    {
        $string = '';
        foreach ($data as $key => $value) {
            if (is_int($value) || is_null($value)) {
                $string .= 'i';
            } elseif (is_double($value)) {
                $string .= 'd';
            } elseif (is_string($value)) {
                $string .= 's';
            } else {
                $string .= 'b';
            }
        }
        return $string;
    }

    /**
     *
     * @param type $data
     * @return type
     * Mảng data có bao nhiêu key
     * thì trả về một chuỗi có bấy nhiêu dấu "?"
     * các dấu "?" các nhau bởi đấu ","
     */
    protected function getMaskString($data)
    {
        $a = (array_fill(0, count($data), '?'));
        return implode(', ', $a);
    }


    /**
     *
     * @param string $tableName
     * @param type $data
     * @param string $condition
     * @return string
     * $data là mảng 2 chiều
     * trả về mảng 1 chiều bool
     */
    protected function _update($tableName = null, $data, $condition = null)
    {
        if ($tableName == null)
            $tableName = $this->getMainTable();

        // TODO: Implement _update() method.
        $results = [];
        if (isset($condition))
            $tail = "WHERE $condition";
        else
            $tail = "";
        foreach ($data as $index => $row) {
            $values = [];
            foreach ($row as $key => $value) {
                if ($value !== NULL) {
                    $key = $this->_connection->real_escape_string($key);
                    $value = $this->_connection->real_escape_string($value);
                    array_push($values, "$key = '$value'");
                }
            }
            $values = implode(", ", $values);
            $sql = "UPDATE $tableName SET $values $tail";
            if ($this->_connection->query($sql))
                $results[$index] = 'TRUE';
            else
                $results[$index] = 'FALSE';
        }
        return $results;
    }


    /**
     *
     * @param string $tableName
     * @param int $id
     * @return boolean
     * Nếu truy vấn lỗi thì trả về false và ngược lại
     *
     */
    protected function _delete($tableName = null, $id)
    {
        if ($tableName == null)
            $tableName = $this->getMainTable();

        // TODO: Implement _delete() method.
        $sql = "DELETE FROM $tableName WHERE $this->_idFieldName = $id";
        if ($this->_connection->query($sql))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * @param \BaoQuan\Models\AbstractModel $object
     */
    public function delete(\BaoQuan\Models\AbstractModel $object){
        $id = $object->getIdFieldName();
        $this->_delete(null,$id);
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
        echo "da vo save";
        $data = $this->_prepareDataBeforeSave($object);
        $result = [];
        $a = $this->isNew($object);
        if ($this->isNew($object)) {
            $result = $this->_insert($this->_mainTable, $data);
        } else {
            //Todo
            // Build condition update
            if ($this->isValidPrimaryKeyValue($object))
                $condition = $this->_idFieldName . " = " . $object->getData()[$this->_idFieldName];
            else
                $condition = NULL;
            $result = $this->_update($this->_mainTable, $data, $condition);
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
        foreach ($this->_columnNames as $index => $key) {
            if (isset($data[$key]))
                $outArray[$key] = $data[$key];
            else
                $outArray[$key] = NULL;
        }
        return array($outArray);
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
        $id = $this->_idFieldName;
        if ($this->isValidPrimaryKeyValue($object)) {
            if (!empty($this->load($object->getData()[$id])))
                return false;
        }
        return true;
    }

    /**
     * @param $id
     * @return array
     * Nếu load thành công thì trả về mảng chứ dữ liệu
     * Ngược lại trả về mảng rỗng
     */
    public function load($id)
    {
        //Todo
        // Build condition
        $condition = $this->_idFieldName . " = $id";
        $result = $this->_fetch($this->_mainTable, $condition);
        // Check result va tra ket qua
        if (!empty($result))
            return $result;
        return array();
    }

    /**
     * @param \BaoQuan\Models\AbstractModel $object
     * @return bool
     * Nếu tồn tại giá trị của primary key thì trả về true
     * Ngược lại trả về false
     */
    public function isValidPrimaryKeyValue(\BaoQuan\Models\AbstractModel $object)
    {
        $id = $this->_idFieldName;
        if (isset($object->getData()[$id]) && !empty($object->getData()[$id]))
            return true;
        return false;
    }


}