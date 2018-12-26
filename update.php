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

if(isset($_GET['up'])) {
    $p_id = $_GET['up'];
    $query = "SELECT * FROM products WHERE id='$p_id'";
    $result = mysqli_query($link, $query);
    $rows = mysqli_num_rows($result);
    $products_array = mysqli_fetch_array($result);
    
    if($rows > 0) {
        $p_name = $products_array['name'];
        $p_price_1 = $products_array['price_1'];
        $p_price_2 = $products_array['price_2'];
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
	<title><?php echo $ar[19] . ' | ' . ucfirst($p_name); ?></title>
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
    <div id="edit_div">
         
        <form action="includes/handlers/updateProduct.php" method="POST" class="form-horizontal panel panel-primary">
            
            <div class="panel-heading">
                <a href="index.php" class="fa fa-arrow-left btn btn-warning btn-sm back"></a>
                <h3 class="text-center"><?php echo ucfirst($p_name); ?></h3>
            </div>
            
            <div class="panel-body form_items">
                <div class="msg">
                    <?php echo $msg; ?>
                </div>
           
                <input type="hidden" value="<?php echo $p_id ?>" name="product_id">

                <div class="form-group-sm">
                    <label for="product_name" class="form-label"><?php echo $ar[3]; ?></label>
                    <input type="text" id="product_name" name="product_name" required
                           value="<?php echo $p_name ?>">
                </div>
                <br>

                <div class="form-group-sm">
                    <label for="price_1" class="form-label"><?php echo $ar[4]; ?></label>
                    <input type="number" step="0.1" min="0" id="price_1" name="price_1" required
                           value="<?php echo $p_price_1 ?>">
                </div>

                <div class="form-group-sm">
                    <label for="price_2" class="form-label"><?php echo $ar[5]; ?></label>
                    <input type="number" step="0.1" min="0" id="price_2" name="price_2" required
                           value="<?php echo $p_price_2 ?>">
                </div>

                <div class="form-group-sm">
                    <label for="quantity" class="form-label"><?php echo $ar[6]; ?></label>
                    <input type="number" id="quantity" min="0" name="quantity" required
                           value="<?php echo $p_quantity ?>">
                </div>

                <div class="form-group-sm">
                    <label for="sold_units" class="form-label"><?php echo $ar[14]; ?></label>
                    <input type="number" id="sold_units" min="0" name="sold_units"
                           value="<?php echo $p_sold_units ?>" readonly>
                </div>

            </div>
            
            <div class="panel-footer navbar-fixed-bottom">
                <input type="submit" value="<?php echo $ar[13]; ?>" id="submit_edit" name="submit_edit" class="btn btn-primary">
            </div>
            
        </form>
    </div>
            

    <?php
    include './includes/footer.php';
    ?>
