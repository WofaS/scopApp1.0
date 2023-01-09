<?php 

namespace Controller;

/**
 * signup class
 */

use \Model\Auth;

class MemberSignup extends Controller
{
	
	public function index()
	{
		// if(!Auth::logged_in())
		// {
		// 	message('please login to view the admin section');
		// 	redirect('login');
		// }
	
		$data['errors'] = [];

		$member = new \Model\Member();
		$role = new \Model\Role();
		$marital_status = new \Model\Marital_status_model();
		$position = new \Model\Position_model();

		$role = $role->findAll('asc');
		$position = $position->findAll('asc');
		$marital_status = $marital_status->findAll('asc');

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{

			if($member->validate($_POST))
			{
				$_POST['date'] = date("Y-m-d H:i:s");
				$_POST['position'] = $_POST['position'];
				$_POST['marital_status'] = $_POST['marital_status'];

				$member->insert($_POST);
			
				message( ucfirst($_POST['firstname'])." has been added successfuly.<br> Thank you!!");
				redirect('admin/groups');
			}
		}

		$data['errors'] = $member->errors;
		$data['title'] = "Signup";

		$this->view('membersignup',$data);
	}
	
}