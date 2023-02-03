<?php

$financeClass = new Finance();

$sof = $financeClass->where(['type' =>'Savings']);

if (Auth::access('admin')) {
    require views_path('finance/savings-account');
} else {

    Auth::setMessage("You don't have access to the admin page");
    require views_path('auth/denied');
}


