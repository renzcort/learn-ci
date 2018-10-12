<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Array_helper extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('array');
  }

  public function index()
  {
    /*Available Functions*/
    // Element
    $array = array(
        'color' => 'red',
        'shape' => 'round',
        'radius' => '10',
        'diameter' => '20'
    );
    echo element('color', $array); echo '<br>';
    echo element('shape', $array); echo '<br>';
    echo "Element Function"; echo "<br><br>";

    // Elements
    $elements = elements(array('color', 'shape', 'height'), $array);; 
    print_r($elements); echo '<br>';
    $elements = elements(array('color', 'shape', 'height'), $array, 'footer'); 
    print_r($elements); echo '<br>';
    echo "Elements Function"; echo "<br><br>";

    // Random Elements
    $quotes = array(
        "I find that the harder I work, the more luck I seem to have. - Thomas Jefferson",
        "Don't stay in bed, unless you can make money in bed. - George Burns",
        "We didn't lose the game; we just ran out of time. - Vince Lombardi",
        "If everything seems under control, you're not going fast enough. - Mario Andretti",
        "Reality is merely an illusion, albeit a very persistent one. - Albert Einstein",
        "Chance favors the prepared mind - Louis Pasteur"
    );
    echo random_element($quotes);
    echo "Random Elements"; echo "<br><br>";
    echo "Available Functions"; echo "<br><br>";
    /*END*/
  }

}

/* End of file Array.php */
/* Location: ./application/controllers/helper/Array.php */