<?php

$errors = [];
$transcode = $_GET['transcode'] ?? null;

$financeClass = new Finance();
$recordClass = new RecordFinance();


$sof = $financeClass->where(['type'=>'Default']);
$pending = $recordClass->where(['transcode' => $transcode, 'status' => 'Pending']);


if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "record-finance")) {

    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {



    if ($_POST['from'] == "add-finance") {
        unset($_POST['from']);

        $errors = $recordClass->validate($_POST);

        if (empty($errors)) {

            $row = $financeClass->first(['id' => $_POST['id']]);

            $_POST['debit'] = 0;
            $_POST['type'] = "Transfer In";
            $_POST['created_on'] = date("Y-m-d H:i:s");
            $_POST['created_by'] = auth::get('username');
            $_POST['transcode'] = $transcode;
            $_POST['acc_number'] = $_POST['id'];
            $_POST['acc_name'] = $row['acc_name'];
            $_POST['credit'] = $_POST['amount'];
            $_POST['balance'] = $row['balance'] + $_POST['amount'];
            $_POST['status'] = "Pending";
            unset($_POST['amount']);
            unset($_POST['id']);

            $recordClass->insert($_POST);

            $financeClass->update($_POST['acc_number'], ['balance' => $_POST['balance']]);

            redirect("record-finance&transcode=$transcode");
        }
    } else {

        unset($_POST['from']);
        $query = "UPDATE finance_transaction SET status=:status WHERE transcode=:transcode";
        $financeClass->query($query, ['transcode' => $transcode, 'status' => 'Saved']);
        
        $message = "Financial Record Saved Successfully";
        Auth::setMessage($message);
        
        redirect("source-of-funds");
    }
}

if (Auth::access('admin')) {
    require views_path('finance/record-finance');
} else {

    Auth::setMessage("Only Admins can create users");
    require views_path('auth/denied');
}	


