<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xmlrpc extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('xmlrpc');
    $this->load->library('xmlrpcs');
  }

  public function index()
  { 
    // var_dump($this->xmlrpcs);

    $this->xmlrpc->server('http://rpc.pingomatic.com/', 80);
    $this->xmlrpc->method('weblogUpdates.ping');
    $request = array('My Photoblog', 'http://www.my-site.com/photoblog/');
    $this->xmlrpc->request($request);
    if ( ! $this->xmlrpc->send_request())
    {
            echo $this->xmlrpc->display_error();
    }

    // Anatomy of a Request
    $request = array('John', 'Doe', 'www.some-site.com');
    echo $this->xmlrpc->request($request);
    $request = array(
        array('John', 'string'),
        array('Doe', 'string'),
        array(FALSE, 'boolean'),
        array(12345, 'int')
    );
    var_dump($this->xmlrpc->request($request));

    $config['functions']['new_post'] = array('function' => 'My_blog.new_entry');
    $config['functions']['update_post'] = array('function' => 'My_blog.update_entry');
    $config['object'] = $this;

    $this->xmlrpcs->initialize($config);
    $this->xmlrpcs->serve();
  }

  public function getUserInfo($request)
  {
    $username = 'smitty';
    $password = 'secretsmittypass';

    $this->load->library('xmlrpc');

    $parameters = $request->output_parameters();

    if ($parameters[1] != $username && $parameters[2] != $password)
    {
            return $this->xmlrpc->send_error_message('100', 'Invalid Access');
    }

    $response = array(
            array(
                    'nickname'  => array('Smitty', 'string'),
                    'userid'    => array('99', 'string'),
                    'url'       => array('http://yoursite.com', 'string'),
                    'email'     => array('jsmith@yoursite.com', 'string'),
                    'lastname'  => array('Smith', 'string'),
                    'firstname' => array('John', 'string')
            ),
             'struct'
    );

    return $this->xmlrpc->send_response($response);
  }

}

/* End of file Xmlrpc.php */
/* Location: ./application/controllers/libraries/Xmlrpc.php */