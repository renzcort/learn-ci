<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('input');
  }

  public function index()
  {
    $something = isset($_POST['something']) ? $_POST['something'] : NULL;
    //Using the php://input stream
    var_dump($this->input->input_stream('key', TRUE)); // XSS Clean
    var_dump($this->input->input_stream('key', FALSE)); // No XSS filter
    echo "<br>";

    var_dump($this->input->post(NULL, TRUE)); // returns all POST items with XSS filter
    var_dump($this->input->post(NULL, FALSE)); // returns all POST items without XSS filter
    echo "<br>";

    var_dump($this->input->get(NULL, TRUE)); // returns all GET items with XSS filter
    var_dump($this->input->get(NULL, FALSE)); // returns all GET items without XSS filtering
    echo "<br>";

    // post get
    var_dump($this->input->post_get('something', TRUE));
    // get Post
    var_dump($this->input->get_post('something', TRUE));
    echo "<br>";

    // cokkies
    var_dump($this->input->cookie('something'));
    var_dump($this->input->cookie('something', TRUE)); // with XSS filter
    // cookies Array
    var_dump($this->input->cookie(array('something', 'something2')));
    echo "<br>";

    // server
    var_dump($this->input->server('something'));
    var_dump($this->input->server(array('SERVER_PROTOCOL', 'REQUEST_URI')));
    echo "<br>";

    // set cookies
    $cookie = array(
        'name'   => 'The Cookie Name',
        'value'  => 'The Value',
        'expire' => '86500',
        'domain' => '.some-domain.com',
        'path'   => '/',
        'prefix' => 'myprefix_',
        'secure' => TRUE
    );
    $this->input->set_cookie($cookie);
    echo "<br>";

    // IP address
    echo $this->input->ip_address();
    echo "<br>";

    // check IP address
    $ip = '127.0.0.1';
    if ( ! $this->input->valid_ip($ip))
    {
        echo 'Not Valid';
    }
    else
    {
        echo 'Valid';
    }
    echo "<br>";

    // user agent
    echo $this->input->user_agent();
    echo "<br>";

    // header
    $headers = $this->input->request_headers();
    var_dump($headers); 
    echo "<br>";

    // get request header
    var_dump($this->input->get_request_header('some-header', TRUE));
    echo "<br>";

    // ajax request
    var_dump($this->input->is_ajax_request()); 
    echo "<br>";

    // check CLI
    var_dump($this->input->is_cli_request()); 
    echo "<br>";

    // method
    echo $this->input->method(TRUE); // Outputs: POST
    echo $this->input->method(FALSE); // Outputs: post
    echo $this->input->method(); // Outputs: post
    echo "<br>";

  }

}

/* End of file Input.php */
/* Location: ./application/controllers/libraries/Input.php */