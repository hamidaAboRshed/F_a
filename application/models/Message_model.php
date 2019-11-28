<?php 

class Message_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function get($user_id)
    {
        return $this->db->select('message.*,user_message.is_read,user.Username,employee.FirstName,employee.LastName')
                 ->from('message')
                 ->join('user_message','message.ID=user_message.message_id and user_message.user_id='.$user_id)
                 ->join('user','message.user_id=user.ID')
                 ->join('employee','employee.ID=user.EmployeeID','left')
                 ->order_by('ID','desc')
                 ->limit(10)
                 ->get()
                 ->result();
    }

    public function get_all($user_id)
    {
        return $this->db->select('message.*,user_message.is_read,user.Username,employee.FirstName,employee.LastName')
                 ->from('message')
                 ->join('user_message','message.ID=user_message.message_id and user_message.user_id='.$user_id)
                 ->join('user','message.user_id=user.ID')
                 ->join('employee','employee.ID=user.EmployeeID','left')
                 ->limit(2)
                 ->order_by('ID','desc')
                 ->get()
                 ->result_array();
    }
    public function get_all_limit($user_id,$limit)
    {
        $limit = $limit-1;
        return $this->db->select('message.*,user_message.is_read,user.Username,employee.FirstName,employee.LastName')
                 ->from('message')
                 ->join('user_message','message.ID=user_message.message_id and user_message.user_id='.$user_id)
                 ->join('user','message.user_id=user.ID')
                 ->join('employee','employee.ID=user.EmployeeID','left')
                 ->limit(10,$limit)
                 ->order_by('ID','desc')
                 ->get()
                 ->result_array();
    }
    
    public function get_count($user_id)
    {
        $query = $this->db->query('SELECT * FROM user_message where user_message.user_id='.$user_id);
        return $query->num_rows();
    }

    public function get_message($id,$user_id)
    {
        return $this->db->select('message.*,user_message.is_read,user.Username,employee.FirstName,employee.LastName')
                        ->from('message')
                        ->join('user_message','message.ID=user_message.message_id and user_message.user_id='.$user_id)
                        ->join('user','message.user_id=user.ID')
                        ->join('employee','employee.ID=user.EmployeeID')
                        ->where(['message.ID'=>$id])
                        ->get()
                        ->row(0);
    }

    public function insert($message,$recievers)
    {
        $this->db->insert('message',$message);
        $message_id = $this->db->insert_id();
        if($message_id == null)
        {
            return false;
        }
        foreach($recievers as $key=>$value)
        {
            $this->db->insert('user_message',array('user_id'=>$value,'message_id'=>$message_id));
        }
    }

    public function read($id,$user_id)
    {
        $this->db->update('user_message',array('is_read'=>true),['user_id'=>$user_id,'message_id'=>$id]);
    }
}