<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Customer extends CI_Controller {

	function __construct()
	{
			parent::__construct();
	
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Customer_model');
	}

	public function index()
	{
		$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'First_name',
			'Last_name',
			'Phone',
			'Company',
			'Email ',
			'Address'
		);

		$array['read_action'] = './Customer/fetchCustomersData/';
		$array['custom_modal_file'] = 'Customer_modal.php';
		$array['custom_modal_data'] = $data;

		$data['grid_body_data'] = $array;
		$data['subview'] = 'grid_view.php';

		$data['pageTitle'] = 'Customers Table';
		$this->load->view('layouts/layout', $data);
	}

	function fetchCustomersData()
	{
		$result = array('data' => array());

		$data = $this->Customer_model->get_customers();

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
				$value['Phone'],
				$value['Company'],
				$value['Email'],
				$value['address']
				
			);
		}
		echo json_encode($result);
	}

	function fetchCustomerData($id)
	{
		$customer = $this->Customer_model->get_customer($id);
		$customer['Photo']= '';
		echo json_encode($customer);
	}

	function add_customer()
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
			
			$customer = array(
				'FirstName' => $this->input->post('first_name'),
				'LastName' => $this->input->post('last_name'),
				'Phone' => $this->input->post('phone'),
				'Company' => $this->input->post('company'),
				'Email' => $this->input->post('email'),
				'Address' => $this->input->post('address')
				
				
			);
			$this->Customer_model->insert($customer);
			$validatore['success']=true;
			$validatore['messages']="Customer added successfully";
		}
		echo json_encode($validatore);
	}

}