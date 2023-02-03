<?php 

namespace Model;  
/**
 * users class
 */
class Finance extends Model {

    public $errors = [];
	protected $table = "finance_acc";
	protected $allowed_columns = [

				'type',
				'id',
				'acc_name',
				'acc_number',
				'location',
				'balance',
				'updated_on',
				'updated_by',
				
			];

 	public function validate($data)
	{
		$this->errors = [];

			//check a/c name
			if(empty($data['acc_name']))
			{
				$this->errors['acc_name'] = "Account Name is required";
			}else
			if(!preg_match('/^[a-zA-Z ]+$/', $data['acc_name']))
			{
				$this->errors['acc_name'] = "Only letters allowed in Account Name";
			}
                        
			//check location
			if(empty($data['location']))
			{
				$this->errors['location'] = "Account location is required";
			}
                        
			//check type
			if(empty($data['type']))
			{
				$this->errors['type'] = "Type is required";
			}
        
        if(empty($this->errors))
        {
            return true;
        }

        return false;
	}
 	

}