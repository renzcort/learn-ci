<?php 

/**
 * 
 */
class My_Email extends CI_Email
{
  protected $CI;
  
  function __construct()
  {
    $this->$CI =& get_instance();
  }

  public function foo() 
  {
    $this->CI->load->helper('url');
    redirect();
  }

  public function bar()
  {
    echo $this->CI->config->item('base_url');
  }
}