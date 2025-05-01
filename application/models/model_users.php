<?php

class Model_Users extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *-----------------------------------------
     * fetch user data
     *----------------------------------------
     */
    public function fetchUserDataByName($name = null)
    {
        if ($name) {
            $sql = "SELECT * FROM users WHERE username = ?";
            $query = $this->db->query($sql, array($name));
            return $query->row_array();
        }
    }

    /**
     *-----------------------------------------
     * Insert the user info into the database
     *----------------------------------------
     */
    public function create()
    {
        try {
            $this->db->trans_begin();

            $insert_data = array(
                'username' => $this->input->post('username'),
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
            );
            $status = $this->db->insert('users', $insert_data);
            if ($status) {
                $user = $this->fetchUserDataByName($this->input->post('username'));
                if($this->input->post('roles')){
                    foreach ($this->input->post('roles') as $roleId) {
                        /**
                         * insert move log with the reason
                         */
                        $insert_data = array(
                            'user_id' => $user['user_id'],
                            'role_id' => $roleId,
                        );

                        $status = $this->db->insert('user_roles', $insert_data);
                    }
                    if ($status)
                        $this->db->trans_commit();
                    return ($status == true ? true : false);
                }
                $this->db->trans_commit();
               return true;
            }
            return false;

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }

    /**
       *-----------------------------------------
       * update the user information
       *----------------------------------------
       */
    public function update($userId)
    {
        try {
            if ($userId) {

                $this->db->trans_begin();

                /**
                 * remove old related roles to insert new ones
                 * as updating process
                 */
                $this->db->where('user_id', $userId);
                $result = $this->db->delete('user_roles');
                if ($result) {
                    /**
                     * update role instant
                     */
                    $update_data = array(
                        'username' => $this->input->post('username'),
                        'fname' => $this->input->post('fname'),
                        'lname' => $this->input->post('lname'),
                        'email' => $this->input->post('email')
                    );

                    /**
                     * password is not required
                     * in case was posted then update it
                     */
                    if($this->input->post('password'))
                        $update_data=array_merge(array('password' => md5($this->input->post('password'))));

                    $status = false;
                    $this->db->where('user_id', $userId);
                    $result = $this->db->update('users', $update_data);
                    if ($result) {
                        /**
                         * insert new related permissions
                         */
                        foreach ($this->input->post('roles') as $roleId) {
                            /**
                             * insert move log with the reason
                             */
                            $insert_data = array(
                                'role_id' => $roleId,
                                'user_id' => $userId,
                            );

                            $status = $this->db->insert('user_roles', $insert_data);
                        }
                        if ($status) {
                            $this->db->trans_commit();
                            return true;
                        }
                        return false;
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


    public function validate_postUserName()
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $query = $this->db->query($sql, array($this->input->post('username')));
        return ($query->num_rows() > 0 ? true : false);
    }


    public function validate_username($username = null)
    {
        if ($username) {
            $sql = "SELECT * FROM users WHERE username = ?";
            $query = $this->db->query($sql, array($username));
            $result = $query->row_array();

            return ($query->num_rows() === 1 ? true : false);
        } else {
            return false;
        }
    } // /validate username function

    /**
        *----------------------------------------
        * remove the user information
        * with related roles data
        *----------------------------------------
        */
    public function remove($userId = null)
    {
        try {
            if ($userId) {

                $this->db->trans_begin();

                $this->db->where('user_id', $userId);
                $result = $this->db->delete('user_roles');
                if ($result) {
                    $this->db->where('user_id', $userId);
                    $result = $this->db->delete('users');
                    if ($result)
                        $this->db->trans_commit();
                    return ($result == true ? true : false);
                }

                return false;
            }
            return false;

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function validate_current_password($password = null, $userId = null)
    {
        if ($password && $userId) {
            $password = md5($this->input->post('currentPassword'));

            $sql = "SELECT * FROM users WHERE password = ? AND user_id = ?";
            $query = $this->db->query($sql, array($password, $userId));
            $result = $query->row_array();

            return ($query->num_rows() === 1 ? true : false);
        } else {
            return false;
        }
    } // /validate username function

    public function login($username = null, $password = null)
    {
        if ($username && $password) {
            $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
            $query = $this->db->query($sql, array($username, $password));
            $result = $query->row_array();

            return ($query->num_rows() === 1 ? $result['user_id'] : false);
        } else {
            return false;
        }
    }

    public function fetchUserData($userId = null)
    {
        if ($userId) {
            $sql = "SELECT * FROM users WHERE user_id = ?";
            $query = $this->db->query($sql, array($userId));
            return $query->row_array();
        } else {
            $sql = "SELECT * FROM users";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
    }

    public function updateProfile($userId = null)
    {
        if ($userId) {
            $update_data = array(
                'username' => $this->input->post('username'),
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email')
            );

            $this->db->where('user_id', $userId);
            $status = $this->db->update('users', $update_data);
            return ($status == true ? true : false);
        }
    }

    public function changePassword($userId = null)
    {
        if ($userId) {
            $password = md5($this->input->post('newPassword'));
            $update_data = array(
                'password' => $password
            );

            $this->db->where('user_id', $userId);
            $status = $this->db->update('users', $update_data);
            return ($status == true ? true : false);
        }
    }

    /*
       *------------------------------------
       * count total users information
       *------------------------------------
       */
    public function countTotalUsers()
    {
        $sql = "SELECT * FROM users";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}