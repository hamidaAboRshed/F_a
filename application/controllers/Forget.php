<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller{

    public function Forget_page()
	{
		$data=array("pageTitle"=>"Home page",
			"subview" =>"Forget.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
} 