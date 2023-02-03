<?php

$errors = [];


if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "account-add")) {

    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}
if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "source-of-funds")) {
   
    $source = "sof_add";
  
} else {

   $source = null;
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
    $financeClass = new Finance();
    $errors = $financeClass->validate($_POST);

    if (empty($errors)) {


        $_POST['balance'] = 0;
        $_POST['updated_on'] = date("Y-m-d H:i:s");
        $_POST['updated_by'] = auth::get('username');
        $_POST['id'] = rand(10000, 99999);
        
        $financeClass->insert($_POST);

        $message = "A/c created Successfully";
        Auth::setMessage($message);

        if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "savings-account")) {

                redirect("savings-account");
            } else {

                redirect("source-of-funds");
            }
        
    }
}

if (Auth::access('admin')) {
    require views_path('finance/account-add');
} else {

    Auth::setMessage("Only Admins can create users");
    require views_path('auth/denied');
}	


