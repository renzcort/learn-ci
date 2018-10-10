<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

  public function index()
  {
    
    $this->load->helper(array('form', 'url'));
    $this->load->view('libraries/form/index', array('error' => ' '));
  }

  function form_upload()
  {
    $config['upload_path']  = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']     = 100;
    $config['max_width']    = 1024;
    $config['max_height']   = 768;
    $this->load->library('upload', $config);
    // alternate with initialize
    $this->upload->initialize($config);

    if ( ! $this->upload->do_upload('userfile')) {
      $error = array('error'  =>  $this->upload->display_errors());
      $this->load->view('libraries/form/index', $error);
    } else {
      /*$data_file = array(
        'file_name'     => 'mypic.jpg',
        'file_type'     => 'image/jpeg',
        'file_path'     => '/path/to/your/upload/',
        'full_path'     => '/path/to/your/upload/jpg.jpg',
        'raw_name'      => 'mypic',
        'orig_name'     => 'mypic.jpg',
        'client_name'   => 'mypic.jpg',
        'file_ext'      => '.jpg',
        'file_size'     => '22.2',
        'is_image'      => '1',
        'image_width'   => '800',
        'image_height'  => '600',
        'image_type'    => 'jpeg',
        'image_size_str' => 'width="800" height="200"',
      );*/

      $data = array('upload_data' => $this->upload->data());
      $this->load->view('libraries/form/success', $data);
    }
  }

}

/* End of file Form.php */
/* Location: ./application/controllers/libraries/Form.php */