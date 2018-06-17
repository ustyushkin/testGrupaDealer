<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 15.06.18
 * Time: 18:18
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

$result = $instProducts->selectAll();
if ($result !== false) {
    while ($row = $result->fetch_assoc()) {
        echo $row['DESCRIPTION'] . PHP_EOL;

        $instCategory->findById($row['IDFCATEGORY']);
        echo "(".$instCategory->DESCRIPTION.") ";

        $resultAttr = $instAttributeValue->find('PRODUCT_IDPRODUCT',$row['IDPRODUCT']);
        if ($resultAttr !== false) {
            while ($rowAttr = $resultAttr->fetch_assoc()) {
                echo $rowAttr['VALUE'] . PHP_EOL;
                $instAttriburte->findById($rowAttr['ATTRIBUTE_IDATTRIBUTE']);
                echo '('.$instAttriburte->DESCRIPTION.')'. PHP_EOL;
            }
        }
        echo"<br>";
    }
}


/* result
 *
Connected!
product1 (artykuly gospodarstwa domowego) 45 (waga) black (kolor)
product2 (artykuly gospodarstwa domowego) 35 (waga)
product3 (artykuly gospodarstwa domowego) green (kolor)
*/

$link->close();