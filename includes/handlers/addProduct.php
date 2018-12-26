<?php

//require '../classes/AccessPDO.php';
require '../config/config.php';

if (isset($_POST['submit_add'])) {
    $product = $_POST['product_name'];
    $product_name = lcfirst($product);
    $price_01 = $_POST['price_1'];
    $price_02 = $_POST['price_2'];
    $quantity = $_POST['quantity'];
    $date_added = date("Y-m-d H:i:s");

    $sql = "INSERT INTO products VALUES('','$product_name','$quantity','$price_01','$price_02','0','0','0','$date_added')";
    

    $add = mysqli_query($link, $sql);

    if ($add) {
        header("Location: ../../index.php?msg=3");
    } else {
        header("Location: ../../index.php?msg=1");
    }
} else {
    $msg = "";
//    echo "Please complete all data fields<br>";
}
        echo $msg;
?>

