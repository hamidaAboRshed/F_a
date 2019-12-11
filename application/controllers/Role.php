<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Role_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['output'] = '';
        $array = array();
        $array['grid_header'] = array(
            'name',
            'display_name',
            'description',
            'status ',
            'created_at',
            'updated_at',
            'Options'
        );

        $array['read_action'] = './Role/fetchRolesData/';

        $array['custom_modal_file'] = "role_grid";
        $array['custom_modal_data'] = $data;

        $data['grid_body_data'] = $array;
        $data['subview'] = 'grid_view.php';
        $data['permissions']=$this->get_permissions();
 
        // add breadcrumbs
        //$this->breadcrumbs->push('Roles', '/Role/index');

        // output
       // $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['pageTitle'] = 'Roles Table';
        $this->load->view('layouts/layout', $data);
    }

    public function fetchRolesData()
    {
        $result = array('data' => array());

        $data = $this->Role_model->get_all();

        foreach ($data as $key => $value) {

            // button
            $buttons = '
            <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <button class="dropdown-item" type="button" onclick="update_role_modal('.$value['ID'].')" data-toggle="modal" data-target="#editRoleModal">Edit</button>
    <button class="dropdown-item" type="button" onclick="update_role_permissions('.$value['ID'].')" data-toggle="modal" data-target="#RoleUpdatePermissionModal">Permissions</button>
  </div>
</div> 
			';


            $result['data'][$key] = array(
                $value['name'],
                $value['display_name'],
                $value['description'],
                $value['status'] == 1 ? 'active' : 'not active',
                $value['created_at'],
                $value['updated_at'],
                $buttons
            );
        }
        echo json_encode($result);
    }
    
    public function create_role()
    {
        $rules = array(
            array(
                'field' => 'RoleName',
                'label' => 'RoleName',
                'rules' => 'required'
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required'
            ),

        );
        $validator = array('success' => TRUE, 'messages' => array());
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()==FALSE)
        {
            $validator['messages']="Error not validate";
            $validator['success']=false;
        }
        else {
            $data = array(
                "name"=>$this->input->post('RoleName'),
                "display_name"=>$this->input->post('DisplayName'),
                "description"=>$this->input->post('Description'),
                "status"=>$this->input->post('status'),
                "created_at"=>date('Y-m-d H:i:s')
            );
            $this->Role_model->insert_role($data);
            $validator['messages']="Roled added successfully";
            $validator['success']=TRUE;
        }
       
        echo json_encode($validator);
    }

    public function get_role()
    {
        $id = $this->input->get('id');
        $role = $this->Role_model->get_role_array($id);
        echo json_encode($role->result_array());
    }

    public function edit_role()
    {
        $rules = array(
            array(
                'field' => 'RoleName',
                'label' => 'RoleName',
                'rules' => 'required'
            ),

            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required'
            ),
        );
        $validator = array('success' => true, 'messages' => array());
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()==FALSE)
        {
            $validator['messages']="Error not valid";
            $validator['success']=false;
        }
        else 
        {
            $data = array(
                "name"=>$this->input->post('RoleName'),
                "display_name"=>$this->input->post('DisplayName'),
                "description"=>$this->input->post('Description'),
                "status"=>$this->input->post('status'),
                "created_at"=>date('Y-m-d H:i:s'),
                "id"=>$this->input->post("id")
            );
            $this->Role_model->update_role($data);
            $validator['messages']="Roled updated successfully";
            $validator['success']=true;
        }
       
        echo json_encode($validator);
    }

    public function get_role_permissions()
    {
        $role_id  = $this->input->get('role_id');
        $role = $this->Role_model->get_role($role_id);
        if(!$role)
        {
            show_404();
        }
        $permissions = $this->db->get_where('role_permission',['role_id'=>$role_id]);
        echo json_encode($permissions->result());
    }

    public function update_role_permissions()
    {
        $role_id  = $this->input->post('role_id');
        $role = $this->Role_model->get_role($role_id);
        if(!$role)
        {
            show_404();
        }
        $permissions = $this->get_permissions();
        $role_permissions = array();
        foreach($permissions as $key=>$value)
        {
          
            if($this->input->post($value->id))
            {
                
                $role_permissions[$key]['role_id']=$role_id;
                $role_permissions[$key]['permission_id']=$this->input->post($value->id);
            }
        }
        $this->Role_model->update_role_permissions($role_permissions,$role_id);
        $validator = array('success'=>true,'messages'=>"done");
        echo json_encode($validator);
    }
    public function get_permissions()
    {
        $permissions = $this->db->get('permission')->result();
        return $permissions;
    }
}
