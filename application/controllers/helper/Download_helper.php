<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_helper extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('download');
  }

  public function index()
  {
    /*Available Function*/
    $data = 'Here is some text!';
    $name = 'mytext.txt';
    force_download($name, $data);
    // download an existing file
    // Contents of photo.jpg will be automatically read
    force_download('/path/to/photo.jpg', NULL);
    echo "Available Functions Standart"; echo "<br><br>";
    /*End*/
  }

}

/* End of file Download_helper.php */
/* Location: ./application/controllers/helper/Download_helper.php */