<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 15.06.18
 * Time: 18:14
 */

class attribute extends baseModel
{
    use utils;
    public $IDATTRIBUTE;
    public $DESCRIPTION;
    function __construct($db)
    {
        $this->setPrimaryKey('IDATTRIBUTE');
        parent::__construct($db);
    }
}
