<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->helper('string');
    }

    /**
     * handle the login.
     */
    public function login()
    {
        $data = array();

    
        if(get_cookie('userID'))
        {
            return redirect('Welcome');
        }
        if($_POST) {
            $data = $this->auth->login($_POST);
        }
 
        return $this->auth->showLoginForm($data);
    }

    /**
     * Logout.
     */
    public function logout()
    {
        if($this->auth->logout())
            return redirect('User/login');

        return false;
    }
    public function index () {
        if (!can(['user_view'])) {
			$this->session->set_userdata('error', 'you dont have permission to do that');
			//redirect('Welcome/index');
		}
        $data['output'] = '';
        $array = array();
        $array['grid_header'] = array(
            'Name',
            'Username',
            'Status ',
            'Type',
            'created_at',
            'updated_at',
            'Options'
        );

        $array['read_action'] = './User/fetchUsersData/';

        $array['custom_modal_file'] = "user_modal.php";
        $array['custom_modal_data'] = $data;

        $data['grid_body_data'] = $array;
        $data['subview'] = 'grid_view.php';
   
        $data['Roles']=$this->Role_model->all();
        $data['pageTitle'] = 'Users Table';
        $this->load->view('layouts/layout', $data);
    }

    public function fetchUsersData() {
        
        $result = array('data' => array());
        $users = $this->User_model->all();
        foreach($users as $key=>$value)
        {
                //  button
                $buttons = '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <button class="dropdown-item" type="button" onclick="Reset_Password('.$value['ID'].')" data-toggle="modal" data-target="#ResetPasswordModal">Reset Passwor</button>
                  <button class="dropdown-item" type="button" onclick="change_status('.$value['ID'].')">Change Status</button>
                  <button class="dropdown-item" type="button" onclick="update_user_roles('.$value['ID'].')" data-toggle="modal" data-target="#UserUpdateRolesModal">Set roles
                  </button>
                  </div>
              </div> 
                          ';

            
                 $result['data'][$key] = array(
                     ($value['CustomerID']!=null?$this->get_customer_name($value['CustomerID']):($value['EmployeeID']!=null?$this->get_employee_name( $value['EmployeeID']):NULL)),
                     $value['Username'],
                     $value['status'] == 1 ? 'active' : 'not active',
                     $value['EmployeeID']==null?($value['CustomerID']==null?' ':'Customer'):'Employee',
                     $value['created_at'],
                     $value['updated_at'],
                     $buttons
                 );
        }
        echo json_encode($result);
  
    }

    public function get_employee_name($id)
    {
        $employee = $this->db->get_where('employee',['id'=>$id])->row();
        if(!$employee)
        {
            show_404();
        }
        return $employee->FirstName.' '.$employee->LastName;
    }
    public function get_customer_name($id)
    {
        $customer = $this->db->get_where('customer',['id'=>$id])->row();
        if(!$customer)
        {
            show_404();
        }
        return $customer->FirstName.' '.$customer->LastName;
    }


    public function reset_password() 
    {
        if (!can(['user_view'])) {
			$this->session->set_userdata('error', 'you dont have permission to do that');
			redirect('Welcome/index');
		}
        $rules = array(
            array(
                'field'=>"password",
                'label'=>"password",
                "rules"=>"required|trim"
            ),
            array(
                'field'=>'password_confirmation',
                'label'=>'Password Confirmation',
                'rules'=>'required|trim|matches[password]'
            ),
            array(
                'field'=>'user_id',
                'label'=>'user id',
                'rules'=>'required|trim|numeric'
            )
        );
        $this->load->library('form_validation');
        $validator = array("success"=>false,"message"=>"");
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()==FALSE)
        {
            $validator['messages']="Error validation";
            $validator['success']=false;
            echo validation_errors();
        }
        else  {
            $this->User_model->reset_password();
            $validator['messages']="User password updated successfully";
            $validator['success']=TRUE;
        }

        echo json_encode($validator);
    }

    public function change_status() {
        $id = $this->input->get('id');
        $this->User_model->change_status($id);
        $validator = array('success'=>true,"messages"=>"user status updated successfully");
        echo json_encode($validator);
    }

    public function  get_user_roles()
    {
        $id = $this->input->get('id');
        $roles = $this->User_model->userWiseRoles($id);
        echo json_encode($roles);
    }

    public function update_user_roles() {
        $this->load->model('Role_model');
        $roles= $this->Role_model->all();
        $user_id = $this->input->post('user_id');
        $user_roles = array();
        foreach($roles as $key=>$value)
        {
          if($this->input->post($value->id))
          {
              $user_roles[$key]['role_id'] = $this->input->post($value->id);
              $user_roles[$key]['user_id'] =$user_id;
          }
        }
        
        $this->User_model->update_user_roles($user_roles,$user_id);
        $validator = array('success'=>true,'messages'=>"updated");
        echo json_encode($validator);
    }

    function create_user($emp_id)
	{
        /*if (!can(['user_create'])) {
			$this->session->set_userdata('error', 'you dont have permission to do that');
			redirect('Users/index');
		}*/
		$default_password='123456';
		$this->load->model('User_model');
		$this->load->model('Employee_model');
		$employee=$this->Employee_model->get_employee_by_id($emp_id);
        $username='';
        $account = $this->db->get_where('user',['EmployeeID'=>$emp_id])->row();
        if($account!= null)
        {
            $data['pageTitle'] = 'add user';
            $data['subview'] = 'empty_page';
            $data['result']='User already have account';
            $data['output']='';
            $this->load->view('layouts/layout.php',$data);
            return;
        }
		if($employee)
		{
			foreach ($employee as $row)
			{
				$username=$row->FirstName.'.'.$row->LastName;
			}
		}
		$username=str_replace(' ', '',$username);
		$user_data = array('Username' => $username,
				'Password' => md5($default_password),
				'Active' => true,
				'EmployeeID' =>$emp_id
				);

		$data['pageTitle'] = 'add user';
        $data['subview'] = 'empty_page';
        while($this->User_model->get_user_by_username($username))
        {
            $username=$username. random_string('numeric', 2);
        }
		if(!$this->User_model->get_user_by_username($username))
		{
            $user_data['Username']=$username;
			if($this->User_model->insert_data($user_data) >0)
			{
				$data['result']='Congratulations! user Added Successfully in system. <br /> Username :  '.$username.'<br /> Password :  '.$default_password;
			}
			else
				$data['result']='Error.';
		}
		$data['output']='';
		$this->load->view('layouts/layout.php',$data);
	}

    
	function change_password_form()
	{
		if($this->user_validate->check_login())
		{
			$data['subview'] = 'change_password';
			$data['output']='';
			$data['pageTitle']='change password'; 
			$data['bool']='';
			$data['string']="";
			$this->load->view('layouts/layout.php',$data); 
		}
	}

	function update_password()
	{
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
		$this->form_validation->set_rules('new_password_confirm','New Password Confrim',
		                      'required|trim|matches[new_password]');

		if($this->form_validation->run() == true)
	    {
			$this->load->model('User_model');
            $result = $this->User_model->is_User_password($this->input->post('old_password'));
            print($result);
			if($result) 
			{
				$user_data = array(	'Password' => md5($this->input->post('new_password_confirm')));
				$this->User_model->update_user($user_data);
				redirect(site_url('Welcome/index'));
				
			}
			else
			{
				$data['bool']=true;
				$data['string']="wrong old password,try again";
				$data['subview'] = 'change_password';
				$data['output']='';
				$data['pageTitle']='change password';   
				$this->load->view('layouts/layout.php',$data);
			}
		}
	  	else
		{
			$data['bool']=false;
			$data['subview'] = 'change_password';
			$data['output']='';
			$data['pageTitle']='change password';   
			$this->load->view('layouts/layout.php',$data);
		}	
    }
    
    public function get_users_names($user_id)
    {
        echo json_encode($this->User_model->get_users_names($user_id));
    }
}