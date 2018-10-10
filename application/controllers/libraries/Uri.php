<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uri extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public function index()
  {
    // segment
    $product_id = $this->uri->segment(2, 0);
    if ($this->uri->segment(2) === FALSE)
    {
            $product_id = 0;
    }
    else
    {
            $product_id = $this->uri->segment(2);
    }
    echo $product_id;
    echo "<br>";

    // rsegment
    echo $this->uri->rsegment(2);
    echo "<br>";

    // splash segment
    echo $this->uri->slash_segment(2);
    echo "<br>";
    echo $this->uri->slash_segment(2, 'leading');
    echo "<br>";
    echo $this->uri->slash_segment(2, 'both');
    echo "<br>";

    // slash_rsegment
    echo $this->uri->slash_rsegment(2);
    echo "<br>";
    echo $this->uri->slash_rsegment(2, 'leading');
    echo "<br>";
    echo $this->uri->slash_rsegment(2, 'both');
    echo "<br>";

    // Associative URL
    $default = array('name', 'gender', 'location', 'type', 'sort');
    $array = $this->uri->uri_to_assoc(2, $default);
    var_dump($array);
    echo "<br>";

    // ruri_to_assoc
    $default = array('name', 'gender', 'location', 'type', 'sort');
    $array = $this->uri->ruri_to_assoc(2, $default);
    var_dump($array);
    echo "<br>";

    // assoc_to_uri
    $array = array('product' => 'shoes', 'size' => 'large', 'color' => 'red');
    $str = $this->uri->assoc_to_uri($array);
    var_dump($str);
    echo "<br>";
    // Produces: product/shoes/size/large/color/red

    // URI STRING
    var_dump($this->uri->uri_string());
    echo "<br>";

    // rURI String
    var_dump($this->uri->ruri_string());
    echo "<br>";

    // TOTAL SEGMENT
    var_dump($this->uri->total_segments());
    echo "<br>";

    // segment_array
    $segs = $this->uri->segment_array();
    foreach ($segs as $segment)
    {
        echo $segment;
        echo ',';
    }
    echo "<br>";

    // rsegment_array
    $segs = $this->uri->rsegment_array();
    foreach ($segs as $segment)
    {
        echo $segment;
        echo ',';
    }


  }

}

/* End of file Uri.php */
/* Location: ./application/controllers/libraries/Uri.php */