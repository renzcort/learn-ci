<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_testing extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('unit_test');
  }

  public function index()
  {
    $test = 1 + 1;
    $expected_result = 2;
    $test_name = 'Adds one plus one';
    $this->unit->run($test, $expected_result, $test_name);
    
    // lateral
    $this->unit->run('Foo', 'Foo');
    $this->unit->run('Foo', 'is_string');
    $this->unit->run($test, $expected_result);
    // echo $this->unit->report();

    // Strict Mode
    $this->unit->run(1, TRUE);
    if (1 == TRUE) echo 'This evaluates as true';
    if (1 === TRUE) echo 'This evaluates as FALSE';
    // To enable strict mode use this
    $this->unit->use_strict(TRUE);

    // Enabling/Disabling Unit Testing
    $this->unit->active(TRUE);

    // Customizing displayed tests
    $this->unit->set_test_items(array('test_name', 'result'));

    // Creating a Template
    $str = '
    <table border="0" cellpadding="4" cellspacing="1">
    {rows}
            <tr>
                    <td>{item}</td>
                    <td>{result}</td>
            </tr>
    {/rows}
    </table>';
    $this->unit->set_template($str);
    echo $this->unit->report();
  }

}

/* End of file Unit_testing.php */
/* Location: ./application/controllers/libraries/Unit_testing.php */