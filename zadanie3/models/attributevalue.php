<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 16.06.18
 * Time: 1:21
 */
class attributevalue extends baseModel
{
    use utils,utils_for_composite_key{
        utils_for_composite_key::getMaxId insteadof utils;
        utils_for_composite_key::exist insteadof utils;
        utils_for_composite_key::findById insteadof utils;
        utils_for_composite_key::save insteadof utils;
    }
    public $VALUE;
    public $PRODUCT_IDPRODUCT;
    public $ATTRIBUTE_IDATTRIBUTE;
    function __construct($db)
    {
        $this->setPrimaryKey(array('PRODUCT_IDPRODUCT','ATTRIBUTE_IDATTRIBUTE'));
        parent::__construct($db);
    }
}