<?php

class AuthController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // loading the users model
        $this->load->model('model_users');

        // loading the form validation library
        $this->load->library('form_validation');

    }

    public function index()
    {
        $this->isLoggedIn();
        $data['title'] = 'Login';
        $this->load->view('auth/login', $data);
    }

    public function setting()
    {
        $this->isNotLoggedIn();
        $this->load->library('session');
        $userId = $this->session->userdata('id');
        $data['userData'] = $this->model_users->fetchUserData($userId);
        $data['title'] = 'Setting';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/setting', $data);
        $this->load->view('templates/footer', $data);
    }

    public function login()
    {

        $validator = array('success' => false, 'messages' => array());

        $validate_data = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|callback_validate_username'
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
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $login = $this->model_users->login($username, $password);

            if($login) {
                $this->load->library('session');

                $user_data = array(
                    'id' => $login,
                    'logged_in' => true,
                    "roles" => $this->userWiseRoles($login)
                );

                $this->session->set_userdata($user_data);

                $validator['success'] = true;
                $validator['messages'] = "index.php/dashboard";
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Incorrect username/password combination";
            } // /else

        }
        else {
            $validator['success'] = false;
            foreach ($_POST as $key => $value) {
                $validator['messages'][$key] = form_error($key);
            }
        } // /else

        echo json_encode($validator);
    } // /lgoin function

    /**
     * @param $login
     * @return array
     */
    protected function userWiseRoles($userId)
    {
        return array_map(function ($item) {
            return $item["role_id"];
        }, $this->db->get_where("user_roles", array("user_id" => $userId))->result_array());
    }


    public function validate_username()
    {
        $validate = $this->model_users->validate_username($this->input->post('username'));

        if($validate === true) {
            return true;
        }
        else {
            $this->form_validation->set_message('validate_username', 'The {field} does not exists');
            return false;
        } // /else
    } // /validate username function

    public function logout()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

    public function validate_current_password()
    {
        $this->load->library('session');
        $userId = $this->session->userdata('id');
        $validate = $this->model_users->validate_current_password($this->input->post('currentPassword'), $userId);

        if($validate === true) {
            return true;
        }
        else {
            $this->form_validation->set_message('validate_current_password', 'The {field} is incorrect');
            return false;
        } // /else
    }

}