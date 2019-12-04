<?php

class User_model extends CI_Model {

	function insert_data($data){
		$this->db->insert('user',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}
	function get_user_by_username($username)
	{
		$this->db->select('*');
		$this->db->where('username ',$username);
		$this->db->from('user');
		$query=$this->db->get();
		return $query->result_array();
	}

	function login_validate($username,$password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->where('Active', 1);
		$query = $this->db->get('user');
		
		if($query->num_rows() == 1)
		{
			$this->load->model('Employee_model');
			foreach ($query->result() as $value) {
			$data = array(
					'user_id'=>$value->ID,
					'username' => $value->Username,
					'password' => $value->Password,
					'emp_id' =>  $value->EmployeeID,
					//'user_photo'=>$value->image,
					'is_logged_in' => true//,
					//'postion'=>$this->get_user_sp($value->user_id),
					//'permession'=>$this->user_model->get_roles_by_id($value->user_id)
				);
			}
			$current_employee=$this->Employee_model->get_employee_by_id($data['emp_id']);
			if($current_employee)
			{
				foreach ($current_employee as $row)
				{
					$data['Full_name'] = $row->FirstName.' '.$row->LastName;
					$data['Position'] = $this->Employee_model->get_position_by_id($row->PositionID);
					$data['Photo'] =  $row->Photo;
				}
			}
			//$permession=$data['permession'];
			/*$data['usr_edit']="";
			$data['usr_del']="";
			$data['usr_add']="";*/
			/*foreach ($permession as  $value) {
				//////side bar (navigation) ////////
				if ($value->role_code=="USR_VIEW" && $value->active=='nonactive') {
					$data['usr_view']="cnt-hide";
				}
				if ($value->role_code=="PRJ_VIEW" && $value->active=='nonactive') {
					$data['prj_view']="cnt-hide";
				}
				if ($value->role_code=="SPE_VIEW" && $value->active=='nonactive') {
					$data['spe_view']="cnt-hide";
				}
				if ($value->role_code=="REP_VIEW" && $value->active=='nonactive') {
					$data['rep_view']="cnt-hide";
				}
				/////// user page ///////
				if ($value->role_code=="USR_ADD" && $value->active=='nonactive') {
					$data['usr_add']="cnt-hide";
				}
				if ($value->role_code=="USR_EDIT" && $value->active=='nonactive') {
					$data['usr_edit']="cnt-hide";
				}
				if ($value->role_code=="USR_DEL" && $value->active=='nonactive') {
					$data['usr_del']="cnt-hide";
				}
				if ($value->role_code=="USR_SPE" && $value->active=='nonactive') {
					$data['usr_spe']="cnt-hide";
				}
				if ($value->role_code=="USR_PERM" && $value->active=='nonactive') {
					$data['usr_perm']="cnt-hide";
				}
				if ($value->role_code=="USR_ACC" && $value->active=='nonactive') {
					$data['usr_acc']="cnt-hide";
				}
				////// project ///////
				if ($value->role_code=="PRJ_ADD" && $value->active=='nonactive') {
					$data['prj_add']="cnt-hide";
				}
				if ($value->role_code=="PRJ_EDIT" && $value->active=='nonactive') {
					$data['prj_edit']="cnt-hide";
				}
				if ($value->role_code=="PRJ_DEL" && $value->active=='nonactive') {
					$data['prj_del']="cnt-hide";
				}
				if ($value->role_code=="PRJ_MEM" && $value->active=='nonactive') {
					$data['prj_mem']="cnt-hide";
				}
				if ($value->role_code=="TSK_VIEW" && $value->active=='nonactive') {
					$data['tsk_view']="cnt-hide";
				}
				
				
				
			}*/
		
			$this->session->set_userdata($data);
			//$this->main_permission();
			return $query->result();
		}	


	}

	function get_default_username()
	{
		return "administrator";
	}
	function is_User_password($password)
	{
        $user = $this->db->get_where('user',['ID'=>get_cookie('user_id')])->row(0);
        if(!$user)
        {
            return false;
        }
		if($user->Password==md5($password))
			return true;
		return false;
	}

	function update_user($data)
	{
		$this->db->where('id', get_cookie('user_id'));
    	$this->db->update('user', $data);
	}

	 /**
     * Find data.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->db->get_where("user", array("id" => $id))->row(0);
    }

    /**
     * Find all data.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->db->get_where("user")->result_array();
    }

    public function all_active()
    {
        return $this->db->get_where("user",['status'=>1])->result_array();
    }


    /**
     * Insert data.
     *
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);

        return $this->db->insert('user', $data);
    }

    /**
     * Edit data.
     *
     * @param $data
     * @return mixed
     */
    public function edit($data)
    {
        return $this->db->update('user', $data, array('id' => $data['id']));
    }

    /**
     * Delete data.
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $data['deleted_at'] = date("Y-m-d H:i:s");

        return $this->find($id) ? $this->db->update('user', $data, array('id' => $id)) : 0;
    }

    /**
     * Insert roles.
     *
     * @param $user_id
     * @param $roles
     * @return int
     */
    public function addRoles($user_id, $roles)
    {
        $data["user_id"] = $user_id;
        if (is_array($roles)) {
            foreach ($roles as $role) {
                $data["role_id"] = $role;
                $this->addRole($data);
            }
        }
        else {
            $data["role_id"] = $roles;
            $this->addRole($data);
        }

        return 1;
    }

    /**
     * Insert role.
     *
     * @param $data
     * @return mixed
     */
    public function addRole($data)
    {
        return $this->db->insert('user_role', $data);
    }

    /**
     * Edit roles.
     *
     * @param $user_id
     * @param $roles
     * @return int
     */
    public function editRoles($user_id, $roles)
    {
        if($this->deleteRoles($user_id, $roles))
            $this->addRoles($user_id, $roles);

        return 1;
    }

    /**
     * Delete roles.
     *
     * @param $user_id
     * @param $roles
     * @return mixed
     */
    public function deleteRoles($user_id, $roles)
    {

        return $this->db->delete('user_role', array('user_id' => $user_id));
    }

    /**
     * Delete role.
     *
     * @param $user_id
     * @param $role_id
     * @return mixed
     */
    public function deleteRole($user_id, $role_id)
    {

        return $this->db->delete('user_role', array('user_id' => $user_id, 'role_id' => $role_id));
    }

    /**
     * Find roles associated with user.
     *
     * @param $id
     * @return array
     */
    public function userWiseRoles($id)
    {
        return array_map(function($item){
            return $item["role_id"];
        }, $this->db->get_where("user_role", array("user_id" => $id))->result_array());
    }

    /**
     * Find role details associated with user.
     *
     * @param $id
     * @return array
     */
    public function userWiseRoleDetails($id)
    {
        return array_map(function($item){
            $user = new User();
            return $user->findRole($item);
        }, $this->userWiseRoles($id));
    }

    /**
     * Find role.
     *
     * @param $id
     * @return mixed
     */
    public function findRole($id)
    {
        return $this->db->get_where("role", array("id" => $id))->row(0);
    }

    public function reset_password()
    {
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $this->db->where(['id'=>$user_id]);
        $this->db->update('user',['password'=>md5($password)]);
    }

    public function change_status($id)
    {
        $user = $this->db->get_where('user',['id'=>$id])->row();
        $this->db->update('user',['status'=>$user->status==1?2:1],['id'=>$id]);
        
    }

    public function update_user_roles($roles,$user_id)
    {
        $this->db->delete('user_role',['user_id'=>$user_id]);
        foreach($roles as $item)
        {
            $this->db->insert('user_role',$item);
        } 
    }

    public function get_users_names($user_id)
    {
        return $this->db->select('employee.FirstName,employee.LastName,user.id')
                        ->from('employee')
                        ->join('user','user.employeeID=employee.id')
                        ->where('user.id<>'.$user_id)
                        ->where('status',1)
                        ->get()
                        ->result();
    }

    function get_employee_account($emp_id)
    {
        return $this->db->get_where('user',['EmployeeID'=>$emp_id])->row(0);
    }

}