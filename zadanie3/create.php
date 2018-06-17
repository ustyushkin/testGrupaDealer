<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 16.06.18
 * Time: 1:32
 */

include('models/baseModel.php');
include('models/utils.php');
include('models/utils_for_composite_key.php');
include('models/attribute.php');
include('models/product.php');
include('models/category.php');
include('models/attributevalue.php');

$link = new mysqli("127.0.0.1", "user", "password", "Schema");
if ($link->connect_errno) {
    printf("Connection error: %s\n", $link->connect_error);
    exit();
}
echo "Connected!" . PHP_EOL;

//work with model
$instCotegory = new category($link);

$instCotegory->DESCRIPTION = 'artykuly gospodarstwa domowego';
$currentCotegoryId = $instCotegory->save();

$instAttriburte = new attribute($link);
$instAttriburte->DESCRIPTION = 'waga';
$attrId1 = $instAttriburte->save();

$instAttriburte->DESCRIPTION = 'kolor';
$attrId2 = $instAttriburte->save();

$instProducts = new product($link);
$instProducts->DESCRIPTION = 'product1';
$instProducts->IDFCATEGORY = $currentCotegoryId;
$prodId1 = $instProducts->save();

$instProducts->DESCRIPTION = 'product2';
$instProducts->IDFCATEGORY = $currentCotegoryId;
$prodId2 = $instProducts->save();

$instProducts->DESCRIPTION = 'product3';
$instProducts->IDFCATEGORY = $currentCotegoryId;
$prodId3 = $instProducts->save();

$instAttributeValue = new attributevalue($link);
$instAttributeValue->VALUE =45;
$instAttributeValue->PRODUCT_IDPRODUCT = $prodId1;
$instAttributeValue->ATTRIBUTE_IDATTRIBUTE = $attrId1;
$instAttributeValue->save();

$instAttributeValue->VALUE ='black';
$instAttributeValue->PRODUCT_IDPRODUCT = $prodId1;
$instAttributeValue->ATTRIBUTE_IDATTRIBUTE = $attrId2;
$instAttributeValue->save();

$instAttributeValue->VALUE =35;
$instAttributeValue->PRODUCT_IDPRODUCT = $prodId2;
$instAttributeValue->ATTRIBUTE_IDATTRIBUTE = $attrId1;
$instAttributeValue->save();

$instAttributeValue->VALUE ='green';
$instAttributeValue->PRODUCT_IDPRODUCT = $prodId3;
$instAttributeValue->ATTRIBUTE_IDATTRIBUTE = $attrId2;
$instAttributeValue->save();

$link->close();
/*
 * result
 *
Connected!

invisible log
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO CATEGORY (DESCRIPTION) VALUES ('artykuly gospodarstwa domowego')' (length=76)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO ATTRIBUTE (DESCRIPTION) VALUES ('waga')' (length=51)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO ATTRIBUTE (DESCRIPTION) VALUES ('kolor')' (length=52)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO PRODUCT (DESCRIPTION,IDFCATEGORY) VALUES ('product1','1')' (length=69)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO PRODUCT (DESCRIPTION,IDFCATEGORY) VALUES ('product2','1')' (length=69)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO PRODUCT (DESCRIPTION,IDFCATEGORY) VALUES ('product3','1')' (length=69)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO ATTRIBUTEVALUE (VALUE,PRODUCT_IDPRODUCT,ATTRIBUTE_IDATTRIBUTE) VALUES ('45','1','1')' (length=96)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO ATTRIBUTEVALUE (VALUE,PRODUCT_IDPRODUCT,ATTRIBUTE_IDATTRIBUTE) VALUES ('black','1','2')' (length=99)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO ATTRIBUTEVALUE (VALUE,PRODUCT_IDPRODUCT,ATTRIBUTE_IDATTRIBUTE) VALUES ('35','2','1')' (length=96)
/var/www/testGrupaDealer/zadanie3/models/utils.php:130:string 'INSERT INTO ATTRIBUTEVALUE (VALUE,PRODUCT_IDPRODUCT,ATTRIBUTE_IDATTRIBUTE) VALUES ('green','3','2')' (length=99)
*/