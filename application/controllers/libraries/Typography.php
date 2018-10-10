<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Typography extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('typography');
  }

  public function index()
  {
    var_dump($this->typography);
    echo "<br>";

    $this->typography->protect_braced_quotes = TRUE;

    $word = 'Hallo World';
    $string = $this->typography->auto_typography($word);
    $string = $this->typography->auto_typography($word, TRUE);
    var_dump($string); 
    echo "<br>";

    // format character
    $string = $this->typography->format_characters($word);
    var_dump($string); 
    echo "<br>";

    // convert new line
    $string = $this->typography->nl2br_except_pre($word);
    var_dump($string); 
    echo "<br>";
    
  }

}

/* End of file Typography.php */
/* Location: ./application/controllers/libraries/Typography.php */