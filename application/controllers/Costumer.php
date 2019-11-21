<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costumer extends CI_Controller{

    public function costumF()
	{
		$data=array("title"=>"Home page",
			"sub_view" =>"costum.php"
		);
		$this->load->view('layouts/layout.php',$data);
		// $data=array("title"=>"Home page",
		// 	"sub_view" =>"Home.php"
		// );
		// $this->load->view('layouts/layout2.php',$data);
	}
	

} 