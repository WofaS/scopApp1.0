<?php

$expensesClass = new Expenses();

$exp = $expensesClass->getAll();

if (Auth::access('admin')) {
    require views_path('expenses/expenses');
} else {

    Auth::setMessage("You don't have access to the admin page");
    require views_path('auth/denied');
}


