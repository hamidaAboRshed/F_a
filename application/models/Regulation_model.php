<?php

class Regulation_model extends CI_Model {

	// function get_products()
	// {
	// 	$this->db->select('product.ID as product_ID,product.*');
	// 	$this->db->from('product');
	// 	return $this->db->get()->result_array();
	// }
	function get_products_Ar()
	{
		$this->db->select('product.ID as product_ID, product.technical_regulation_ar as technical_regulation, product.category_name_ar as category_name, product.*');
		$this->db->from('product');
		return $this->db->get()->result_array();
	}

	function get_products_En()
	{
		$this->db->select('product.ID as product_ID, product.technical_regulation_en as technical_regulation, product.category_name_en as category_name, product.*');
		$this->db->from('product');
		return $this->db->get()->result_array();
	}

	// function insert($employee)
	// {
	// 	$this->db->insert('employee',$employee);
	// }

	function get_product($id)
	{
		return $this->db->get_where('product',['ID'=>$id])->row_array();
	}

	// function update_product($product)
	// {
	// 	$this->db->where(['ID'=>$this->input->post('id')]);
	// 	$this->db->update('product',$product);
	// }
    function get_product_by_id($prd_id)
	{
		//$this->db->select('FirstName,LastName');
		$this->db->where('ID ',$prd_id);
		$this->db->from('product');
		$query=$this->db->get();
		return $query->result();
	}

    function update($data)
    {
    	$this->db->where('ID', get_cookie('emp_id'));
    	$this->db->update('product', $data);
	}
	
	function get_all_products()
	{
	   $products=	$this->db->select('product.*')
						->from('product')
						//->join('user','user.EmployeeID=employee.ID')
						//->where('user.status',1)
						->order_by('product.ID','ACS')
						->get()
						->result();
		 return $products;
	}
}