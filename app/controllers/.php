
<?php

		elseif ($action == 'edit') {

			$id = $_GET['id'] ?? null;
			$row = $finance->first(['id' => $id]);

			if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "account-edit")) {

		    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
				
				}
				if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "sof")) {
				   
				    $source = "sof_add";
				  
				} else {

				   $source = null;
				}

					if ($_SERVER['REQUEST_METHOD'] == "POST") {


					        if ($finance->validate($_POST)) {

					            $_POST['updated_on'] = date("Y-m-d H:i:s");
					            $_POST['updated_by'] = auth::get('username');

					            $finance->update($id, $_POST);

					            $message = "Record for Account Id: $id updated successfully";
					            Auth::setMessage($message);
					            

					            
					            if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "savings-account")) {

					                redirect("admin/finance/savings-account");
					            } else {

					                redirect("admin/finance");
					            }
					            
					        }
					}
		  
		}


		elseif ($action == 'stmnt') {

			$id = $_GET['id'] ?? null;


			$query= "SELECT SUM(credit) AS T_CREDIT,SUM(debit) AS T_DEBIT FROM finance_transaction WHERE acc_number=:acc_number";
			$result = $record->query($query,['acc_number'=>$id]);
			$total_credit = $result[0]['T_CREDIT'];
			$total_debit = $result[0]['T_DEBIT'];

			$stmnt = $record->where(['acc_number' =>$id]);
			$row = $finance->first(['id' => $id]);
		  
		}

		elseif ($action == 'transfer') {

			$errors = [];

			$id = $_GET['id'] ?? null;
			$row = $finance->first(['id' => $id]);

			$des = $finance->where(['type' => 'Savings']);

			if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "fund-transfer")) {

			    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
			}



			if ($_SERVER['REQUEST_METHOD'] == "POST") {

			    $_POST['balance'] = $row['balance'];
			    $_POST['newbalance'] = $row['balance'] - $_POST['amount'];

			    $errors = $record->validate1($_POST);

			    if (empty($errors)) {

			        $des = $finance->first(['id' => $_POST['destination']]);

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
			   
			       
			        $record->insert($arr);
			        $finance->update($arr['acc_number'], ['balance' => $arr['balance']]);
			        
			        $arr['type'] = "Transfer In";       
			        $arr['acc_number'] = $_POST['destination'];
			        $arr['acc_name'] = $des['acc_name'];
			        $arr['credit'] = $_POST['amount'];
			        $arr['debit'] = 0;
			        $arr['balance'] = $des['balance'] + $_POST['amount'];
			        $arr['source'] = $des['acc_name'].'('.$_POST['destination'].')';

			        $record->insert($arr);
			        $finance->update($arr['acc_number'], ['balance' => $arr['balance']]);

			        message("Transaction completed Successfully");

			        if (!empty($_SESSION['referer']) && strstr($_SESSION['referer'], "savings-account")) {

			            redirect("admin/finance/savings-account");
			        } else {

			            redirect("admin/finance");
			        }
			    }
			}
		  
		}

		elseif ($action == 'record') {

			$errors = [];
			$transcode = $_GET['transcode'] ?? null;


			$sof = $finance->where(['type'=>'Default']);
			$pending = $record->where(['transcode' => $transcode, 'status' => 'Pending']);


			if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "record-finance")) {

			    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
			}



			if ($_SERVER['REQUEST_METHOD'] == "POST") {



			    if ($_POST['from'] == "add-finance") {
			        unset($_POST['from']);

			        $errors = $record->validate($_POST);

			        if (empty($errors)) {

			            $row = $finance->first(['id' => $_POST['id']]);

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

			            $record->insert($_POST);

			            $finance->update($_POST['acc_number'], ['balance' => $_POST['balance']]);

			            redirect("record-finance&transcode=$transcode");
			        }
			    } else {

			        unset($_POST['from']);
			        $query = "UPDATE finance_transaction SET status=:status WHERE transcode=:transcode";
			        $finance->query($query, ['transcode' => $transcode, 'status' => 'Saved']);
			        
			        message("Financial Record Saved Successfully");
			        
			        redirect("admin/finance");
			    }
			}
		  
		}

		elseif ($action == 'savings') {

			$sof = $finance->where(['type' =>'Savings']);
			
		  
		}

		elseif ($action == 'sof') {

			$sof = $finance->where(['type' =>'Default']);	
		  
		}

		elseif ($action == 'expenses') {

			$exp = $expenses->getAll();	
		  
		}

		elseif ($action == 'record_expenses') {

			$errors = [];

			$des = $finance->where(['type' => 'Savings']);

			if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "expenses-record")) {

			    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
			}


			if ($_SERVER['REQUEST_METHOD'] == "POST") {

			    $row = $finance->first(['id' => $_POST['acc_number']]);
			    
			    $_POST['newbalance'] = $row['balance'] - $_POST['amount'];
			    
			    $errors = $expenses->validate($_POST);

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
			              
			        $record->insert($arr);
			        $finance->update($arr['acc_number'], ['balance' => $arr['balance']]);

			        $expenses->insert($_POST);
			     
			        message("Transaction completed Successfully");

			            redirect("admin/finance");
			       
			    }
			}			
		  
		}else

		{

			//categories view
			$data['rows'] = $finance->findAll();

		}