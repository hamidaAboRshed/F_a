<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulation extends CI_Controller{

    
        function __construct()
        {
             parent::__construct();
        
            $this->load->database();
            $this->load->helper('url');
            $this->load->model('Regulation_model');
        }
    
        public function index()
        {
            $data['output'] = '';
            $array = array();
            $array['grid_header'] = array(
                'Hs_code',
                'Technical_regulation',
                'Category_name',
                'Schema'
               // 'qm'
            );
    
            $array['read_action'] = './Regulation/fetchRegulationsData/';
            $array['custom_modal_file'] = 'regulation_modal.php';
            $array['custom_modal_data'] = $data;
    
            $data['grid_body_data'] = $array;
            $data['subview'] = 'grid_view.php';
    
            $data['pageTitle'] = 'Regulations Table';
            $this->load->view('layouts/layout', $data);
        }
    
        function fetchRegulationsData()
        {
            $result = array('data' => array());
    
            $data = $this->Regulation_model->get_products();
    
            foreach ($data as $key => $value) {
                // button
                $buttons = '
                    <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu">';
                        //if(can(['employee_edit']))
                        {
                            $buttons.='<li><a type="button" class="" onclick="EditEmployee('.$value['ID'].')" data-toggle="modal" data-target="#EditEmployeeModal">Edit</a></li>';
                        }
                        //if(can(['employee_view']))
                        {
                            $buttons.='<li><a type="button" class="" onclick="ViewEmployee('.$value['ID'].')" data-toggle="modal" data-target="#ViewEmployeeModal">View</a></li>';
                        }
                        //if(can(['user_create']))
                        {
                            $buttons.='<li><a type="button" href="./User/create_user/'.$value['ID'].'" >Create account</a></li>';
                        }
                        
                        $buttons .= '
                    </ul>
                    </div>
                    ';
                $result['data'][$key] = array(
                    $value['hs_code'],
                    $value['technical_regulation_ar'],
                    $value['category_name_ar'],
                    $value['scheme']
                   // $buttons
                );
            }
            echo json_encode($result);
        }
    
        function fetchRegulationData($id)
        {
            $product = $this->Regulation_model->get_product($id);
            $product['Photo']= '';
            echo json_encode($product);
        }
    
       
    
       
    }