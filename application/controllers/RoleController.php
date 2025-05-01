<?php 

class RoleController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->isNotLoggedIn();

		$this->load->model('model_role');
		$this->load->model('model_permission');
		$this->load->library('form_validation');
	}

    public function index()
    {
        $data['title'] = 'Roles';
        $this->load->view('templates/header', $data);
        $this->load->view('roles/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function createForm()
    {
        $data['title'] = 'Add Role';
        $data['permissions'] = $this->model_permission->fetchPermissionData();
        $this->load->view('templates/header', $data);
        $this->load->view('roles/create', $data);
        $this->load->view('templates/footer', $data);
    }

    public function view($roleId)
    {
        $data['title'] = 'View Role';
        $data['role'] = $this->model_role->fetchRoleData($roleId);
        $data['permissions'] = $this->model_permission->fetchRolePermissionFullData($roleId);
        $this->load->view('templates/header', $data);
        $this->load->view('roles/view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function updateForm($roleId)
    {
        $data['title'] = 'Edit Role';
        $data['role'] = $this->model_role->fetchRoleData($roleId);
        $data['role_permissions'] = $this->model_permission->fetchRolePermissionDataArray($roleId);
        $data['permissions'] = $this->model_permission->fetchPermissionData();
        $this->load->view('templates/header', $data);
        $this->load->view('roles/update', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     *-----------------------------------------
     * validates the role name
     * checks the role name value
     * from the validateRoleName function in
     * the model_role class
     *-----------------------------------------
     */
	public function create()
	{
        $validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'roleName',
				'label' => 'Role Name',
				'rules' => 'required|callback_validateRoleName'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$create = $this->model_role->create();
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
            $validator['messages']['roleName'] = form_error('roleName');
            $validator['messages']['permissions'] = form_error('permissions');

        } // /else

		echo json_encode($validator);
	}

	/**
	*-----------------------------------------
	* validates the role name
	* checks the role name value
	* from the validateRoleName function in
    * the model_role class
    *-----------------------------------------
	*/
	public function validateRoleName()
	{
		$validate = $this->model_role->validateRoleName();

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
	* the model_role class
	*-----------------------------------------
	*/
	public function validatePermissions()
	{
		$validate = $this->model_role->validatePermissions();
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
	* retrieve role name
	*------------------------------------
	*/
    public function fetchRoleData($roleId = null)
    {
        $role = $this->model_role->fetchRoleData($roleId);
        echo json_encode($role);
    }

    public function fetchRolesData()
    {
            $roleDate = $this->model_role->fetchRoleData();
            $result = array('data' => array());

            $x = 1;
            foreach ($roleDate as $key => $value) {

                $button = '<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Action <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				  <li><a href="roles/updateForm/'.$value['id'].'"  > <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				  <li><a href="roles/view/'.$value['id'].'"  > <i class="glyphicon glyphicon-eye"></i> View</a></li>
               <li><a type="button" data-toggle="modal" data-target="#removeRoleModal" onclick="removeRole('.$value['id'].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
                </ul>
				</div>';

                $result['data'][$key] = array(
                    $x,
                    $value['name'],
                    $button
                );
                $x++;
            }
            echo json_encode($result);
    }

	/*
	*------------------------------------
	* edit role information
	*------------------------------------
	*/
	public function update($roleId = null)
	{
		if($roleId) {
			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 'roleName',
					'label' => 'Role Name',
					'rules' => 'required|callback_validateEditRoleName'
				)
			);

			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {	
				$update = $this->model_role->update($roleId);
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
	*-----------------------------------------
	* validates the role name
	* checks the class name which is not 
	* equal to roleId
	*-----------------------------------------
	*/
	public function validateEditRoleName()
	{
		$validate = $this->model_role->validateEditRoleName();

		if($validate === true) {
			$this->form_validation->set_message('validateEditRoleName', 'The {field} already exists');
			return false;						
		}
		else {
			return true;
		}
	}

	/*
	*----------------------------------------
	* remove the role information from
	* the database
	*----------------------------------------
	*/
	public function remove($roleId = null)
	{
		if($roleId) {
			$remove = $this->model_role->remove($roleId);
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