<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	public function index()
	{
		$this->load->library('email');
    /*$config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset']  = 'iso-8859-1';
    $config['wordwrap'] = TRUE;*/

    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'kharenputra@gmail.com';
    $config['smtp_pass']    = '';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'text'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      
    $this->email->initialize($config);

    $this->email->from('kharenputra@gmail.com', 'Rendi');
    $this->email->to('renzcort@gmail.com'); 
    // $this->email->cc('renzcort@gmail.com');
    // $this->email->bcc('rendi@maksimaselarasabadi.co.id');

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');  
    $this->email->send();
    echo $this->email->print_debugger();
	}

}

/* End of file Email.php */
/* Location: ./application/controllers/libraries/Email.php */