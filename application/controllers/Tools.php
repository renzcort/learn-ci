<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

  public function message($to = 'world')
  {
    echo "Hello {$to}".PHP_EOL;
  }

}

/* End of file Tools.php */
/* Location: ./application/controllers/Tools.php */