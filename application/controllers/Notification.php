<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->library('notification_lib');
		$this->load->library('pagination');
    }

    public function get_notifications()
    {
        $user_id  = get_cookie('user_id');
        echo json_encode($this->notification_lib->get_notifications($user_id));
    }

    public function get_notification($id)
    {
        echo json_encode($this->notification_lib->get_notification($id));
    }

    public function read($id)
    {
        $user_id = get_cookie('user_id');
        $this->notification_lib->read($id,$user_id);
    }

    public function index() {
		$data['output'] = '';
			$array = array();
			$array['grid_header'] = array(
				'title' ,
				'desc',
				'date',
				'Options');

			$array['read_action'] = '../Notification/fetchNotificatiosData/';
			$array['custom_modal_file'] = 'modal/notification_modal.php';
			$array['custom_modal_data'] = $data;

			$data['grid_body_data']= $array;
			$data['subview'] = 'grid_view.php';
			
			// add breadcrumbs
			$this->breadcrumbs->push('Notification', '/Notification/index');

			// output
			$data['breadcrumb'] = $this->breadcrumbs->show();
			$data['pageTitle']='Notifications Table';
			$this->load->view('layouts/layout',$data);
	}


	public function fetchNotificatiosData()
	{
		$result = array('data' => array());
		
		$data =$this->notification_lib->get_all_notifications(get_cookie('user_id'));	
		foreach ($data as $key=>$value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu">'.
				'<li><a type="button" class="" onclick="show_notification('.$value->ID.')" data-toggle="modal" data-target="#NotificationModal">Show</a></li>';
			    $buttons.='
			  </ul>
			</div>
			';
			
			$result['data'][$key] = array(	
				$value->title,
				substr($value->description,0,120).'....',
				$value->date,
				$buttons);
		} 
		echo json_encode($result);
	}

	public function table_view($limit=0)
    {
        $data['output'] = '';
			$data['subview'] = 'Notification.php';
            $data['pageTitle']='Notifications Table';
            $data['notifications']=$this->Notification_model->get_notifications(get_cookie('user_id'),$limit);
            $config['base_url'] = base_url().'index.php/notification/table_view';
            $config['total_rows'] = $this->Notification_model->get_count(get_cookie('user_id'));
            $config['per_page'] = 10;

		$this->pagination->initialize($config);
		$this->load->view('layouts/layout',$data);
    }
	
}