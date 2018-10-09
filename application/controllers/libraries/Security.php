<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper(array('form', 'html', 'security', 'url'));
	}

	public function index()
	{
		 // POST values
    $config = array(
      'first_name' => $this->input->post('username'),
      'last_name' => $this->input->post('password'), 
      'email' => $this->input->post('email'),
    );
		$data = $this->security->xss_clean($config);
		var_dump($data); echo "<br>";
		foreach ($config as $key => $value) {
			if ($this->security->xss_clean($value, TRUE) === FALSE)
			{
	        // file failed the XSS test
					$data = $this->security->xss_clean($value);
					var_dump($key, $data);
			}
		}
		echo "<br>";

		// Cross-site request forgery (CSRF)
		$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
		);

		// sanitize_filename
		$filename = $this->security->sanitize_filename($this->input->post('username'));
		var_dump($filename); echo "<br>";
		$filename = $this->security->sanitize_filename($this->input->post('filename'), TRUE);
		var_dump($filename); echo "<br>";

		$this->load->view('libraries/security/index', $data);	
	}

}

/* End of file Security.php */
/* Location: ./application/controllers/libraries/Security.php */