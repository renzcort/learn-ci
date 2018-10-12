<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cookie_helper extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('cookie');
  }

  public function index()
  { 
    /*Available Functions*/
    
    echo "Available Functions"; echo "<br><br>";
    /*END*/
    
  }

}

/* End of file Cookie_helper.php */
/* Location: ./application/controllers/helper/Cookie_helper.php */