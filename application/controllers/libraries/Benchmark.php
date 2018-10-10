<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benchmark extends CI_Controller {

	public function index()
	{
		$this->benchmark->mark('code_start');
    $this->passwordfunc();
    $this->benchmark->mark('code_end');
    echo $this->benchmark->elapsed_time('code_start', 'end_start');

    $this->benchmark->mark('dog');
    $this->benchmark->mark('cat');
    $this->benchmark->mark('bird');
    echo $this->benchmark->elapsed_time('dog', 'cat');
    echo $this->benchmark->elapsed_time('cat', 'bird');
    echo $this->benchmark->elapsed_time('dog', 'bird');

    // display memory consumption
    echo $this->benchmark->memory_usage();
    // echo {memory_usage};	
	}

}

/* End of file Benchmark.php */
/* Location: ./application/controllers/libraries/Benchmark.php */