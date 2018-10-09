<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagination extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('pagination');
		$this->load->config('pagination');
	}

	public function index()
	{
		$this->pagination->initialize();
		echo $this->pagination->create_links();
	}

}

/* End of file Pagination.php */
/* Location: ./application/controllers/libraries/Pagination.php */