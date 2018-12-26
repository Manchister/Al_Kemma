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


?>



<html>
    <head>
        <title><?php echo $ar[19] ?></title>
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
        
        <div class="main">
            
            <div class="l-column" style="min-width: 350px;">
            
                <div class="msg" style="width:80%; align-self: center;">
                    <?php echo $msg; ?>
                    <!--<ol>-->
                    <?php
                    $alert_q = "SELECT name, quantity FROM products WHERE quantity < 1";
                    $alert_res = mysqli_query($link, $alert_q);
                    $alert_row = mysqli_fetch_row($alert_res);
                    $alert_arr = mysqli_fetch_array($alert_res);

                    if ($alert_row > 0) {

                        foreach ($alert_res as $key) {
                            $p_q_alert = $key['quantity'];
                            $p_n_alert = htmlspecialchars($key['name']);

                            if ($p_q_alert < 1) {
                            $alert = $fail_panel_1 . "<li>$p_n_alert</li>" . $fail_panel_2;
//                                echo "<li>$p_n_alert</li>";
                            } else {
                                $alert = "";
                            }
                        }
                    } else {
                        $alert = "";
                    }
                    echo $alert;
                    ?>
                    <!--</ol>-->
                </div>
            
                <div class="history" style="width: 80%;">
                    <a href="history.php" id="history" class="btn btn-lg btn-secondary"><b class="fa fa-lg fa-table" style="font-size:80px;"></b></a><br>
                </div>
                <br>
                
                <div id="add_div" style="width: 80%;margin-top: 60px;margin-bottom: 60px;">
                    <form action="includes/handlers/addProduct.php" method="POST" class="form-horizontal panel panel-success">

                        <div class="panel-heading">
                            <h2 class="text-center h2-responsive"><?php echo $ar[1] ?></h2>
                        </div>

                        <div class="panel-body">
                            <div class="form-group-sm">
                                <label for="product_name" class="form-label"><?php echo $ar[3] ?></label>
                                <input type="text" id="product_name" name="product_name" required> 
                            </div>
                            <br>

                            <div class="form-group-sm">
                                <label for="price_1" class="form-label"><?php echo $ar[4] ?></label>
                                <input type="number" step="0.1" min="0" id="price_1" name="price_1" class="home_num" required>
                            </div>
                            <br>

                            <div class="form-group-sm">
                                <label for="price_2" class="form-label"><?php echo $ar[5] ?></label>
                                <input type="number" step="0.1" min="0" id="price_2" name="price_2" class="home_num" required>
                            </div>
                            <br>

                            <div class="form-group-sm">
                                <label for="quantity" class="form-label"><?php echo $ar[6] ?></label>
                                <input type="number" id="quantity" min="0" name="quantity" class="home_num" required>
                            </div>
                            <br>
                        </div>

                        <div class="panel-footer">
                            <input type="submit" value="<?php echo $ar[8] ?>" id="submit_add" name="submit_add" class="btn btn-success">
                        </div>
                        

                    </form>
                </div>
                <hr>

            </div>
            
            
            <div class="r-column" style="min-width: 400px;">
                <div id="show_products_div" class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="text-center"><?php echo $ar[0] ?></h3>
                    </div>
                    
                    <div class="panel-body">
                        <ol id="show_products" style="list-style-type: none">
                            <?php
                            $sel_query = "SELECT * FROM products ORDER BY 'id' ASC";
                            $sel_result = mysqli_query($link, $sel_query);
                            $sel_row = mysqli_num_rows($sel_result);

//                            if ($sel_row > 0) {
//                                foreach ($sel_result as $product) {
//                                    $p_name = htmlspecialchars($product['name']);
//                                    $p_id = $product['id'];
//                                    $p_q = $product['quantity'];
//                                    $p_price = floatval($product['price_2']);
//                                    echo "<li id='id_$p_id' class='p_list'>
//                                            <span class='badge span_id' id='p_id'>$p_id</span>
//                                            <div class='p_item text-center'>
//                                                <span class='badge q_badge'>$p_q</span>
//                                                <span class='badge p_badge'>$p_price ج</span>
//                                                <h3 class='h3-responsive'>" . ucfirst($p_name) . "</h3>
//                                                <div class='btn-group'>
//                                                <a class='btn btn-success' href='sell.php?sp=$p_id'>$ar[7]</a>
//                                                <a class='btn btn-warning' href='add_q.php?qp=$p_id'>$ar[8]</a>
//                                                <a class='btn btn-danger' href='update.php?up=$p_id'>$ar[13]</a>
//                                                <a class='btn btn-info' href='history.php?hp=$p_id'>$ar[2]</a>
//                                            </div></div></li><br>";
//                                }
//                            } else {
//                                echo 'Add products above!';
//                            }
                            
                            
                            
                            if ($sel_row > 0) {
                                foreach ($sel_result as $product) {
                                    $p_name = htmlspecialchars($product['name']);
                                    $p_id = $product['id'];
                                    $p_q = $product['quantity'];
                                    $p_price = floatval($product['price_2']);
                                    echo "<li id='id_$p_id' class='p_list'>"
//                                    . "<span class='badge span_id' id='p_id'>$p_id</span>"
                                    . "<a class='p_name btn btn-mdb' href='update.php?up=$p_id'>"
                                    . "<span class='badge q_badge'>$p_q</span><span class='badge p_badge'>$p_price ج</span><br>"
                                    . ucfirst($p_name) . "</a>"
                                    . "<a class='p_btns btn btn-success' href='sell.php?sp=$p_id'><i class='fa fa-lg fa-minus'></i></a>"
                                    . "<a class='p_btns btn btn-warning' href='add_q.php?qp=$p_id'><i class='fa fa-lg fa-plus'></i></a>"
                                    . "<a class='p_btns btn btn-secondary' href='history.php?hp=$p_id'><i class='fa fa-lg fa-table'></i></a></li><br>";
                                    
                                }
                                
//                                foreach ($sel_result as $key) {
//                                    $p_q_alert = $key['quantity'];
//                                    $p_n_alert = htmlspecialchars($key['name']);
//                                    
//                                    if($p_q_alert < 1) {
////                                         $alert = "<li>$p_n_alert</li>";
//                                         echo "<li>$p_n_alert</li>";
//                                    } else {
//                                        $alert = "";
//                                    }
//                                }
                                
                                
                                
                            } else {
                                echo 'Add products above!';
                            }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>
            
            
        </div>
        

        <?php
        include './includes/footer.php';
        ?>

        
