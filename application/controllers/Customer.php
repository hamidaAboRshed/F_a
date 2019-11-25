<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller{

    public function index()
	{
		$data=array("title"=>"Home page",
			"sub_view" =>"custom.php"
		);
		$this->load->view('layouts/layout.php',$data);
		// $data=array("title"=>"Home page",
		// 	"sub_view" =>"Home.php"
		// );
		// $this->load->view('layouts/layout2.php',$data);
	}
	

} 