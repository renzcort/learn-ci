<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Date_helper extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('date');
  }

  public function index()
  {
    /*Available Functions*/
    // NOW
    echo now('Australia/Victoria'); echo "<br>";
    echo "Available Functions NOW"; echo "<br><br>";
    
    // MDATE
    $datestring = 'Year : %Y Month: %m Day: %d - %h:%i %a';
    $time = time();
    echo mdate($datestring, $time); echo "<br>";
    echo "Available Functions MDATE"; echo "<br><br>";

    // Standart Date
    $format = 'DATE_RFC822';
    $time = time();
    echo standard_date($format, $time);echo "<br>";
    echo "Available Functions Standart Date"; echo "<br><br>";

    // Local TO GMT
    $gmt = local_to_gmt(time());
    echo $gmt; echo "<br>";
    echo "Available Functions Standart Local To GMT"; echo "<br><br>";

    //GMT To Local 
    $timestamp = 1140153693;
    $timezone  = 'UM8';
    $daylight_saving = TRUE;
    echo gmt_to_local($timestamp, $timezone, $daylight_saving); echo "<br>";
    echo "Available Functions Standart GMT to Local"; echo "<br><br>";

    // SQL To Unix
    echo mysql_to_unix('20061124092345'); echo "<br>";
    echo "Available Functions Standart sql To Unix"; echo "<br><br>";

    // Unix To Human
    $now = time();
    echo unix_to_human($now); echo "<br>";// U.S. time, no seconds
    echo unix_to_human($now, TRUE, 'us'); echo "<br>";// U.S. time with seconds
    echo unix_to_human($now, TRUE, 'eu'); echo "<br>";// Euro time with seconds
    echo "Available Functions Standart unix to human"; echo "<br><br>";

    // Human To Unix
    $now = time();
    $human = unix_to_human($now);
    echo $human; echo "<br>";
    $unix = human_to_unix($human);
    echo $unix; echo "<br>";
    echo "Available Functions Standart human to unix"; echo "<br><br>";

    // Nice Date
    $bad_date = '199605';
    // Should Produce: 1996-05-01
    $better_date = nice_date($bad_date, 'Y-m-d');
    echo $better_date; echo "<br>";
    $bad_date = '9-11-2001';
    // Should Produce: 2001-09-11
    $better_date = nice_date($bad_date, 'Y-m-d');
    echo $better_date; echo "<br>";
    echo "Available Functions Standart Nice Date"; echo "<br><br>";

    // Timespan
    $post_date = '1079621429';
    $now = time();
    $units = 2;
    echo timespan($post_date, $now, $units); echo "<br>";
    echo "Available Functions Standart Timespan"; echo "<br><br>";

    // Day In Month
    echo days_in_month(06, 2005); echo "<br>";
    echo "Available Functions Standart Day In Month"; echo "<br><br>";

    // Date Range
    $range = date_range('2012-01-01', '2012-01-15');
    echo "First 15 days of 2012:";
    foreach ($range as $date)
    {
            echo $date."\n";
    }
    echo "<br>";
    echo "Available Functions Standart Date Range"; echo "<br><br>";

    // Timezone
    echo timezones('UM5'); echo "<br>";
    echo "Available Functions Standart Timezone"; echo "<br><br>";

    // Timezobne Menu
    echo timezone_menu('UM8'); echo "<br>";
    echo "Available Functions Standart Timezone Menu"; echo "<br><br>";

    echo "Available Functions"; echo "<br><br>";
    /*END*/
  }

}

/* End of file Date_helper.php */
/* Location: ./application/controllers/helper/Date_helper.php */