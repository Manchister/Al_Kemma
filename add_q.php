<?php

require './includes/config/config.php';
require './errors.php';
require './tr.php';

if(isset($_GET['msg'])) {
    $msg = $errors_arr[$_GET['msg']];
} else {
    $msg = "";
}

if(isset($_GET['qp'])) {
    $p_id = $_GET['qp'];
    $query = "SELECT * FROM products WHERE id='$p_id'";
    $result = mysqli_query($link, $query);
    $rows = mysqli_num_rows($result);
    $products_array = mysqli_fetch_array($result);
    
    if($rows > 0) {
        $p_name = htmlspecialchars($products_array['name']);
        $p_price_1 = floatval($products_array['price_1']);
        $p_price_2 = floatval($products_array['price_2']);
        $p_quantity = $products_array['quantity'];
        $p_sold_units = $products_array['sold'];
        
    } else {
        echo 'Product not found';
    }
} else {
    echo 'error';
}


?>



<html>
<head>
	<title>Al-Kemma | <?php echo ucfirst($p_name); ?></title>
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
    
    <div id="add_quantity_div">
        <form action="includes/handlers/updateProduct.php" method="POST" class="form-horizontal panel panel-danger">

            <div class="panel-heading">
                <a href="index.php" class="fa fa-arrow-left btn btn-warning btn-sm back"></a>
                <h3 class="text-center"><?php echo $ar[15] . ' | ' . ucfirst($p_name); ?></h3>
            </div>

            <div class="panel-body form_items">
                <div class="msg">
                    <?php echo $msg; ?>
                </div>
                <input type="hidden" value="<?php echo $p_id ?>" name="product_id">
                <input type="number" id="old_quantity" name="old_quantity" hidden
                       value="<?php echo $p_quantity ?>">
                <h4 class="text-center text-primary"><?php echo $ar[16] . ' = ' . $p_quantity; ?></h4>
                <br>
                <div class="form-group-sm">
                    <label for="add_quantity" class="form-label"><?php echo $ar[6]; ?></label>
                    <input type="number" min="0" id="add_quantity" name="add_quantity" required>
                </div>
            </div>

            <div class="panel-footer navbar-fixed-bottom">
                <input class="btn btn-danger waves-input-wrapper waves-effect waves-light waves-button" type="submit" value="<?php echo $ar[17]; ?>" id="submit_add_q" name="submit_add_q">
            </div>
        </form>
    </div>


    <?php
    include './includes/footer.php';
    ?>

    
