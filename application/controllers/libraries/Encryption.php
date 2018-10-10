<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encryption extends CI_Controller {

	public function index()
	{
		$this->load->library('encryption');
    var_dump($this->encryption); echo "<br>"; echo "<br>";

    // $key will be assigned a 16-byte (128-bit) random key
    $key = $this->encryption->create_key(16);
    var_dump($key); echo "<br>";

    // Get a hex-encoded representation of the key:
    $key = bin2hex($this->encryption->create_key(16));
    var_dump($key); echo "<br>";

    // configure libraru
    $this->encryption->initialize(
      array('cipher'  =>  'aes-256',
            'mode'    =>  'ctr',
            'key'     =>  '<a 32-character random string>'  
      )
    );
    // switch to MCrypt driver
    var_dump($this->encryption->initialize(array('driver' => 'mcrypt'))); echo "<br>";
    // swith back to the OpenSSL Driver
    var_dump($this->encryption->initialize(array('driver' => 'OpenSSL'))); echo "<br>";

    // encryption and descryption data
    $plan_text = 'This is plan_text message';
    $chippertext = $this->encryption->encrypt($plan_text); 
    var_dump($chippertext); echo "<br>";
    echo $this->encryption->decrypt($chippertext); echo "<br>";

    // Assume that we have $ciphertext, $key and $hmac_key
    // from on outside source
    $message = $this->encryption->decrypt($chippertext, array(
                'cipher'  =>  'blowfish',
                'mode'    =>  'cbc',
                'key'     =>  $key,
                'hmac_digest' =>  'sha256',
                'hmac_key'  =>  'ripemd160'
              )
    );
    var_dump($message); echo "<br>";

    // initialize
    var_dump($this->encryption->initialize(array('mode' =>  'ctr'))); echo "<br>";

    // hkdf
    $hmac_key = $this->encryption->hkdf($key, 'sha512', NULL, NULL, 'authentication');
    var_dump($hmac_key); echo "<br>";	
	}

}

/* End of file Encryption.php */
/* Location: ./application/controllers/libraries/Encryption.php */