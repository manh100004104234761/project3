<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/9/20
 * Time: 12:48 AM
 */

namespace BaoQuan\Databases;


class MysqlDatabase extends AbstractDatabaseClone
{
    public function __construct(
        \BaoQuan\Databases\Connection $objectConnection,
        $database = null
    )
    {
        if ($database != null)
            $this->_databaseName = $database;
        $this->_objectConnection = $objectConnection;
        $this->_connection = $objectConnection->getConnection();
    }



    public function _fetch($tableName, $condition = null)
    {
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

    public function _insert($tableName, $data)
    {
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


    public function _update($tableName, $data, $condition = null)
    {
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
     * @param type $tableName
     * @param type $id
     * @return boolean
     * Nếu truy vấn lỗi thì trả về false và ngược lại
     */
    public function _delete($tableName, $condition) {
        //Todo
        // Build query delete
        // Thực thi query
        // Trả kết quả xóa thành công hay khong
        // do điều kiện = null sẽ xóa toàn bộ
        // bảng nên khi điều kiện = null ta trả về false
        if(!isset($condition) || empty($condition))
            return FALSE;
        $sql = "DELETE FROM $tableName WHERE $condition";
        if ($this->_connection->query($sql))
            return TRUE;
        else
            return FALSE;
    }

}