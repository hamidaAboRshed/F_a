<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller{

    public function Add_Activity()
	{
		$data=array("title"=>"Home page",
			"sub_view" =>"Active.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
} 