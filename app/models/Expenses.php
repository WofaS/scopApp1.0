<?php

namespace Model;
/**
 * users class
 */
class Expenses extends Model {

    protected $table = "expenses";
    public $errors = [];
    protected $allowed_columns = [
        'date',
        'transcode',
        'acc_number',
        'amount',
        'purpose',
        'receiver',
        'created_on',
        'created_by',
    ];

    public function validate($data, $id = null) {
        $this->errors = [];

        //check a/c name
        if (empty($data['date'])) {
            $this->errors['date'] = "Date is required";
        }

        //check location
        if (empty($data['acc_number'])) {
            $this->errors['acc_number'] = "Account number is required";
        }

        //check location
        if (empty($data['purpose'])) {
            $this->errors['purpose'] = "Comment is required";
        }
        //check location
        if (empty($data['receiver'])) {
            $errors['receiver'] = "Receiver is required";
        } else if (!preg_match('/^[a-zA-Z ]+$/', $data['receiver'])) {
            $this->errors['receiver'] = "Only letters are allowed";
        }

        //check amount
        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount is required";
        } elseif (!preg_match('~\d+(?:\.\d+)?~', $data['amount'])) {
            $this->errors['amount'] = "Only numbers are allowed";
        } elseif ($data['newbalance'] < 0) {
            $this->errors['amount'] = "You have Insufficient Funds for this Transaction";
        }
        
        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }

}
