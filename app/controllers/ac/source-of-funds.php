<?php

$financeClass = new Finance();
$sof = $financeClass->where(['type' =>'Default']);

if (Auth::access('admin')) {
    require views_path('finance/source-of-funds');
} else {

    Auth::setMessage("You don't have access to the admin page");
    require views_path('auth/denied');
}


