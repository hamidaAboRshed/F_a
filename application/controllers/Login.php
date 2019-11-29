<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    public function Log_page()
	{
		$data=array("pageTitle"=>"Home page",
			"subview" =>"Login.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
} 