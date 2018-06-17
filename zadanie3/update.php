<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 16.06.18
 * Time: 19:27
 */

include('models/baseModel.php');
include('models/utils.php');
include('models/utils_for_composite_key.php');
include('models/attribute.php');
include('models/attributevalue.php');
include('models/product.php');
include('models/category.php');

$link = new mysqli("127.0.0.1", "user", "password", "Schema");
if ($link->connect_errno) {
    printf("Connection error: %s\n", $link->connect_error);
    exit();
}

echo "Connected!" . PHP_EOL;

echo"<br>";

$instProducts = new product($link);
$instAttributeValue = new attributevalue($link);
$instAttriburte = new attribute($link);
$instCategory = new category($link);

$instAttributeValue->PRODUCT_IDPRODUCT = 1;
$instAttributeValue->ATTRIBUTE_IDATTRIBUTE = 1;
$instAttributeValue->VALUE = 46;
$instAttributeValue->save();

$instProducts->IDPRODUCT = 2;
$instProducts->DESCRIPTION = 'Updated produkt2';
$instProducts->IDFCATEGORY = 1;
$instProducts->save();

$link->close();