<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 16.06.18
 * Time: 0:29
 */

class product extends baseModel
{
    use utils;
    public $IDPRODUCT;
    public $DESCRIPTION;
    public $IDFCATEGORY;
    function __construct($db)
    {
        $this->setPrimaryKey('IDPRODUCT');
        parent::__construct($db);
    }
}