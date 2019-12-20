<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Customer extends CI_Controller {

	function __construct()
	{
			parent::__construct();
	
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Certification_model');
    }
    
}