<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 11/8/20
 * Time: 10:19 PM
 */
function getData($key = '')
{
    $array = ['name' => 'hieu'];
    if ($key == '')
        return $array;
    if (isset($key)) {
        if (isset($array[$key]))
            return $array[$key];
        return [];
    }
}

$id = "name";

$value = getData()[$id];

if (isset(getData()[$id]) && !empty(getData()[$id]))
    echo $value;
else
    echo "khong co key";