<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 15.06.18
 * Time: 18:11
 */

class baseModel
{
    private $db;
    private $primaryKey;
    function __construct($db)
    {
        $this->db=$db;
    }
    public function getDb()
    {
        return $this->db;
    }
    public function setPrimaryKey($value)
    {
        $this->primaryKey = $value;
    }
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
}