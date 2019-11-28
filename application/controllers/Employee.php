<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Employee extends CI_Controller {

	function __construct()
	{
			parent::__construct();
	
		$this->load->database();
		$this->load->helper('url');
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
			'Email ',
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
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Action <span class="caret"></span>
				</button>
					<ul class="dropdown-menu">';
					//if(can(['employee_edit']))
					{
						$buttons.='<li><a type="button" class="" onclick="EditEmployee('.$value['ID'].')" data-toggle="modal" data-target="#EditEmployeeModal">Edit</a></li>';
					}
					//if(can(['employee_view']))
					{
						$buttons.='<li><a type="button" class="" onclick="ViewEmployee('.$value['ID'].')" data-toggle="modal" data-target="#ViewEmployeeModal">View</a></li>';
					}
					//if(can(['user_create']))
					{
						$buttons.='<li><a type="button" href="./User/create_user/'.$value['ID'].'" >Create account</a></li>';
					}
					
					$buttons .= '
				</ul>
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
				'rules' => "required|trim",
				'errors' => array(
					'required' => 'First name required'
				)
			),
			array(
				'field' => "last_name",
				'label' => "Last name",
				'rules' => "required|trim",
				'errors' => array(
					'required' => 'Last name required'
				)
			),
			array(
				'field' => "email",
				'label' => "email",
				'rules' => "required|trim|valid_email",
				'errors' => array(
					'required' => 'Email required',
					'valid_email' => "You have to enter valid email"
				)
			)

		);

		$this->form_validation->set_rules($rules);
		$validatore = array('success' => false, 'messages' => '');
		if ($this->form_validation->run() == false) {
			$validatore['success'] = false;
			$validatore['messages'] = validation_errors();
		} else {
			
			$employee = array(
				'FirstName' => $this->input->post('first_name'),
				'LastName' => $this->input->post('last_name'),
				'FatherName' => $this->input->post('father_name'),
				'Email' => $this->input->post('email'),
				'MobilePhone' => $this->input->post('mobile'),
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
				'rules' => "required|trim",
				'errors' => array(
					'required' => 'First name required'
				)
			),
			array(
				'field' => "last_name",
				'label' => "Last name",
				'rules' => "required|trim",
				'errors' => array(
					'required' => 'Last name required'
				)
			),
			array(
				'field' => "email",
				'label' => "email",
				'rules' => "required|trim|valid_email",
				'errors' => array(
					'required' => 'Email required',
					'valid_email' => "You have to enter valid email"
				)
			)

		);

		$this->form_validation->set_rules($rules);
		$validatore = array('success' => false, 'messages' => '');
		if ($this->form_validation->run() == false) {
			$validatore['success'] = false;
			$validatore['messages'] = validation_errors();
		} else {
			$image=null;
			$employee = array(
				'FirstName' => $this->input->post('first_name'),
				'LastName' => $this->input->post('last_name'),
				'FatherName' => $this->input->post('father_name'),
				'Email' => $this->input->post('email'),
				'MobilePhone' => $this->input->post('mobile'),
				'DateOfBirth' => $this->input->post('birthday'),
				'Gender' => $this->input->post('gender'),
				'Address' => $this->input->post('address'),
			);
			if($image!=null)
			{
				$employee['Photo']=$image;
			}
			$this->Employee_model->update_employee($employee);
			$validatore['success']=true;
			$validatore['messages']="Employee added successfully";
		}
		echo json_encode($validatore);
	}
}