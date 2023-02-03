<?php

$errors = [];
$financeClass = new Finance();

$des = $financeClass->where(['type' => 'Savings']);

if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "expenses-record")) {

    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $recordClass = new RecordFinance();
    $expensesClass = new Expenses();
    $row = $financeClass->first(['id' => $_POST['acc_number']]);
    
    $_POST['newbalance'] = $row['balance'] - $_POST['amount'];
    
    $errors = $expensesClass->validate($_POST);

    if (empty($errors)) {
      

        $transcode = date('Ymd') . rand(1000, 9999);

        $arr = [];
        $arr['date'] = $_POST['date'];
        $arr['type'] = "Expenses";
        $arr['transcode'] = $transcode;
        $arr['acc_number'] = $row['id'];
        $arr['acc_name'] = $row['acc_name'];
        $arr['credit'] = 0;
        $arr['debit'] = $_POST['amount'];
        $arr['balance'] = $_POST['newbalance'];
        $arr['comment'] = $_POST['purpose'].' by '.$_POST['receiver'];
        $arr['created_on'] = date("Y-m-d H:i:s");
        $arr['created_by'] = auth::get('username');
        $arr['status'] = "saved";

        $_POST['transcode'] = $transcode;
        $_POST['created_on'] = date("Y-m-d H:i:s");
        $_POST['created_by'] = auth::get('username');
        unset($_POST['newbalance']);
              
        $recordClass->insert($arr);
        $financeClass->update($arr['acc_number'], ['balance' => $arr['balance']]);

        $expensesClass->insert($_POST);
     
        $message = "Transaction completed Successfully";
        Auth::setMessage($message);


            redirect("expenses-record");
       
    }
}

if (Auth::access('admin')) {
    require views_path('expenses/expenses-record');
} else {

    Auth::setMessage("Only Admins can create users");
    require views_path('auth/denied');
}	


