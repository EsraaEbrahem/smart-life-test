<?php

class Model_Role extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
    *-----------------------------------------
    * Insert the role info into the database
    *----------------------------------------
    */
    public function create()
    {
        try {
            $this->db->trans_begin();


            $insert_data = array(
                'name' => $this->input->post('roleName'),
            );
            $status = $this->db->insert('roles', $insert_data);
            if ($status) {
                $role = $this->fetchRoleDataByName($this->input->post('roleName'));

                foreach ($this->input->post('permissions') as $permissionId) {
                    /**
                     * insert move log with the reason
                     */
                    $insert_data = array(
                        'role_id' => $role['id'],
                        'permission_id' => $permissionId,
                    );

                    $status = $this->db->insert('role_permissions', $insert_data);
                }
                if ($status)
                    $this->db->trans_commit();
                return ($status == true ? true : false);
            }
            return false;

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }

    /*
    *-----------------------------------------
    * validate the role name
    *----------------------------------------
    */
    public function validateRoleName()
    {
        $roleName = $this->input->post('roleName');
        $sql = "SELECT * FROM roles WHERE name = ?";
        $query = $this->db->query($sql, array($roleName));

        return ($query->num_rows() == 1 ? true : false);
    }

    /**
     * check if permissions array is not empty
     * and no duplicated values
     * @return bool
     */
    public function validatePermissions()
    {
        $perms = $this->input->post('permissions');
        if ($perms && sizeof($perms) > 0) {
            return sizeof($perms) == sizeof(array_unique($perms));
        }
        return false;
    }

    /*
    *-----------------------------------------
    * fetch role data
    *----------------------------------------
    */
    public function fetchRoleDataByName($name = null)
    {
        if ($name) {
            $sql = "SELECT * FROM roles WHERE name = ?";
            $query = $this->db->query($sql, array($name));
            return $query->row_array();
        }
    }

    /*
    *-----------------------------------------
    * fetch role data
    *----------------------------------------
    */
    public function fetchRoleData($roleId = null)
    {
        if ($roleId) {
            $sql = "SELECT * FROM roles WHERE id = ?";
            $query = $this->db->query($sql, array($roleId));
            return $query->row_array();
        } else {
            $sql = "SELECT * FROM roles";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
    }

    public function validateEditRoleName()
    {
        $roleName = $this->input->post('roleName');
        $roleId = $this->input->post('roleId');
        $sql = "SELECT * FROM roles WHERE name = ? AND id != ?";
        $query = $this->db->query($sql, array($roleName, $roleId));

        return ($query->num_rows() == 1 ? true : false);
    }

    /*
    *-----------------------------------------
    * update the class information
    *----------------------------------------
    */
    public function update($roleId)
    {
        try {
            if ($roleId) {

                $this->db->trans_begin();

                /**
                 * remove old related permissions to insert new ones
                 * as updating process
                 */
                $this->db->where('role_id', $roleId);
                $result = $this->db->delete('role_permissions');
                if ($result) {
                    /**
                     * update role instant
                     */
                    $update_data = array(
                        'name' => $this->input->post('roleName'),
                    );
                    $status = false;
                    $this->db->where('id', $roleId);
                    $result = $this->db->update('roles', $update_data);
                    if ($result) {
                        /**
                         * insert new related permissions
                         */
                        foreach ($this->input->post('permissions') as $permissionId) {
                            /**
                             * insert move log with the reason
                             */
                            $insert_data = array(
                                'role_id' => $roleId,
                                'permission_id' => $permissionId,
                            );

                            $status = $this->db->insert('role_permissions', $insert_data);
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

    /*
    *----------------------------------------
    * remove the role information
    *----------------------------------------
    */
    public function remove($roleId = null)
    {
        try {
            if ($roleId) {

                $this->db->trans_begin();

                $this->db->where('role_id', $roleId);
                $result = $this->db->delete('role_permissions');
                if ($result) {
                    $this->db->where('id', $roleId);
                    $result = $this->db->delete('roles');
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

    /**
     *-----------------------------------------
     * fetch roles data by user
     *----------------------------------------
     */
    public function fetchUserRoleData($userId = null)
    {
        if ($userId) {
            $sql = "SELECT * FROM user_roles WHERE user_id = ?";
            $query = $this->db->query($sql, array($userId));
            return $query->result_array();
        } else {
            $sql = "SELECT * FROM user_roles";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
    }

    /**
     * get roles data for a user
     * from roles table to be able of showing name...
     * @param $roleId
     * @return void
     */
    public function fetchUserRolesFullData($userId = null)
    {
        if ($userId) {
            $sql = "SELECT * FROM roles 
                inner join user_roles on roles.id = user_roles.role_id
                WHERE user_id = ?";
            $query = $this->db->query($sql, array($userId));
            return $query->result_array();
        }
    }

    /**
     *-----------------------------------------
     * fetch role data by $userId
     *----------------------------------------
     */
    public function fetchUserRoleDataArray($userId = null)
    {
        $roles = $this->fetchUserRoleData($userId);
        $rolesIds = array();
        foreach ($roles as $role){
            $rolesIds[]=$role['role_id'];
        }
        return $rolesIds;
    }


    /*
    *------------------------------------
    * count total roles information
    *------------------------------------
    */
    public function countTotalRoles()
    {
        $sql = "SELECT * FROM roles";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

}