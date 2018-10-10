<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encrypt extends CI_Controller {

	public function index()
	{
		$this->load->library('encrypt');
    var_dump($this->encrypt);
    echo "<br>";

    // encode
    $msg = "My Secret message";
    $key = "super-secreet-key";
    $encryption_string1 = $this->encrypt->encode($msg);
    var_dump($encryption_string1);
    echo "<br>";
    $encryption_string = $this->encrypt->encode($msg, $key);
    var_dump($encryption_string);
    echo "<br>";

    // decode
    $decode_string1 = $this->encrypt->decode($encryption_string1);
    var_dump($decode_string1);
    echo "<br>";
    $decode_string = $this->encrypt->decode($msg, $key);
    var_dump($decode_string);
    echo "<br>";

    // chipper
    $this->encrypt->set_cipher(MCRYPT_BLOWFISH);
    echo extension_loaded('mcrypt') ? 'Yup' : 'Nope';
    echo "<br>";

    // set mode
    var_dump($this->encrypt->set_mode(MCRYPT_MODE_CFB));
    echo "<br>";

    // leagacy
    $new_data = $this->encrypt->encode_from_legacy($encryption_string1);
    var_dump($new_data);
	}

}

/* End of file Encrypt.php */
/* Location: ./application/controllers/libraries/Encrypt.php */