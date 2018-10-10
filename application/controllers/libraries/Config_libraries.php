<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_libraries extends CI_Controller {

	public function index()
	{
		// Loads a config file named blog_settings.php and assigns it to an index named "blog_settings"
    $this->config->load('test');

    // Retrieve a config item named site_name contained within the test array
    $site_name = $this->config->item('home', 'pagesUrl');
    var_dump($site_name);

    // An alternate way to specify the same item:
    $blog_config = $this->config->item('pagesUrl');
    var_dump($blog_config);
    $site_name = $blog_config['home'];
    var_dump($site_name);

    // setting config item
    $this->config->set_item('item_name', 'item_value');

    /*$this->config->load('test');
    $config['gender'] = array('male', 'female');
    var_dump($this->config->item('gender'));*/
	}

}

/* End of file Config_libraries.php */
/* Location: ./application/controllers/libraries/Config_libraries.php */