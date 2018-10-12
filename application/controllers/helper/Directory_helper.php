<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directory_helper extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('directory');
  }

  public function index()
  {
    /*Available Functions*/
    // Directory Map
    $map = directory_map('./assets/mydirectory/');
    echo $map; echo "<br>";
    $map = directory_map('./mydirectory/', FALSE, TRUE); 
    echo $map; echo "<br>";
    echo "Available Functions Standart Directory Map"; echo "<br><br>";

    

    echo "Available Functions Standart"; echo "<br><br>";

    /*END*/
  }

}

/* End of file Directory_helper.php */
/* Location: ./application/controllers/helper/Directory_helper.php */