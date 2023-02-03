<?php

$errors = [];
$financeClass = new Finance();

$id = $_GET['id'] ?? null;
$row = $financeClass->first(['id' => $id]);

$des = $financeClass->where(['type' => 'Savings']);

if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "fund-transfer")) {

    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $recordClass = new RecordFinance();
    $_POST['balance'] = $row['balance'];
    $_POST['newbalance'] = $row['balance'] - $_POST['amount'];

    $errors = $recordClass->validate1($_POST);

    if (empty($errors)) {

        $des = $financeClass->first(['id' => $_POST['destination']]);

        $_POST['debit'] = 0;
        $_POST['type'] = "Transfer In";
        $_POST['created_on'] = date("Y-m-d H:i:s");
        $_POST['created_by'] = auth::get('username');
        $_POST['balance'] = $row['balance'] + $_POST['amount'];
        $_POST['status'] = "Pending";

        $_POST['pre_balance'] = $row['balance'];

        $transcode= date('Ymd') . rand(1000, 9999);
        
        $arr = [];
        $arr['date'] = $_POST['date'];
        $arr['type'] = "Transfer Out";
        $arr['transcode'] = $transcode;
        $arr['acc_number'] = $row['id'];
        $arr['acc_name'] = $row['acc_name'];
        $arr['credit'] = 0;
        $arr['debit'] = $_POST['amount'];
        $arr['balance'] = $_POST['newbalance'];
        $arr['comment'] = $_POST['comment'];
        $arr['created_on'] = date("Y-m-d H:i:s");
        $arr['created_by'] = auth::get('username');
        $arr['status'] = "saved";
   
       
        $recordClass->insert($arr);
        $financeClass->update($arr['acc_number'], ['balance' => $arr['balance']]);
        
        $arr['type'] = "Transfer In";       
        $arr['acc_number'] = $_POST['destination'];
        $arr['acc_name'] = $des['acc_name'];
        $arr['credit'] = $_POST['amount'];
        $arr['debit'] = 0;
        $arr['balance'] = $des['balance'] + $_POST['amount'];
        $arr['source'] = $des['acc_name'].'('.$_POST['destination'].')';

        $recordClass->insert($arr);
        $financeClass->update($arr['acc_number'], ['balance' => $arr['balance']]);

        $message = "Transaction completed Successfully";
        Auth::setMessage($message);

        if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "savings-account")) {

            redirect("savings-account");
        } else {

            redirect("source-of-funds");
        }
    }
}

if (Auth::access('admin')) {
    require views_path('finance/fund-transfer');
} else {

    Auth::setMessage("Only Admins can create users");
    require views_path('auth/denied');
}	


