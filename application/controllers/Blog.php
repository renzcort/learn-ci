<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

  public function index()
  {
    $data['todo_list'] = array('clean', 'call', 'run');
    $data['title']  = 'My Real Title';
    $data['heading']  = 'My real Heading';

    $this->load->view('blog/view', $data);    
  }

}

/* End of file Blog.php */
/* Location: ./application/controllers/Blog.php */