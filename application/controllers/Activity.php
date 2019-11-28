<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller{

    public function add_activity()
	{
		$data=array("pageTitle"=>"Add Activity",
			"subview" =>"Active.php"
		);
		$this->load->view('layouts/layout.php',$data);
	}
} 