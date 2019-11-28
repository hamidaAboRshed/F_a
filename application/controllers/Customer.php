<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller{

    public function index()
	{
		$data=array("pageTitle"=>"Home page",
			"subview" =>"custom.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
	

} 