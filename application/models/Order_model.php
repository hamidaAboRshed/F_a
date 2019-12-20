<?php

class Order_model extends CI_Model {

	
	function get_orders()
	{
		$this->db->select('order.ID as order_ID,order.*');
		$this->db->from('order');
		return $this->db->get()->result_array();
	}

	// function insert($employee)
	// {
	// 	$this->db->insert('employee',$employee);
	// }

	function get_order($id)
	{
		return $this->db->get_where('order',['ID'=>$id])->row_array();
	}

	// function update_product($product)
	// {
	// 	$this->db->where(['ID'=>$this->input->post('id')]);
	// 	$this->db->update('product',$product);
	// }
    function get_order_by_id($ord_id)
	{
		//$this->db->select('FirstName,LastName');
		$this->db->where('ID ',$ord_id);
		$this->db->from('order');
		$query=$this->db->get();
		return $query->result();
	}



    function update($data)
    {
    	$this->db->where('ID', get_cookie('emp_id'));
    	$this->db->update('order', $data);
	}
	
	function get_all_orders()
	{
	   $products=	$this->db->select('order.*')
						->from('order')
						//->join('user','user.EmployeeID=employee.ID')
						//->where('user.status',1)
						->order_by('order.ID','ACS')
						->get()
						->result();
		 return $products;
	}
}