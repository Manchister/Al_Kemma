<?php
require '../config/config.php';

if(isset($_POST['submit_edit'])) {
   $p_id = $_POST['product_id'];
   $new_name = $_POST['product_name'];
   $new_price_1 = $_POST['price_1'];
   $new_price_2 = $_POST['price_2'];
   $new_quantity = $_POST['quantity'];
   $new_sold = $_POST['sold_units'];
   
   $query = "UPDATE products SET name='" . $new_name . "', price_1='" . $new_price_1
           . "', price_2='" . $new_price_2 . "', quantity='" . $new_quantity . "', sold='"
           . $new_sold . "' WHERE id='" . $p_id . "'";
   $update_query = mysqli_query($link, $query);
   
   if($update_query) {
        header("Location: ../../update.php?up=$p_id&msg=4");
   } else {
        header("Location: ../../update.php?up=$p_id&msg=1");
   }
}


if (isset($_POST['submit_add_q'])) {
    $p_id = $_POST['product_id'];
    $add_quantity = $_POST['add_quantity'];
    $old_quantity = $_POST['old_quantity'];
    $new_quantity = ($old_quantity + $add_quantity);
    
    $query = "UPDATE products SET quantity='" . $new_quantity . "' WHERE id='" . $p_id . "'";
   $add_q_query = mysqli_query($link, $query);
   
   if($add_q_query) {
        header("Location: ../../add_q.php?qp=$p_id&msg=5");
   } else {
       header("Location: ../../add_q.php?qp=$p_id&msg=1");
   }
}