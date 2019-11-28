<?php 

class Notification_lib  {

    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->library(["session","auth"]);
        $this->CI->load->model('User_model');
        $this->CI->load->model('Employee_model');
        $this->CI->load->model('Notification_model');
        $this->CI->load->library('EmailSend');
    }

    public function notify($title,$desc,$type,$stage,$user_id)
    {
        $data = array(
            'title'=>$title,
            'description'=>$desc,
            'type'=>$type,
            'user_id'=>$user_id
        );

        $this->CI->Notification_model->send_notification($data,$stage);
    }

    public function notify_user($title,$desc,$type,$reciver_id,$user_id)
    {
        $data = array(
            'title'=>$title,
            'description'=>$desc,
            'type'=>$type,
            'user_id'=>$user_id
        );
        $this->CI->Notification_model->send_user_notification($data,$reciver_id);
    }

    public function  get_notifications($user_id)
    {
        if(!$user_id)
        {
            return false;
        }
       
       return $this->CI->Notification_model->get_notifications($user_id);
    }

    public function  get_all_notifications($user_id)
    {
        if(!$user_id)
        {
            return false;
        }
        return $this->CI->Notification_model->get_all_notifications($user_id);
    }
    public function get_notification($id)
    {
        $notificaion = $this->CI->db->get_where('notification',['ID'=>$id])->row(0);
        return $notificaion;
    }

    public function read($id,$user_id)
    {
        $data = array('is_read'=>true);
       $this->CI->Notification_model->read($data,$user_id,$id);
    }
}