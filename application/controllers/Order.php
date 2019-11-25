<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{

    public function index()
	{
		$data=array("title"=>"Home page",
			"sub_view" =>"order.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
} 