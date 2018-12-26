<?php

$success_panel_1 = '<div class="panel panel-success"><h4 class="text-center text-success panel-heading">'
        . '<i class="fa fa-check-square"></i> ';
$success_panel_2 = '<br><br></h5></div>';
$fail_panel_1 = '<div class="panel panel-danger"><h4 class="text-center text-danger panel-heading">'
        . '<i class="fa fa-info-circle"></i> ';
$fail_panel_2 = '<br><br></h5></div>';

$ar_err = ['هناك خطأ, من فضلك حاول ثانية',
    'تم البيع',
    'تمت إضافة المنتج',
    'تم تحديث البيانات',
    'تمت إضافة الكمية',
	'لا يوجد سجلات حاليا - حيث انه لم تتم عمليات بيع',
	'لا يوجد منتجات حاليا - يجب إضافة منتجات أولا'];

$errors_arr = [];

$errors_arr[0] = "";
$errors_arr[1] = "$fail_panel_1 $ar_err[0] $fail_panel_2";
$errors_arr[2] = "$success_panel_1 $ar_err[1] $success_panel_2";
$errors_arr[3] = "$success_panel_1 $ar_err[2] $success_panel_2";
$errors_arr[4] = "$success_panel_1 $ar_err[3] $success_panel_2";
$errors_arr[5] = "$success_panel_1 $ar_err[4] $success_panel_2";
$errors_arr[6] = "$fail_panel_1 $ar_err[5] $fail_panel_2";
$errors_arr[7] = "$fail_panel_1 $ar_err[6] $fail_panel_2";