<?php

$errors = [];
$financeClass = new Finance();

$id = $_GET['id'] ?? null;
$row = $financeClass->first(['id' => $id]);

if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "account-edit")) {

    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "source-of-funds")) {

    $source = "sof_add";
} else {

    $source = null;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (Auth::access('admin')) {


        $errors = $financeClass->validate($_POST);

        if (empty($errors)) {

            $_POST['updated_on'] = date("Y-m-d H:i:s");
            $_POST['updated_by'] = auth::get('username');

            $financeClass->update($id, $_POST);

            $message = "Record for Account Id: $id updated successfully";
            Auth::setMessage($message);
            

            
            if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "savings-account")) {

                redirect("savings-account");
            } else {

                redirect("source-of-funds");
            }
            
        }
    }
}

if (Auth::access('admin')) {
    require views_path('finance/account-edit');
} else {

    Auth::setMessage("Only Supervisor can edit Members");
    require views_path('auth/denied');
}	


