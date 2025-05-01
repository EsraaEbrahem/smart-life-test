<?php 

class UsersController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// loading the users model
		$this->load->model('model_users');
		$this->load->model('model_role');

		// loading the form validation library
		$this->load->library('form_validation');		

	}

	public function updateProfile()
	{
		$this->load->library('session');
		$userId = $this->session->userdata('id');

		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			),
			array(
				'field' => 'fname',
				'label' => 'First Name',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {	
			$update = $this->model_users->updateProfile($userId);					
			if($update === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully Update";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Error while inserting the information into the database";
			}			
		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	}

	public function changePassword()
	{
		$this->load->library('session');
		$userId = $this->session->userdata('id');

		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'currentPassword',
				'label' => 'Current Password',
				'rules' => 'required|callback_validate_current_password'
			),
			array(
				'field' => 'newPassword',
				'label' => 'Password',
				'rules' => 'required|matches[confirmPassword]'
			),
			array(
				'field' => 'confirmPassword',
				'label' => 'Confirm Password',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');		

		if($this->form_validation->run() === true) {	
			$update = $this->model_users->changePassword($userId);					
			if($update === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully Update";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Error while inserting the information into the database";
			}			
		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	}


    public function index()
    {
        $data['title'] = 'Users';
        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function createForm()
    {
        $data['title'] = 'Add User';
        $data['roles'] = $this->model_role->fetchRoleData();
        $this->load->view('templates/header', $data);
        $this->load->view('users/create', $data);
        $this->load->view('templates/footer', $data);
    }

    public function view($userId)
    {
        $data['title'] = 'View User';
        $data['user'] = $this->model_users->fetchUserData($userId);
        $data['roles'] = $this->model_role->fetchUserRolesFullData($userId);
        $this->load->view('templates/header', $data);
        $this->load->view('users/view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function updateForm($userId)
    {
        $data['title'] = 'Edit User';
        $data['user'] = $this->model_users->fetchUserData($userId);
        $data['user_roles'] = $this->model_role->fetchUserRoleDataArray($userId);
        $data['roles'] = $this->model_role->fetchRoleData();
        $this->load->view('templates/header', $data);
        $this->load->view('users/update', $data);
        $this->load->view('templates/footer', $data);
    }

    public function validateUserName()
    {
        $validate = $this->model_users->validate_postUserName();

        if($validate === true) {
            $this->form_validation->set_message('validateUserName', 'The {field} already exists');
            return false;
        }
        else {
            return true;
        }
    }

    /**
     *-----------------------------------------
     * validates the user name
     * checks the user name value
     * from the validateRoleName function in
     * the model_user class
     *-----------------------------------------
     */
    public function create()
    {
        $validator = array('success' => false, 'messages' => array());

        $validate_data = array(
            array(
                'field' => 'username',
                'label' => 'User Name',
                'rules' => 'required|callback_validateUserName'
            ),
            array(
                'field' => 'fname',
                'label' => 'First Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'lname',
                'label' => 'Last Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validate_data);
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if($this->form_validation->run() === true) {
            $create = $this->model_users->create();
            if($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully added";
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }
        }
        else {
            $validator['success'] = false;
            foreach ($_POST as $key => $value) {
                $validator['messages'][$key] = form_error($key);
            }
        } // /else

        echo json_encode($validator);
    }

    /**
     *-----------------------------------------
     * validates the user name
     * checks the user name value
     * from the validateRoleName function in
     * the model_user class
     *-----------------------------------------
     */
    public function validateRoleName()
    {
        $validate = $this->model_users->validateRoleName();

        if($validate === true) {
            $this->form_validation->set_message('validateRoleName', 'The {field} already exists');
            return false;
        }
        else {
            return true;
        }
    }

    /**
     *-----------------------------------------
     * validates the class name
     * checks the class name value
     * from the validate_classname function in
     * the model_user class
     *-----------------------------------------
     */
    public function validatePermissions()
    {
        $validate = $this->model_users->validatePermissions();
        if($validate === false) {
            $this->form_validation->set_message('validatePermissions', 'The {field} already exists');
            return false;
        }
        else {
            return true;
        }
    }

    /*
    *------------------------------------
    * retrieve user name
    *------------------------------------
    */
    public function fetchUserData($userId = null)
    {
        $user = $this->model_users->fetchUserData($userId);
        echo json_encode($user);
    }

    public function fetchUsersData()
    {
        $userDate = $this->model_users->fetchUserData();
        $result = array('data' => array());

        $x = 1;
        foreach ($userDate as $key => $value) {

            $button = '<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Action <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				  <li><a href="users/updateForm/'.$value['user_id'].'"  > <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				  <li><a href="users/view/'.$value['user_id'].'"  > <i class="glyphicon glyphicon-eye"></i> View</a></li>
               <li><a type="button" data-toggle="modal" data-target="#removeUserModal" onclick="removeUser('.$value['user_id'].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
                </ul>
				</div>';

            $result['data'][$key] = array(
                $x,
                $value['username'],
                $value['fname'],
                $value['lname'],
                $button
            );
            $x++;
        }
        echo json_encode($result);
    }

    /*
    *------------------------------------
    * edit user information
    *------------------------------------
    */
    public function update($userId = null)
    {
        if($userId) {
            $validator = array('success' => false, 'messages' => array());

            $validate_data = array(
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'fname',
                    'label' => 'First Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'lname',
                    'label' => 'Last Name',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($validate_data);
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if($this->form_validation->run() === true) {
                $update = $this->model_users->update($userId);
                if($update == true) {
                    $validator['success'] = true;
                    $validator['messages'] = "Successfully Updated";
                }
                else {
                    $validator['success'] = false;
                    $validator['messages'] = "Error while inserting the information into the database";
                }
            }
            else {
                $validator['success'] = false;
                foreach ($_POST as $key => $value) {
                    $validator['messages'][$key] = form_error($key);
                }
            } // /else
            echo json_encode($validator);
        }
    }

    /*
    *----------------------------------------
    * remove the user information from
    * the database
    *----------------------------------------
    */
    public function remove($userId = null)
    {
        if($userId) {
            $remove = $this->model_users->remove($userId);
            if($remove === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully Removed";
            }
            else{
                $validator['success'] = false;
                $validator['messages'] = "Error while removing the information";
            }
            echo json_encode($validator);
        }
    }


}