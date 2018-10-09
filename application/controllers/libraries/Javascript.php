<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Javascript extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    
    $this->load->library('Javascript');
    $this->load->library('javascript/jquery');
  }

  public function index()
  {
    $params = array(
    'height' => 80,
    'width' => '50%',
    'marginLeft' => 125
    );
    $this->jquery->click('#trigger', $this->jquery->animate('#note', $params, 'normal'));

  }

}

/* End of file Javascript.php */
/* Location: ./application/controllers/libraries/Javascript.php */