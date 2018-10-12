<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_helper extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('form');
  }

  public function index()
  {
    /*Escaping field values*/
    $data = arraY('string' => 'Here is a string containing "quoted" text.');
    echo "Escaping field values"; echo "<br><br>";
    /*END*/
    $this->load->view('helper/index', $data);
  }

}

/* End of file Form_helper.php */
/* Location: ./application/controllers/helper/Form_helper.php */