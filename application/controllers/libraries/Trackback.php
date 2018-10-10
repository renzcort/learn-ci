<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trackback extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('trackback');
  }

  public function index()
  {
    var_dump($this->trackback);

    $tb_data = array(
        'ping_url'  => 'http://example.com/trackback/456',
        'url'       => 'http://www.my-example.com/blog/entry/123',
        'title'     => 'The Title of My Entry',
        'excerpt'   => 'The entry content.',
        'blog_name' => 'My Blog Name',
        'charset'   => 'utf-8'
    );
    if ( ! $this->trackback->send($tb_data))
    {
            echo $this->trackback->display_errors();
    }
    else
    {
            echo 'Trackback was sent!';
    }
  }

}

/* End of file Trackback.php */
/* Location: ./application/controllers/libraries/Trackback.php */