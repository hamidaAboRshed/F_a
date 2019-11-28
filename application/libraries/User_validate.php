<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class user_validate {

    function __construct()
    {
        
    }

    public function check_login()
    {
        $CI =& get_instance();
        //load libraries
        $CI->load->database();
        $CI->load->library(["session","auth"]);
        
        if(check())
        {
            return true;
        }
        else
        {
            redirect('/Users/login', 'refresh');
        }
            
    }
}