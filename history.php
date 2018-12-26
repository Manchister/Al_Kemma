<?php

require './includes/config/config.php';
require './errors.php';
require './tr.php';
?>


<html>
<head>
	<title><?php echo $ar[19] . ' | ' . $ar[2] ?></title>
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



    <div id="history_div" class="panel panel-primary" style="height: auto;">
        
        <div class="panel-heading">
            <a href="index.php" class="fa fa-arrow-left btn btn-warning btn-sm back"></a>
                <h3 class="text-center"><?php echo $ar[2] ?></h3>
        </div>

        <div class="panel-body history_table ">
            <table id="history_table" style="margin-bottom: 100px;">
                <?php
                $header_tr = "<tr>
                <th class='col-num'><h5><a href='history.php?by=id'>##</a></h5></th>
                <th class='col-txt-name'><h5><a  href='history.php?by=nm'>" . $ar[3] . "</a></h5></th>
                <th class='col-txt'><h5><a href='history.php?by=pr'>" . $ar[9] . "</a></h5></th>
                <th class='col-txt'><h5><a href='history.php?by=sq'>" . $ar[6] . "</a></h5></th>
                <th class='col-txt'><h5><a href='history.php?by=mo'>" . $ar[10] . "</a></h5></th>
                <th class='col-txt'><h5><a href='history.php?by=pf'>" . $ar[11] . "</a></h5></th>
                <th class='col-date'><h5><a href='history.php?by=dt'>" . $ar[12] . "</a></h5></th>
                </tr>";

                if (isset($_GET['hp'])) {
                    $single_p_id = $_GET['hp'];
                    $single_p_h = " WHERE product_id='$single_p_id'";
                } else {
                    $single_p_h = "";
                }



                $pagerows = 10;

                if (isset($_GET['p']) && is_numeric($_GET['p'])) {
                    $pages = $_GET['p'];
                } else {
                    $q = "SELECT COUNT(id) FROM sell_process" . $single_p_h;
                    $res = mysqli_query($link, $q);
                    $row = mysqli_fetch_array($res);
                    $records = $row[0];

                    if ($records > $pagerows) {
                        $pages = ceil($records / $pagerows);
                    } else {
                        $pages = 1;
                    }
                }

                if (isset($_GET['s']) && is_numeric($_GET['s'])) {
                    $start = $_GET['s'];
                } else {
                    $start = 0;
                }



                if (isset($_GET['by'])) {
                    $order = $_GET['by'];
                } else {
                    $order = "id";
                }

                if ($order == 'id') {
                    $by = "id";
                } elseif ($order == 'nm') {
                    $by = "product_name";
                } elseif ($order == 'pr') {
                    $by = "product_price_2";
                } elseif ($order == 'sq') {
                    $by = "sold_quantity";
                } elseif ($order == 'mo') {
                    $by = "process_money";
                } elseif ($order == 'pf') {
                    $by = "process_profit";
                } elseif ($order == 'dt') {
                    $by = "date";
                }



                $query = "SELECT * FROM sell_process" . $single_p_h . " ORDER BY " . $by . " DESC LIMIT $start, $pagerows";
                $result = mysqli_query($link, $query);
                $rows = mysqli_num_rows($result);

                if ($rows > 0) {
                    echo $header_tr;

                    foreach ($result as $process) {
                        $ps_id = $process['id'];
                        $ps_p_name = htmlspecialchars($process['product_name']);
                        $ps_price_end = floatval($process['product_price_2']);
                        $ps_sold_q = $process['sold_quantity'];
                        $ps_money = floatval($process['process_money']);
                        $ps_profit = floatval($process['process_profit']);
                        $ps_date = htmlspecialchars($process['date']);

                        echo "<tr>
                            <td class='col-num'><h5>$ps_id</h5></td>
                            <td class='col-txt-name'><h5>$ps_p_name</h5></td>
                            <td class='col-txt'><h5>$ps_price_end</h5></td>
                            <td class='col-txt'><h5>$ps_sold_q</h5></td>
                            <td class='col-txt'><h5>$ps_money</h5></td>
                            <td class='col-txt'><h5>$ps_profit</h5></td>
                            <td class='col-date'><h5>$ps_date</h5></td>
                        </tr>";
                    }
                } else {
                    echo $errors_arr[6];
                }
                ?>
            </table>
        </div>
        
        <div class="panel-footer navbar-fixed-bottom">
            <?php
                if($pages > 1) {
                    $cur_page = ($start / $pagerows) + 1;
                    echo "<div class='pagination'>";
                    
                    if($cur_page != 1) {
                        echo "<a class='btn btn-sm btn-indigo fa fa-arrow-left' href='history.php?s="
                            . ($start - $pagerows) . "&by=" . $order . "'></a>";
                    }
                    if($cur_page != $pages) {
                        echo "<a class='btn btn-sm btn-indigo fa fa-arrow-right' href='history.php?s="
                            . ($start + $pagerows) . "&by=" . $order . "'></a>";
                    }
                    
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    
    
    <?php
    include './includes/footer.php';
    ?>