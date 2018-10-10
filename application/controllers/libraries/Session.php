<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('session');
	}

	public function index()
	{
		// Retrieving Session Data
		// $name = $_SESSION['name'];
    // or:
    $name = $this->session->name;
		var_dump($name); echo "<br>";
		// or:
		$name = $this->session->userdata('name');

		// Adding Session Data
		$newdata = array(
        'username'  => 'johndoe',
        'email'     => 'johndoe@some-site.com',
        'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
		var_dump($this->session->set_userdata($newdata)); echo "<br>";
		// add userdata one value at a time
		$this->session->set_userdata('logged_in', $newdata);
		var_dump($this->session->set_userdata('logged_in', $newdata)); echo "<br>";

		// verify that a session value exists
		isset($_SESSION['logged_in']);
		$this->session->has_userdata('logged_in');
		var_dump($this->session->has_userdata('logged_in')); echo "<br>";

		// Removing Session Data
		unset($_SESSION['logged_in']);
		// or multiple values:
		unset(
		        $_SESSION['logged_in'],
		        $_SESSION['another_name']
		);
		$this->session->unset_userdata('logged_in');
		// unset item
		$array_items = array('username', 'email');
		$this->session->unset_userdata($array_items);

		// To mark an existing item as “flashdata”
		$this->session->mark_as_flash('username');
		var_dump($this->session->mark_as_flash('username')); echo "<br>";
		// multiple items as flashdata
		$this->session->mark_as_flash(array('username', 'email'));
		var_dump($this->session->mark_as_flash(array('username', 'email'))); echo "<br>";
		// set Flasdata
		$this->session->set_flashdata('item', 'value');
		$this->session->flashdata('item');
		var_dump($this->session->flashdata('item')); echo "<br>";
		var_dump($this->session->flashdata()); echo "<br>";
		// keep flashdata
		$this->session->keep_flashdata('item');
		var_dump($this->session->keep_flashdata('item')); echo "<br>";
		$this->session->keep_flashdata(array('item1', 'item2', 'item3'));
		var_dump($this->session->keep_flashdata(array('item1', 'item2', 'item3'))); echo "<br>";

		// TEMP DATA
		// 'item' will be erased after 300 seconds
		$this->session->mark_as_temp('item', 300);
		// Both 'item' and 'item2' will expire after 300 seconds
		$this->session->mark_as_temp(array('item', 'item2'), 300);
		// 'item' will be erased after 300 seconds, while 'item2'
		// will do so after only 240 seconds
		$this->session->mark_as_temp(array(
		        'item'  => 300,
		        'item2' => 240
		));
		$_SESSION['item'] = 'value';
		$this->session->mark_as_temp('item', 300); // Expire in 5 minutes
		$this->session->set_tempdata('item', 'value', 300);
		// alternatively
		$this->session->set_tempdata('item', 'value', 300);
		$tempdata = array('newuser' => TRUE, 'message' => 'Thanks for joining!');
    $expire = '';
		$this->session->set_tempdata($tempdata, NULL, $expire);
		// To read a tempdata variable,
		$this->session->tempdata('item');
		var_dump($this->session->tempdata('item')); echo "<br>";
		$this->session->tempdata();
		var_dump($this->session->tempdata()); echo "<br>";

    // Destroying a Session
    session_destroy();
    // or
    $this->session->sess_destroy();

	}

}

/* End of file Session.php */
/* Location: ./application/controllers/libraries/Session.php */