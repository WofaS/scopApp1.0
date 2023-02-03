<?php

$id = $_GET['id'] ?? null;
$recordClass = new RecordFinance();
$financeClass = new Finance();


$query= "SELECT SUM(credit) AS T_CREDIT,SUM(debit) AS T_DEBIT FROM finance_transaction WHERE acc_number=:acc_number";
$result = $recordClass->query($query,['acc_number'=>$id]);
$total_credit = $result[0]['T_CREDIT'];
$total_debit = $result[0]['T_DEBIT'];

$stmnt = $recordClass->where(['acc_number' =>$id]);
$row = $financeClass->first(['id' => $id]);



if (Auth::access('admin')) {
    require views_path('finance/account-statement');
} else {

    Auth::setMessage("You don't have access to the admin page");
    require views_path('auth/denied');
}


