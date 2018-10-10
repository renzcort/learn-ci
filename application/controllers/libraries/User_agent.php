<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_agent extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('user_agent');
  }

  public function index()
  {
    // var_dump($this->agent);
    echo "<br>";

    // example
    if ($this->agent->is_browser())
    {
      $agent = $this->agent->browser().' '.$this->agent->version();
    }
    elseif ($this->agent->is_robot())
    {
      $agent = $this->agent->robot();
    }
    elseif ($this->agent->is_mobile())
    {
      $agent = $this->agent->mobile();
    }
    else
    {
      $agent = 'Unidentified User Agent';
    }
    echo $agent;
    echo "<br>";
    echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
    echo "<br>";

    // check user Agent
    if ($this->agent->is_browser('Safari'))
    {
      echo 'You are using Safari.';
    }
    elseif ($this->agent->is_browser())
    {
      echo 'You are using a browser.';
    }
    echo "<br>";

    // check if mobile
    if ($this->agent->is_mobile('iphone'))
    {
      $this->load->view('iphone/home');
    }
    elseif ($this->agent->is_mobile())
    {
      $this->load->view('mobile/home');
    }
    else
    {
      echo "Display Web";
      // $this->load->view('web/home');
    }
    echo "<br>";

    // check robot
    var_dump($this->agent->is_robot()); 
    if ($this->agent->is_robot()) {
      echo "TRUE";
    } else {
      echo "FALSE";
    }
    echo "<br>";

    // Check Referral
    var_dump($this->agent->is_referral()); 
    if ($this->agent->is_referral()) {
      echo "TRUE";
    } else {
      echo "FALSE";
    }
    echo "<br>";

    // Detect Browser
    echo $this->agent->browser();
    echo "<br>";

    // Detect Version Browser
    echo $this->agent->version();
    echo "<br>";

    // Detect Mobile Device
    var_dump($this->agent->mobile());
    echo "<br>";

    // Detect robot
    var_dump($this->agent->robot());
    echo "<br>";

    // Detect Platform
    var_dump($this->agent->platform());
    echo "<br>";

    // Agent String
    var_dump($this->agent->agent_string());
    echo "<br>";

    // accept lang
    if ($this->agent->accept_lang('en'))
    {
      echo 'You accept English!';
    }
    echo "<br>";

    // langunage
    var_dump($this->agent->languages());
    echo "<br>";

    // Accept Charset
    var_dump($this->agent->accept_charset());
    echo "<br>";
    if ($this->agent->accept_charset('utf-8'))
    {
      echo 'You browser supports UTF-8!';
    }

    // charset
    var_dump($this->agent->charsets());
    echo "<br>";

    // parse
    $data = 'Hello World';
    var_dump($this->agent->parse($data));
    echo "<br>";
  }

}

/* End of file User_agent.php */
/* Location: ./application/controllers/libraries/User_agent.php */