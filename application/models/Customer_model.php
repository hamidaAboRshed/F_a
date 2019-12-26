<?php

class Customer_model extends CI_Model {

	
	function get_customers()
	{
		$this->db->select('customer.ID as customer_ID,customer.*');
		$this->db->from('customer');
		return $this->db->get()->result_array();
	}

	function insert($customer)
	{
		$this->db->insert('customer',$customer);
	}

	function get_customer($id)
	{
		return $this->db->get_where('customer',['ID'=>$id])->row_array();
	}

    // 
    
	function get_customer_by_id($emp_id)
	{
		//$this->db->select('FirstName,LastName');
		$this->db->where('ID ',$emp_id);
		$this->db->from('customer');
		$query=$this->db->get();
		return $query->result();
	}

    function update($data,$customer_id)
    {
    	$this->db->where('ID', $customer_id);
    	$this->db->update('customer', $data);
	}
	
	function get_all_customers()
	{
	   $customers=	$this->db->select('customer.*')
						->from('customer')
					//	->join('user','user.CustomerID=customer.ID')
					//	->where('user.status',1)
						->order_by('customer.ID','ACS')
						->get()
						->result();
		 return $customers;
	}
}