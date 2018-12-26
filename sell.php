<?php

require './includes/config/config.php';
require './errors.php';
require './tr.php';

if(isset($_GET['msg'])) {
    if($_GET['msg'] > 5) {
        header("Location: notFound.php");
   } else {
    $msg = $errors_arr[$_GET['msg']];
   }
} else {
    $msg = "";
}

if (isset($_GET['sp'])) {
    $product_id = $_GET['sp'];


    $sel_query = "SELECT * FROM products WHERE id='$product_id' ORDER BY 'id' ASC LIMIT 1";
    $sel_result = mysqli_query($link, $sel_query);
    $sel_row = mysqli_num_rows($sel_result);
    if ($sel_row > 0) {
        foreach ($sel_result as $product) {
            $p_name = htmlspecialchars($product['name']);
            $p_id = htmlspecialchars($product['id']);
            $p_price_1 = htmlspecialchars($product['price_1']);
            $p_price_2 = htmlspecialchars($product['price_2']);
            $p_old_quantity = htmlspecialchars($product['quantity']);
            $p_old_sold = htmlspecialchars($product['sold']);
            $p_old_money = htmlspecialchars($product['money']);
        }
    }
} else {
    echo "Product not found<br>";
}


?>

<html>
<head>
	<title><?php echo $ar[19] . ' | ' . $ar[7] . ' ' .  ucfirst($p_name); ?> </title>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">        
        
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
        <!-- Font Awesome -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Material Design Bootstrap -->
        <link href="assets/css/mdb.css" rel="stylesheet" type="text/css"/>
        <!-- custom styles -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    
    <div id="sell_div">
        <div class="msg">
            <?php echo $msg; ?>
        </div>
           
        <form action="includes/handlers/sell_process.php" method="POST" class="form-horizontal panel panel-primary">

            <div class="panel-heading">
                <a href="index.php" class="fa fa-arrow-left btn btn-warning btn-sm back"></a>
                <h3 class="text-center"><?php echo $ar[7] . ' | ' . ucfirst($p_name); ?></h3>
            </div>

            <div class="panel-body form_items">
                <input type="number" id="sold_product_id" name="sold_product_id" value="<?php echo $p_id; ?>" hidden>
                <input type="text" id="sold_product_name" name="sold_product_name" value="<?php echo $p_name; ?>" hidden>
                <input type="number" id="product_price_1" name="product_price_1" value="<?php echo $p_price_1; ?>" hidden>
                <input type="number" id="product_price_2" name="product_price_2" value="<?php echo $p_price_2; ?>" hidden>
                <input type="number" id="product_old_quantity" name="product_old_quantity" value="<?php echo $p_old_quantity; ?>" hidden>
                <input type="number" id="product_old_sold" name="product_old_sold" value="<?php echo $p_old_sold; ?>" hidden>
                <input type="number" id="product_old_money" name="product_old_money" value="<?php echo $p_old_money; ?>" hidden>
                <br>
                <h4 class="text-center text-primary"><?php echo $ar[16] . ' = ' . $p_old_quantity; ?></h4>
                <br>
                <h4 class="text-center text-danger"><?php echo $ar[18] . ' = ' . $p_price_2; ?></h4>
                <br>
                <div class="form-group-sm">
                    <label for="num_units" class="form-label"><?php echo $ar[6] ?></label>
                    <input type="number" min="0" max="<?php echo $p_old_quantity; ?>" id="num_units" name="num_units" required>
                </div>
                <br>
            </div>

            <div class="panel-footer">
                <input type="submit" value="<?php echo $ar[7] ?>" id="submit_sell" name="submit_sell" class="btn btn-primary">
            </div>
        </form>
    </div>

    <?php
    include './includes/footer.php';
    ?>

    
