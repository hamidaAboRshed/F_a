<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{

	function __construct()
	{
			parent::__construct();
	
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Order_model');
	}

    public function index()
	{$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'Type',
			'Customer_id',
			'Customer_product_id',
			'Serial_num',
			'Code',
			'Created_date',
			'Status'
		);

		$array['read_action'] = './Order/fetchOrdersData/';
		$array['Order_modal_file'] = 'Order_modal.php';
		$array['Order_modal_data'] = $data;

		$data['grid_body_data'] = $array;
		$data['subview'] = 'grid_view.php';

		$data['pageTitle'] = 'Customers Table';
		$this->load->view('layouts/layout', $data);
	}

	function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->Order_model->get_orders();

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
						$buttons.='<li><a type="button" class="" onclick="EditOrder('.$value['ID'].')" data-toggle="modal" data-target="#EditOrderModal">Edit</a></li>';
					}
					//if(can(['employee_view']))
					{
						$buttons.='<li><a type="button" class="" onclick="ViewOrder('.$value['ID'].')" data-toggle="modal" data-target="#ViewOrderModal">View</a></li>';
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
				$value['Type'],
				$value['Customer_id'],
				$value['Customer_product_id'],
				$value['Serial_num'],
				$value['Code'],
				$value['Created_date'],
				$value['Status']
				
			);
		}
		echo json_encode($result);
	}

	function fetchOrderData($id)
	{
		$order = $this->Order_model->get_order($id);
		$order['Photo']= '';
		echo json_encode($order);
	}

	function add_order()
	{
		$rules = array(
			array(
				'field' => "type",
				'label' => "Type",
				'rules' => "required|trim",
				'errors' => array(
					'required' => 'Type required'
				)
			),
			array(
				'field' => "customer_id",
				'label' => "Customer_id",
				'rules' => "required|trim",
				'errors' => array(
					'required' => 'Customer_id required'
				)
			),
			array(
				'field' => "customer_product_id",
				'label' => "Customer_product_id",
				'rules' => "required|trim",
				'errors' => array(
					'required' => 'Customer_product_id required',
				//	'valid_email' => "You have to enter valid email"
				)
			)

		);

		$this->form_validation->set_rules($rules);
		$validatore = array('success' => false, 'messages' => '');
		if ($this->form_validation->run() == false) {
			$validatore['success'] = false;
			$validatore['messages'] = validation_errors();
		} else {
			
			$order = array(
				'Type' => $this->input->post('type'),
				'Customer_id' => $this->input->post('customer_id'),
				'Customer_product_id' => $this->input->post('Customer_product_id'),
				'Serial_Num' => $this->input->post('Serial_num'),
				'Code' => $this->input->post('code'),
				'Created_Date' => $this->input->post('Created_date')
				
				
			);
			$this->Customer_model->insert($order);
			$validatore['success']=true;
			$validatore['messages']="Order added successfully";
		}
		echo json_encode($validatore);
	}

}