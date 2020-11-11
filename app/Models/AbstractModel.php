<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 6:23 PM
 */

namespace BaoQuan\Models;


abstract class AbstractModel
{
    protected $_objectResource;
    protected $_resourceName;
    protected $_data;
    protected $_isDeleted = false;
    protected $_idFieldName;

    public function __construct()
    {
        $this->_construct();
    }

    protected function _construct()
    {

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

    public function save()
    {
        $this->_getResource()->save($this);
        return $this;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getData($key = '')
    {
        if ($key == '')
            return $this->_data;
        if (isset($key)) {
            if (isset($this->_data[$key]))
                return $this->_data[$key];
            return [];
        }
    }

    public function setData($key, $value = null)
    {
        if (is_array($key))
            $this->_data = $key;
        else
            $this->_data[$key] = $value;
        return $this;
    }

    public function delete()
    {
        $this->_getResource()->delete($this);
        return $this;
    }

    /**
     * @return \BaoQuan\Models\ResourcesModel\AbstractResourceModel
     * @throws \Exception
     */
    public function _getResource()
    {
        if (empty($this->_objectResource) && empty($this->_resourceName)) {
            throw new \Exception(
                new \Exception('the resource isn\'t set')
            );
        }
        return $this->_objectResource ?: \BaoQuan\Helper\ObjectManager::getInstance()->get($this->_resourceName);
    }

    protected function _init($resourceModel)
    {
        $this->_setResourceModel($resourceModel);
        $this->_idFieldName = $this->_getResource()->_getIdFieldName();
    }

    protected function _setResourceModel($resourceName)
    {
        $this->_resourceName = $resourceName;
    }

    public function isDelete($isDelete = null)
    {
        $result = $this->_isDeleted;
        if ($isDelete !== null)
            $this->_isDeleted = $isDelete;
        return $result;
    }

    /**
     *
     * @return array
     * Trả về mảng
     * [
     *      'primaryKey1'=>value1,
     *      'primaryKey2'=>value2,
     * ]
     */
    public function getArrayKey()
    {
        $outArray = array();
        if (!is_array($this->_idFieldName)) {
            $key = $this->_idFieldName;
            return array($this->_idFieldName => $this->_data[$key]);
        }
        foreach ($this->_idFieldNameas as $index => $key) {
            if (isset($this->_data[$key]) && !empty($this->_data[$key]))
                $outArray[$key] = $this->_data[$key];
            else
                $outArray[$key] = null;
        }
        return $outArray;
    }


}