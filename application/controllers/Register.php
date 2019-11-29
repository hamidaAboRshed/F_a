<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{

    public function Register_page()
	{
		$data=array("pageTitle"=>"Home page",
			"subview" =>"Register.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
} 