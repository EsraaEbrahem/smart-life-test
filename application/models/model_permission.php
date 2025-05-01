<?php

class Model_Permission extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
    *-----------------------------------------
    * fetch permission data
    *----------------------------------------
    */
    public function fetchPermissionDataByName($name = null)
    {
        if ($name) {
            $sql = "SELECT * FROM permissions WHERE name = ?";
            $query = $this->db->query($sql, array($name));
            return $query->row_array();
        }
    }

    /*
    *-----------------------------------------
    * fetch permission data
    *----------------------------------------
    */
    public function fetchPermissionData($permissionId = null)
    {
        if ($permissionId) {
            $sql = "SELECT * FROM permissions WHERE id = ?";
            $query = $this->db->query($sql, array($permissionId));
            return $query->row_array();
        } else {
            $sql = "SELECT * FROM permissions";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
    }

    /**
     *-----------------------------------------
     * fetch permission data by role
     *----------------------------------------
     */
    public function fetchRolePermissionData($roleId = null)
    {
        if ($roleId) {
            $sql = "SELECT * FROM role_permissions WHERE role_id = ?";
            $query = $this->db->query($sql, array($roleId));
            return $query->result_array();
        } else {
            $sql = "SELECT * FROM role_permissions";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
    }

    /**
     * get permissions data for a role
     * from permissions table to be able of showing name...
     * @param $roleId
     * @return void
     */
    public function fetchRolePermissionFullData($roleId = null)
    {
        if ($roleId) {
            $sql = "SELECT * FROM permissions 
                inner join role_permissions on permissions.id = role_permissions.permission_id
                WHERE role_id = ?";
            $query = $this->db->query($sql, array($roleId));
            return $query->result_array();
        }
    }

    /**
     *-----------------------------------------
     * fetch permission data by role
     *----------------------------------------
     */
    public function fetchRolePermissionDataArray($roleId = null)
    {
        $perms = $this->fetchRolePermissionData($roleId);
        $permissionIds = array();
        foreach ($perms as $perm){
            $permissionIds[]=$perm['permission_id'];
        }
        return $permissionIds;
    }


    /*
    *------------------------------------
    * count total classes information
    *------------------------------------
    */
    public function countTotalClass()
    {
        $sql = "SELECT * FROM permissions";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

}