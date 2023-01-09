<?php 

namespace Model;

/**
 * admin model
 */
class Admin extends Model
{
	
	public $errors = [];
	protected $table = "admin";

	protected $allowedColumns = [

	 'firstname',
		'lastname',
		'email',
		'password',
		'role',
		'gender',
		'dob',
		'company',
		'job',
		'phone',
		'date',
		'slug',
		'image',
		'disabled',
		'marital_status_id',
		'father_name',
		'mother_name',
		'father_phone',
		'mother_phone',
		'hometown',
		'residence',
		'position_id',
		'localposition_id',
		'category_id',
		'gps_address',
		'water_baptized',
		'holyghost_baptized',
		'communicant_status',
		'emergecy_name',
		'emergecy_contact',
		'children',
		 
	];

	protected $afterSelect = [

		'get_role',
		'get_position',
		'get_local_position',
		'get_marital_status',
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['firstname']))
		{
			$this->errors['firstname'] = "A first name is required";
		}else
		if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['firstname'])))
		{
			$this->errors['firstname'] = "first name can only have letters without spaces";
		}
		

		if(empty($data['lastname']))
		{
			$this->errors['lastname'] = "A last name is required";
		}else
		if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['lastname'])))
		{
			$this->errors['lastname'] = "last name can only have letters and spaces";
		}

		//check email
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}else
		if($this->where(['email'=>$data['email']]))
		{
			$this->errors['email'] = "That email already exists";
		}

		if(!empty($data['phone']))
		{
			if(!preg_match("/^(0|\+233)[0-9]{9}$/", trim($data['phone'])))
			{
				$this->errors['phone'] = "Phone number not valid";
			}
		}

		//check dob
		if(empty($data['dob']))
		{
			$this->errors['dob'] = "Please enter your date of birth";
		}	

		/*if(empty($data['marital_status']))
		{
			$this->errors['marital_status'] = "Please choose your marital status";
		}*/

		if(!empty($data['father_name']))
		{		
			if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['father_name'])))
			{
				$this->errors['father_name'] = "Father's name can only have letters and spaces";
			}
		}

		if(!empty($data['father_phone']))
		{
			if(!preg_match("/^(0|\+233)[0-9]{9}$/", trim($data['father_phone'])))
			{
				$this->errors['father_phone'] = "Phone number not valid";
			}
		}

		if(!empty($data['mother_name']))
		{
			if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['mother_name'])))
			{
				$this->errors['mother_name'] = "Mother's's name can only have letters and spaces";
			}
		}

		if(!empty($data['mother_phone']))
		{
			if(!preg_match("/^(0|\+233)[0-9]{9}$/", trim($data['mother_phone'])))
			{
				$this->errors['mother_phone'] = "Phone number not valid";
			}
		}

		if(!empty($data['hometown']))
		{
			if(!preg_match("/^[a-zA-Z0-9 \.\-]+$/", trim($data['hometown'])))
			{
				$this->errors['hometown'] = "Hometown can only have letters, numbers and spaces.";
			}
		}

		if(empty($data['residence']))
		{
			$this->errors['residence'] = "Please enter your residence";
		}

		//check password
		/*if(empty($data['password']))
		{
			$this->errors['password'] = "A password is required";
		}

		if($data['password'] !== $data['retype_password'])
		{
			$this->errors['password'] = "Passwords do not match";
		}*/

		//check gender
		if(empty($data['gender']))
		{
			$this->errors['gender'] = "Please select your gender";
		}

		//check dob
		if(empty($data['dob']))
		{
			$this->errors['dob'] = "Please enter your date of birth";
		}	

		//terms
		if(empty($data['terms']))
		{
			$this->errors['terms'] = "Please accept the terms and conditions";
		}		
		
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}


	public function edit_validate($data,$id)
	{
		$this->errors = [];

		if(empty($data['firstname']))
		{
			$this->errors['firstname'] = "A first name is required";
		}else
		if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['firstname'])))
		{
			$this->errors['firstname'] = "first name can only have letters without spaces";
		}
		

		if(empty($data['lastname']))
		{
			$this->errors['lastname'] = "A last name is required";
		}else
		if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['lastname'])))
		{
			$this->errors['lastname'] = "last name can only have letters and spaces";
		}

		//check email
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}else
		if($results = $this->where(['email'=>$data['email']]))
		{
			foreach ($results as $result) {
				if($id != $result->id)
					$this->errors['email'] = "That email already exists";
			}
			
		}

		if(!empty($data['phone']))
		{
			if(!preg_match("/^(0|\+233)[0-9]{9}$/", trim($data['phone'])))
			{
				$this->errors['phone'] = "Phone number not valid";
			}
		}

		//check dob
		if(empty($data['dob']))
		{
			$this->errors['dob'] = "Please enter your date of birth";
		}	

		/*if(empty($data['marital_status_id']))
		{
			$this->errors['marital_status_id'] = "Please choose your marital status";
		}

		if(empty($data['role']))
		{
			$this->errors['role'] = "Please choose your role";
		}*/

		if(!empty($data['father_name']))
		{		
			if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['father_name'])))
			{
				$this->errors['father_name'] = "Father's name can only have letters and spaces";
			}
		}

		if(!empty($data['mother_name']))
		{
			if(!preg_match("/^[a-zA-Z \.\-]+$/", trim($data['mother_name'])))
			{
				$this->errors['mother_name'] = "Mother's's name can only have letters and spaces";
			}
		}

		if(!empty($data['hometown']))
		{
			if(!preg_match("/^[a-zA-Z0-9 \.\-]+$/", trim($data['hometown'])))
			{
				$this->errors['hometown'] = "Hometown can only have letters, numbers and spaces.";
			}
		}

		if(empty($data['residence']))
		{
			$this->errors['residence'] = "Please enter your residence";
		}
  
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	protected function get_role($data)
	{

		if(!empty($data[0]->email) && !empty($data[0]->role))
		{

			foreach ($data as $key => $row) {
				
				$query = "select role from roles where id = :id limit 1";
				$res = $this->query($query,['id'=>$row->role]);

				if($res)
				{
					$data[$key]->role_name = $res[0]->role;
				}
			}

		}

		return $data;
	}

	protected function get_position($rows){

		$db = new \Database();
		if(!empty($rows[0]->position_id))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select * from positions where id = :id limit 1";
				$position = $db->query($query,['id'=>$row->position_id]);
				if(!empty($position)){

					$position[0]->position = $position[0]->position . '$position[0]->position';
					$rows[$key]->position_name = $position[0];
				}
			}
		}

		return $rows;
	}

	protected function get_local_position($rows){

		$db = new \Database();
		if(!empty($rows[0]->localposition_id))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select * from localpositions where id = :id limit 1";
				$localposition = $db->query($query,['id'=>$row->localposition_id]);
				if(!empty($localposition)){

					$localposition[0]->position = $localposition[0]->position . '$localposition[0]->position';
					$rows[$key]->localposition_name = $localposition[0];
				}
			}
		}

		return $rows;
	}

	protected function get_marital_status($rows){

		$db = new \Database();
		if(!empty($data[0]->email) && !empty($rows[0]->marital_status_id))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select * from marital_status";
				$marital_status = $db->query($query,['id'=>$row->marital_status_id]);
				if(!empty($marital_status)){

					$marital_status[0]->name = $marital_status[0]->name . ' $marital_status[0]->marital_status';
					$rows[$key]->marital_status_row = $marital_status[0];
				}
			}
		}

		return $rows;
	}

	/*protected function get_marital_status($data)
	{
		$db = new \Database();
		if(!empty($data[0]->email))
		{
			foreach ($data as $row) {
				
				$query = "select marital_status from marital_status where id = :id limit 1";
				$cat = $db->query($query,['marital_status'=>$row->marital_status]);
				if($cat)
				{

					$data[$key]->marital_status = $cat[0]->marital_status;
				}
			}
		}

		return $data;
	}*/

}