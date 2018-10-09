<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_validation extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->config('form_validation');
  }

  public function index()
  {
    $this->form_validation->reset_validation();
    /*form validation rules 1*/
    /*$this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
    $this->form_validation->set_rules('passconf', 'Password confirmation', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');*/

    /*form validation rules 2*/
    /*$config = array(
        array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
        ),
        array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.',
                ),
        ),
        array(
                'field' => 'passconf',
                'label' => 'Password Confirmation',
                'rules' => 'required'
        ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
        )
    );
    $this->form_validation->set_rules($config);*/

     // validation rules 3
    /*$this->form_validation->set_rules(
        'username', 'Username',
        'required|min_length[5]|max_length[12]|is_unique[users.username]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        )
    );
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');*/

    // form validation rules 4
    /*$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');*/

    // callback set rules check username
    /*$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');*/

    // setting rule message
    /*$this->form_validation->set_message('rule1', 'Error Message');
    $this->form_validation->set_rules('username', 'Username', 'rule1|rule2|rule3',
        array('rule2' => 'Error Message on rule2 for this username')
    );
    $this->form_validation->set_message('min_length', '{username} must have at least {param} characters.');
    $this->form_validation->set_message('username_check');*/

    // translating field names
    /*$this->form_validation->set_rules('username', 'lang:username', 'required');
    $lang['username'] = 'First Name';
    // $this->lang->load('username');*/

    // Changing the Error Delimiters
    /*$this->form_validation->set_error_delimiters('<div class="error">', '</div>');*/

    // Validating an Array 
    /*$data = array(
        'username' => 'johndoe',
        'password' => 'mypassword',
        'passconf' => 'mypassword'
    );
    $this->form_validation->set_data($data);*/

    // Using Arrays as Field Names
    $this->form_validation->set_rules('options[]', 'Options', 'required');

    // check validation
    var_dump($this->form_validation->has_rule('username'));

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('libraries/form/validation');
    } else {
      $this->load->view('libraries/form/validation_success');
    }
  }

  public function signup()
  {
    if ($this->form_validation->run('signup') == FALSE) {
      $this->load->view('libraries/form/validation');
    } else {
      $this->load->view('libraries/form/validation_success');
    }
  }

  public function username_check($str)
  {
    if ($str == 'test') {
      $this->form_validation->set_message('username_check', 'the {field} field can not be the word "test"');
      return FALSE;
    } else {
      return TRUE;
    }
  }

}

/* End of file Form_validation.php */
/* Location: ./application/controllers/Form_validation.php */