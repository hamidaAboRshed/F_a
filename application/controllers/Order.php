<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{

    public function index()
	{
		$data=array("pageTitle"=>"Home page",
			"subview" =>"order.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
} 