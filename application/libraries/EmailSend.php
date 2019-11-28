<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSend
{
    /*
    |--------------------------------------------------------------------------
    | Auth Library
    |--------------------------------------------------------------------------
    |
    | This Library handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */
    protected $CI;

    

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->library('email');
    }

    /**
     * Initialization the Auth class
     */
    public function send($from , $to, $subject,$header,$body)
    {
        $config = array (
			'protocol' => 'smtp',
			'smtp_host' => 'mail.atclighting.co',
			'smtp_user'    => 'welcome@atclighting.co',
			'smtp_pass'   => 'rAf951eEd',
			'smtp_port' => '25',
			'smtp_timeout' => '7',
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '0',
			'newline'  => "\r\n"
		  );

		$this->CI->load->library('email',$config);
		$this->CI->email->set_mailtype("html");
		$this->CI->email->from($from);
		$this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $data['topMsg']=$header;
        $data['bodyMsg']=$body;
        $data['delimeter']="Rafeed Co";
        $data['thanksMsg']="Best regrades.";
        $message = $this->CI->load->view('email',$data, true);
        $this->CI->email->message($message);
        if($this->CI->email->send())
        {
            return true;
        }
        else  
        {
            return false;
        }

    }
}