<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Employee extends CI_Controller {

	function __construct()
	{
			parent::__construct();
	
		$this->load->database();
		$this->load->model('Employee_model');
	}

	public function index()
	{
		$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'First name',
			'Last name',
			'Mobile Phone',
			'Email',
			'Options'
		);

		$array['read_action'] = './Employee/fetchEmployeesData/';
		$array['custom_modal_file'] = 'employee_modal.php';
		$array['custom_modal_data'] = $data;

		$data['grid_body_data'] = $array;
		$data['subview'] = 'grid_view.php';

		$data['pageTitle'] = 'Employees Table';
		$this->load->view('layouts/layout', $data);
	}

	function fetchEmployeesData()
	{
		$result = array('data' => array());

		$data = $this->Employee_model->get_employees();

		foreach ($data as $key => $value) {
			// button
			$buttons = '
				<div class="btn-group">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Action <span class="caret"></span>
				</button>

				<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <button class="dropdown-item" type="button" onclick="EditEmployee('.$value['ID'].')" data-toggle="modal" data-target="#EditEmployeeModal">Edit</button>
                  <button class="dropdown-item" type="button" onclick="ViewEmployee('.$value['ID'].')" data-toggle="modal" data-target="#ViewEmployeeModal">View</button>
                  <a class="dropdown-item" type="button" href="./User/create_user/'.$value['ID'].'" >Create account</a>
                  </button>
                  </div>
              </div> 
                          ';
				
			$result['data'][$key] = array(
				$value['FirstName'],
				$value['LastName'],
				$value['MobilePhone'],
				$value['Email'],
				$buttons
			);
		}
		echo json_encode($result);
	}

	function fetchEmployeeData($id)
	{
		$employee = $this->Employee_model->get_employee($id);
		$employee['Photo']= '';
		echo json_encode($employee);
		
	}

	function add_employee()
	{
		$rules = array(
			array(
				'field' => "first_name",
				'label' => "First name",
				'rules' => "required|trim"
			),
			array(
				'field' => "last_name",
				'label' => "Last name",
				'rules' => "required|trim"
			),
			array(
				'field' => "gender",
				'label' => "Gender",
				'rules' => "required|trim"
			),
			array(
				'field' => "email",
				'label' => "email",
				'rules' => "required|trim|valid_email"
			)
		);
		
		$this->form_validation->set_rules($rules);
		$validatore = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == false) 
		{
			$validatore['success'] = false;
			foreach ($_POST as $key => $value) {
				$validatore['messages'][$key] = form_error($key);
			}
		} else {
			
			$employee = array(
				'FirstName' => $this->input->post('first_name'),
				'LastName' => $this->input->post('last_name'),
				'MobilePhone' => $this->input->post('mobile_phone'),
				'Email' => $this->input->post('email'),
				'DateOfBirth' => $this->input->post('birthday'),
				'Gender' => $this->input->post('gender'),
				'Address' => $this->input->post('address')
			);
			$this->Employee_model->insert($employee);
			$validatore['success']=true;
			$validatore['messages']="Employee added successfully";
		}
		echo json_encode($validatore);
	}

	function edit_employee()
	{
		$rules = array(
			array(
				'field' => "first_name",
				'label' => "First name",
				'rules' => "required|trim"
			),
			array(
				'field' => "last_name",
				'label' => "Last name",
				'rules' => "required|trim"
			),
			array(
					'field' => "gender",
					'label' => "Gender",
					'rules' => "required|trim"
					),
			array(
				'field' => "email",
				'label' => "email",
				'rules' => "required|trim|valid_email"
				),
		);

		$this->form_validation->set_rules($rules);
		$validatore = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == false)
		 {
			$validatore['success'] = false;
			foreach ($_POST as $key => $value) {
				$validatore['messages'][$key] = form_error($key);
			}
		} else {
		
			$image=null;
			$employee = array(
				'FirstName' => $this->input->post('first_name'),
				'LastName' => $this->input->post('last_name'),
				'MobilePhone' => $this->input->post('mobile_phone'),
				'Email' => $this->input->post('email'),
				'DateOfBirth' => $this->input->post('birthday'),
				'Gender' => $this->input->post('gender'),
				'Address' => $this->input->post('address')
			);
			if($image!=null)
			{
				$employee['Photo']=$image;
			}
			$this->Employee_model->update_employee($employee);
			$validatore['success']=true;
			$validatore['messages']="Employee updated successfully";
		}
		echo json_encode($validatore);
	}
}