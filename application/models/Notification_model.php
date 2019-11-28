<?php 


class Notification_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function send_notification($data,$stage)
    {
        $this->db->insert('notification',$data);
        $notification_id = $this->db->insert_id();
        $stage = $this->db->get_where('stage',['name'=>$stage])->row(0);
        $stage_users = $this->db->get_where('stage_user',['stage_id'=>$stage->next_stage_id])->result();
        foreach($stage_users as $user )
        {
            $data = array(
                'user_id'=>$user->user_id,
                'notification_id'=>$notification_id
            );
            $this->db->insert('user_notification',$data);
        }
    }

    public function send_user_notification($data,$reciver_id)
    {
        $this->db->insert('notification',$data);
        $notification_id = $this->db->insert_id();
        $data = array(
            'user_id'=>$reciver_id,
            'notification_id'=>$notification_id
        );
        $this->db->insert('user_notification',$data);
    }

    public function get_notifications($user_id,$limit=0)
    {
        $notificaions = $this->db->select('notification.*,user_notification.is_read')
        ->from('notification')
        ->join('user_notification','notification.ID=user_notification.notification_id and user_notification.user_id='.$user_id)
        ->where('notification.user_id<>'.$user_id)
        ->order_by('ID','desc')
        ->limit(10,$limit)
        ->get()
        ->result();
        return $notificaions;
    }

    public function get_all_notifications($user_id)
    {
        $notificaions = $this->db->select('notification.*,user_notification.is_read')
        ->from('notification')
        ->join('user_notification','notification.ID=user_notification.notification_id and user_notification.user_id='.$user_id)
        ->where('notification.user_id<>'.$user_id)
        ->order_by('ID','desc')
        ->get()
        ->result();
        return $notificaions;
    }

    public function read($data,$user_id,$id)
    {
        $this->db->update('user_notification',$data,['user_id'=>$user_id,'notification_id'=>$id]);
    }

    public function get_count($user_id)
    {
        $query = $this->db->query('SELECT * FROM user_notification where user_notification.user_id='.$user_id);
        return $query->num_rows();
    }

}