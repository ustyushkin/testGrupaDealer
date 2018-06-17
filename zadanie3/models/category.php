<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 16.06.18
 * Time: 1:20
 */
class category extends baseModel
{
    use utils;
    public $IDCATEGORY;
    public $DESCRIPTION;
    function __construct($db)
    {
        $this->setPrimaryKey('IDCATEGORY');
        parent::__construct($db);
    }
}