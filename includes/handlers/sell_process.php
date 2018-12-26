<?php
require '../config/config.php';

if (isset($_POST['submit_sell'])) {
    $num_units = $_POST['num_units'];
    $product_id = $_POST['sold_product_id'];
    $product_name = $_POST['sold_product_name'];
    $old_quantity  = $_POST['product_old_quantity'];
    $old_sold  = $_POST['product_old_sold'];
    $old_money  = $_POST['product_old_money'];
    $price_01 = $_POST['product_price_1'];
    $price_02 = $_POST['product_price_2'];
    $process_date = date("Y-m-d H:i:s");
    $money_01 = ($num_units * $price_01);
    $money_02 = ($num_units * $price_02);
    $profit = ($money_02 - $money_01);
    $new_quantity = ($old_quantity - $num_units);
    $new_sold = ($old_sold + $num_units);
    $new_money = ($old_money + $money_02);

    $sell_sql = "INSERT INTO sell_process VALUES('','$product_id','$product_name','$price_01','$price_02','$num_units','$money_02','$profit','$process_date')";
    $update_products_sql = "UPDATE products SET quantity='" . $new_quantity . "', sold='"
           . $new_sold . "', money='" . $new_money . "', profit='" . $profit . "' WHERE id='" . $product_id . "'";

    $sell = mysqli_query($link, $sell_sql);

    if ($sell) {
        $update = mysqli_query($link, $update_products_sql);
        if($update) {
            header("Location: ../../index.php?msg=2");
        } else {
            header("Location: ../../index.php?msg=1");
        }
        
    } else {
        echo "ERROR01 IN SELL";
    }
    
} else {
    echo "Please complete all data fields<br>";
}