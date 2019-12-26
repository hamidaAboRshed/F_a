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
			'Address',
			'Status ',
			'Options'
		);

		$array['read_action'] = './Customer/fetchCustomersData/';
		$array['custom_modal_file'] = 'Customer_modal.php';
		$array['custom_modal_data'] = $data;

		$data['grid_body_data'] = $array;
		$data['subview'] = 'grid_view.php';

		//$data['Customer']=$this->Customer_model->all();
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

				<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
				<button class="dropdown-item" type="button" onclick="EditCustomer('.$value['ID'].')" data-toggle="modal" data-target="#EditCustomerModal">Edit</button>
				<button class="dropdown-item" type="button" onclick="ViewCustomer('.$value['ID'].')" data-toggle="modal" data-target="#ViewCustomerModal">View</button>
				<a class="dropdown-item" type="button" href="./User/create_user/'.$value['ID'].'" >Create account</a>
				</button>
				</div>
			</div> 
				';
			$result['data'][$key] = array(
				$value['FirstName'],
				$value['LastName'],
				$value['address'],
				$value['status']  == 1 ? 'active' : 'not active',
				$buttons
			);
		}
		echo json_encode($result);
	}

	function fetchCustomerData($id)
	{
		$customer = $this->Customer_model->get_customer($id);
		
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
				'field' => "address",
				'label' => "address",
				'rules' => "required|trim")

		);
		$this->load->library('form_validation');
		$this->form_validation->set_rules($rules);
		$validatore = array('success' => false,"message"=>array());
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == false) 
			{
				$validator['success']=false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);
				}
			}
		  else {
			
			$customer = array(
				'FirstName' => $this->input->post('first_name'),
				'LastName' => $this->input->post('last_name'),
				'address' => $this->input->post('address')
				
			);
			$this->Customer_model->insert($customer);
			$validatore['success']=true;
			$validatore['messages']="Customer added successfully";
		}
		echo json_encode($validatore);
	}

	function edit_customer()
	{
		$rules = array(
			array(
				'field' => "first_name",
				'label' => "First Name",
				'rules' => "required|trim"
			),
			array(
				'field' => "last_name",
				'label' => "Last Name",
				'rules' => "required|trim"
			),
			array(
					'field' => "address",
					'label' => "address",
					'rules' => "required|trim"
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
			$customer = array(
				'First Name' => $this->input->post('first_name'),
				'Last Name' => $this->input->post('last_name'),
				'address' => $this->input->post('address')
			);
			$this->Customer_model->update($customer,$this->input->post('id'));
			$validatore['success']=true;
			$validatore['messages']="Customer updated successfully";
		}
		echo json_encode($validatore);
	}
}
