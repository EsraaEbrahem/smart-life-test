<?php 

class Model_Teacher extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    /**
     *-----------------------------------------
     * Insert the user info into the database
     *----------------------------------------
     */
    public function create($img_url = '')
    {
        try {
            $this->db->trans_begin();
            if($img_url == '') {
                $img_url = 'assets/images/default/default_avatar.png';
            }

            $insert_data = array(
                'username' => $this->input->post('username'),
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
            );
            $status = $this->db->insert('users', $insert_data);
            if ($status) {
                $CI =& get_instance();
                $CI->load->model('model_users');
                $CI->load->model('model_role');
                /**
                 * get inserted user
                 */
                $user = $this->model_users->fetchUserDataByName($this->input->post('username'));
                $role = $this->model_role->fetchRoleDataByName('teacher');

                /**
                 * relate it with teacher role
                 */
                $insert_data = array(
                    'user_id' => $user['user_id'],
                    'role_id' => $role['id'],
                );

                $status = $this->db->insert('user_roles', $insert_data);
                if($status){
                    /**
                     * insert teacher and link it with the user
                     */
                    $insert_data = array(
                        'user_id' => $user['user_id'],
                        'register_date' => $this->input->post('registerDate'),
                        'fname' 		=> $this->input->post('fname'),
                        'lname'			=> $this->input->post('lname'),
                        'image'			=> $img_url,
                        'date_of_birth' => $this->input->post('dob'),
                        'age'			=> $this->input->post('age'),
                        'contact'		=> $this->input->post('contact'),
                        'email'			=> $this->input->post('email'),
                        'address'		=> $this->input->post('address'),
                        'city'			=> $this->input->post('city'),
                        'country'		=> $this->input->post('country'),
                        'job_type'		=> $this->input->post('jobType')
                    );

                    $status = $this->db->insert('teacher', $insert_data);
                    if($status){
                        $this->db->trans_commit();
                        return true;
                    }
                    return false;
                }
                return false;
            }
            return false;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }


	/*
	*------------------------------------
	* retrieves teacher information 
	*------------------------------------
	*/
	public function fetchTeacherData($teacherId = null)	
	{
		if($teacherId) {
			$sql = "SELECT * FROM teacher WHERE teacher_id = ?";
			$query = $this->db->query($sql, array($teacherId));
			$result = $query->row_array();
			return $result;
		}

		$sql = "SELECT * FROM teacher";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}

	/*
	*------------------------------------
	* updates teacher information
	*------------------------------------
	*/
	public function updateInfo($teacherId = null)
	{
		if($teacherId) {
			$update_data = array(
				'register_date' 	=> $this->input->post('editRegisterDate'),
				'fname' 			=> $this->input->post('editFname'),
				'lname' 			=> $this->input->post('editLname'),
				'date_of_birth'     => $this->input->post('editDob'),
				'age'				=> $this->input->post('editAge'),
				'contact'			=> $this->input->post('editContact'),
				'email'				=> $this->input->post('editEmail'),
				'address'			=> $this->input->post('editAddress'),
				'city'				=> $this->input->post('editCity'),	
				'country'			=> $this->input->post('editCountry'),
				'job_type'			=> $this->input->post('editJobType')
			);

			$this->db->where('teacher_id', $teacherId);
			$query = $this->db->update('teacher', $update_data);
			
			return ($query === true ? true : false);
		}			
	}

	/*
	*------------------------------------
	* updates teacher information
	*------------------------------------
	*/
	public function updatePhoto($teacherId = null, $imageUrl = null)
	{
		if($teacherId && $imageUrl) {
			$update_data = array(
				'image' 	=> $imageUrl
			);

			$this->db->where('teacher_id', $teacherId);
			$query = $this->db->update('teacher', $update_data);
			
			return ($query === true ? true : false);
		}			
	}

	/*
	*------------------------------------
	* removes teacher information 
	*------------------------------------
	*/
	public function remove($teacherId = null)
	{
		if($teacherId) {
			$this->db->where('teacher_id', $teacherId);
			$result = $this->db->delete('teacher');
			return ($result === true ? true: false); 
		} // /if
	}

	/*
	*------------------------------------
	* count total teacher information 
	*------------------------------------
	*/	
	public function countTotalTeacher() 
	{
		$sql = "SELECT * FROM teacher";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}