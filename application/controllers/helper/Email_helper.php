<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_helper extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('email');
  }

  public function index()
  {
    /*Available Function*/
    // Valid Emaol Check Email
    if (valid_email('email@somesite.com'))
    {
      echo 'email is valid';
    }
    else
    {
      echo 'email is not valid';
    }
    echo "Available Functions Standart Valid Email"; echo "<br><br>";

    // send Email
    $recipient = 'kharenputra@gmail.com';
    $subject = 'Test Send Email';
    $message = 'Test Email Masuk';
    // send_email($recipient, $subject, $message );
    echo "Available Functions Standart Send Email"; echo "<br><br>";

    echo "Available Functions Standart"; echo "<br><br>";
    /*END*/
  }

}

/* End of file Email_helper.php */
/* Location: ./application/controllers/helper/Email_helper.php */