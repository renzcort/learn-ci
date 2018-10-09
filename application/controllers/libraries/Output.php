<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends CI_Controller {

  public function index()
  {

    $this->output->parse_exec_vars = FALSE;

    $data = array('header'  =>  'tester');

    // var_dump($this->output->set_output($data));
    echo "<br>";

    /*$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(array('foo' => 'bar')));
    $this->Output
        ->set_content_type('jpeg') // You could also use ".jpeg" which will have the full stop removed before looking in config/mimes.php
        ->set_output(file_get_contents('files/something.jpg'));
    var_dump($this->output->set_content_type('css', 'utf-8'));*/
    echo "<br>";

    $mime = $this->output->get_content_type();
    var_dump($mime);
    echo "<br>";

    $this->output->set_content_type('text/plain', 'UTF-8');
    echo $this->output->get_header('content-type');
    // Outputs: text/plain; charset=utf-8
    echo "<br>";

    $string = $this->output->get_output();
    var_dump($string);
    echo "<br>";

    // var_dump($this->output->append_output($data));
    echo "<br>";

    $this->output->set_header('HTTP/1.0 200 OK');
    $this->output->set_header('HTTP/1.1 200 OK');
    // $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_update).' GMT');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
    $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');

    // var_dump($this->output->set_status_header(401));
    echo "<br>";
    // Sets the header as:  Unauthorized

    // var_dump($this->output->enable_profiler(TRUE));
    echo "<br>";

    $response = array('status' => 'OK');
    $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
    exit;

  }

}

/* End of file Output.php */
/* Location: ./application/controllers/libraries/Output.php */