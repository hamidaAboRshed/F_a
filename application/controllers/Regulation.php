<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulation extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Role_model');
        $this->load->library('form_validation');
    }

        public function index()
    {
        $data['output'] = '';
        $array = array();
        $array['grid_header'] = array(
            'name',
            'display_name',
            'description',
            'status ',
            'created_at',
            'updated_at',
            'Options'
        );

        $array['read_action'] = './Role/fetchRolesData/';

        $array['custom_modal_file'] = "role_grid";
        $array['custom_modal_data'] = $data;

        $data['grid_body_data'] = $array;
        $data['subview'] = 'grid_view.php';
        $data['permissions']=$this->get_permissions();
 
        // add breadcrumbs
        //$this->breadcrumbs->push('Roles', '/Role/index');

        // output
       // $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['pageTitle'] = 'Roles Table';
        $this->load->view('layouts/layout', $data);
    }


} 