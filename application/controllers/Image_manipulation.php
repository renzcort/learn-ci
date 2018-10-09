<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_manipulation extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('image_lib');
  }

  public function index()
  {
    $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/icon_md1.png';
    $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/thumbnail/';
    $config['image_library']  = 'gd2';
    $config['source_image']   = $source_path;
    $config['create_thumb']   = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']          = 75;
    $config['height']         = 50;
    // Creating a Copy
    $config['new_image'] = $target_path;

    $this->load->library('image_lib', $config);
    
    if($this->image_lib->resize()) {
      // display errors
      echo $this->image_lib->display_errors();
      echo $this->image_lib->display_errors('<p>', '</p>');      
    }
    
    // reset images
    $this->image_lib->clear();
  }

  public function watermark() {
    $config['source_image'] = '/path/to/image/mypic.jpg';
    $config['wm_text'] = 'Copyright 2006 - John Doe';
    $config['wm_type'] = 'text';
    $config['wm_font_path'] = './system/fonts/texb.ttf';
    $config['wm_font_size'] = '16';
    $config['wm_font_color'] = 'ffffff';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'center';
    $config['wm_padding'] = '20';

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
  }

  public function crop()
  {
    $config['image_library'] = 'imagemagick';
    $config['library_path'] = '/usr/X11R6/bin/';
    $config['source_image'] = '/path/to/image/mypic.jpg';
    $config['x_axis'] = 100;
    $config['y_axis'] = 60;

    $this->image_lib->initialize($config);

    if ( ! $this->image_lib->crop())
    {
            echo $this->image_lib->display_errors();
    }
  }

  public function rotate()
  {
    $config['image_library'] = 'netpbm';
    $config['library_path'] = '/usr/bin/';
    $config['source_image'] = '/path/to/image/mypic.jpg';
    $config['rotation_angle'] = 'hor';
    // $config['rotation_angle'] = '90';

    $this->image_lib->initialize($config);

    if ( ! $this->image_lib->rotate())
    {
            echo $this->image_lib->display_errors();
    }
  }

}

/* End of file Image_manipulation.php */
/* Location: ./application/controllers/Image_manipulation.php */