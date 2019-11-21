<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashBoard extends CI_Controller{

    public function DashF()
	{
		$data=array("title"=>"Dash page",
			"sub_view" =>"DashBoard.php"
		);
        $this->load->view('layouts/layout.php',$data);
    }
}