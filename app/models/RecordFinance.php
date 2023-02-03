<?php

namespace Model;  

/**
 * users class
 */
class RecordFinance extends Model {

    public $errors = [];
    protected $table = "finance_transaction";
    protected $allowed_columns = [
        'date',
        'type',
        'transcode',
        'acc_number',
        'acc_name',
        'credit',
        'debit',
        'balance',
        'comment',
        'source',
        'created_on',
        'created_by',
        'status',
    ];

    public function validate($data, $id = null) {
        $this->errors = [];

        //check date
        if (empty($data['date'])) {
            $this->errors['date'] = "Date is required";
        }

        //check type
        if (empty($data['id'])) {
            $this->errors['id'] = "type is required";
        }

        //check amount
        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount is required";
        } else

        if (!preg_match('~\d+(?:\.\d+)?~', $data['amount'])) {
            $this->errors['amount'] = "Only numbers are allowed";
        }


        return $this->errors;
    }

    public function validate1($data, $id = null) {
        $this->errors = [];

        //check date
        if (empty($data['date'])) {
            $this->errors['date'] = "Date is required";
        }

        if (empty($data['destination'])) {
            $this->errors['destination'] = "Destination is required";
        }
        if (empty($data['comment'])) {
            $this->errors['comment'] = "Comment is required";
        }

        //check amount
        if (empty($data['amount'])) {
            $this->errors['amount'] = "type is required";
        } else

        if (!preg_match('~\d+(?:\.\d+)?~', $data['amount'])) {
            $this->errors['amount'] = "Only numbers are allowed in Account Name";
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
