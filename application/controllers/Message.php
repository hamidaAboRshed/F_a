<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    public function __construct()
    {
     parent::__construct();
     $this->load->model('Message_model');
     $this->load->model('User_model');
     $this->load->model('Employee_model');
     $this->load->library('EmailSend');
     $this->load->library('pagination');
    }

    public function table_view($limit=1)
    {
        $data['output'] = '';
			$data['subview'] = 'Message.php';
            $data['pageTitle']='Messages Table';
            $data['messages']=$this->Message_model->get_all_limit(get_cookie('user_id'),$limit);
            $config['base_url'] = base_url().'index.php/message/table_view';
            $config['total_rows'] = $this->Message_model->get_count(get_cookie('user_id'));
            $config['per_page'] = 10;

$this->pagination->initialize($config);
			$this->load->view('layouts/layout',$data);
    }
    public function index() {
		$data['output'] = '';
			$array = array();
			$array['grid_header'] = array(
				'Subject' ,
				'body',
				'from' ,
				'date',
				'Options');

			$array['read_action'] = '../Message/fetchMessagesData/';
			$data['Language']=$this->Index_model->get_index('language');
			$array['custom_modal_file'] = 'modal/message_modal.php';
			$array['custom_modal_data'] = $data;

			$data['grid_body_data']= $array;
			$data['subview'] = 'grid_view.php';
			
			// add breadcrumbs
			$this->breadcrumbs->push('Messages', '/Message/index');

			// output
			$data['breadcrumb'] = $this->breadcrumbs->show();
			$data['pageTitle']='Messages Table';
			$this->load->view('layouts/layout',$data);
	}


	public function fetchMessagesData()
	{
		$result = array('data' => array());
		
		$data = $this->Message_model->get_all(get_cookie('user_id'));	
		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu">'.
				'<li><a type="button" class="" onclick="show_message('.$value['ID'].')" data-toggle="modal" data-target="#MessageModal">Show</a></li>';
			    $buttons.='
			  </ul>
			</div>
			';
			
			$name = empty($value['FirstName'])?$value['Username']:$value['FirstName'].' '.$value['LastName'];
			$result['data'][$key] = array(	
				$value['subject'],
				substr($value['body'],0,120).'....',
				$name,
				$value['date'],
				$buttons);
		} 
		echo json_encode($result);
	}

    public function get_messages($user_id)
    {
        if($user_id==null) 
        {
            return false;
        }
        $messages = $this->Message_model->get($user_id);
        echo json_encode($messages);
    }
    public function get_message($id)
    {
        $user_id = get_cookie('user_id');
        if($user_id==null) 
        {
            return false;
        }
        $messages = $this->Message_model->get_message($id,$user_id);
        echo json_encode($messages);
    }

    public function  create()
    {
        $rules = array(
            array(
                'field'=>'subject',
                'label'=>'Subject',
                'rules'=>'required'
            ),
            array(
                'field'=>'reciever[]',
                'label'=>'reciever',
                'rules'=>'required'
            )
            );
        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);
        $validatore = array('success'=>false,'messages'=>'');
        if($this->form_validation->run()==false)
        {
            $validatore['messages']=validation_errors();
            echo json_encode($validatore);
        }
        else 
        {
            $message = array(
                'subject'=>$this->input->post("subject"),
                'body'=>$this->input->post('body'),
                'user_id'=>get_cookie('user_id'),
            );
            $users = $this->input->post('reciever');
            $this->Message_model->insert($message,$users);
            $validatore['success']=true;
            $validatore['messages']='Message sent successfully';
            if($this->input->post('via_email'))
            {
                $user = $this->User_model->find(get_cookie('user_id'));
                if($user && $user->EmployeeID)
                {
                    $employee = $this->Employee_model->get_employee($user->EmployeeID);
                    foreach($users as $key=>$value)
                    {
                        $reciever = $this->User_model->find($value);
                        $reciever_info = $this->Employee_model->get_employee($reciever->EmployeeID);
                        if($reciever_info && $reciever_info['Email'])
                        {
                            $this->emailsend->send($employee['Email'] , $reciever_info['Email'], $message['subject'],'',$message['body']);
                    
                        }
                    }
                  
                }
               
            }            
        }
        echo json_encode($validatore);
    }

    public function read($id)
    {
        $user_id = get_cookie('user_id');
        if($user_id == null)
        {
            return false;
        }
        $this->Message_model->read($id,$user_id);
    }
}