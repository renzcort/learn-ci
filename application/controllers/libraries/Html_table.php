<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Html_table extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('table');
  }

  public function index()
  {
    var_dump($this->table);

    $data = array(
        array('Name', 'Color', 'Size'),
        array('Fred', 'Blue', 'Small'),
        array('Mary', 'Red', 'Large'),
        array('John', 'Green', 'Medium')
    );
    echo $this->table->generate($data);
    echo "<br>";

    $this->table->set_caption('Colors');
    $this->table->set_heading('Name', 'Color', 'Size');
    $this->table->add_row('Mary', 'Blue', 'Small');
    $this->table->set_empty("&nbsp;");
    $this->table->add_row('John', 'Red',  'Large');
    echo $this->table->generate();
    echo "<br>";

    $this->table->set_heading('Name', 'Color',  'Size');
    $this->table->add_row(array('Fred', 'Blue', 'Small'));
    $this->table->add_row(array('Fred1', 'Blue1', 'Small1'));
    $this->table->add_row(array('Fred2', 'Blue2', 'Small2'));
    echo $this->table->generate();
    echo "<br>";

    // Changing the Look of Your Table
    $template = array(
        'table_open'            => '<table border="10" cellpadding="4" cellspacing="0">',

        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',

        'heading_row_start'     => '<tr>',
        'heading_row_end'       => '</tr>',
        'heading_cell_start'    => '<th>',
        'heading_cell_end'      => '</th>',

        'tbody_open'            => '<tbody>',
        'tbody_close'           => '</tbody>',

        'row_start'             => '<tr>',
        'row_end'               => '</tr>',
        'cell_start'            => '<td>',
        'cell_end'              => '</td>',

        'row_alt_start'         => '<tr>',
        'row_alt_end'           => '</tr>',
        'cell_alt_start'        => '<td>',
        'cell_alt_end'          => '</td>',

        'table_close'           => '</table>'
    );
    $this->table->set_template($template);
    $this->table->set_heading('Name', 'Color',  'Size');
    $this->table->add_row(array('Fred', 'Blue', 'Small'));
    $this->table->add_row(array('Fred1', 'Blue1', 'Small1'));
    $this->table->add_row(array('Fred2', 'Blue2', 'Small2'));
    echo $this->table->generate();
    echo "<br>";

    $template = array(
        'table_open' => '<table border="1" cellpadding="10" cellspacing="1" class="mytable">'
    );
    $this->table->set_template($template);
    $this->table->set_heading('Name', 'Color',  'Size');
    $this->table->add_row(array('Fred', 'Blue', 'Small'));
    $this->table->add_row(array('Fred1', 'Blue1', 'Small1'));
    $this->table->add_row(array('Fred2', 'Blue2', 'Small2'));
    echo $this->table->generate();
    echo "<br>";
    

    // set function special character
    $this->table->set_heading('Name', 'Color', 'Size');
    $this->table->add_row('Fred', '<strong>Blue</strong>', 'Small');
    $this->table->function = 'htmlspecialchars';
    echo $this->table->generate();
    echo "<br>";

    // Make Column
    $list = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve');
    $new_list = $this->table->make_columns($list, 3);
    echo $this->table->generate($new_list);
    echo "<br>";

    // clear table setting
    $this->table->set_heading('Name', 'Color', 'Size');
    $this->table->add_row('Fred', 'Blue', 'Small');
    $this->table->add_row('Mary', 'Red', 'Large');
    $this->table->add_row('John', 'Green', 'Medium');
    echo $this->table->generate();
    $this->table->clear();
    $this->table->set_heading('Name', 'Day', 'Delivery');
    $this->table->add_row('Fred', 'Wednesday', 'Express');
    $this->table->add_row('Mary', 'Monday', 'Air');
    $this->table->add_row('John', 'Saturday', 'Overnight');
    echo $this->table->generate();
  }

}

/* End of file Html_table.php */
/* Location: ./application/controllers/libraries/Html_table.php */