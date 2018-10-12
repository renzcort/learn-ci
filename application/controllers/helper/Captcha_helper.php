<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha_helper extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('captcha');
  }

  public function index()
  {
    /*Using the CAPTCHA helper*/
    $vals = array(
        'word'          => 'Random word',
        'img_path'      => './assets/captcha/',
        'img_url'       => 'http://example.com/captcha/',
        'font_path'     => './path/to/fonts/texb.ttf',
        'img_width'     => '150',
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 8,
        'font_size'     => 16,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
    );
    $cap = create_captcha($vals);
    var_dump($cap);
    echo $cap['image']; echo "<br>";
    echo "Using the CAPTCHA helper"; echo "<br><br>";
    /*END*/

    /*Adding a Database*/
    $vals = array(
        'img_path'      => './assets/captcha/',
        'img_url'       => 'http://example.com/captcha/'
    );

    $cap = create_captcha($vals);
    $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
    );

    $query = $this->db->insert_string('captcha', $data);
    $this->db->query($query);

    echo 'Submit the word you see below:'; echo "<br>";
    echo $cap['image'];echo "<br>";
    echo '<input type="text" name="captcha" value="" />';echo "<br><br>";
    // Result 2
    // First, delete old captchas
    $expiration = time() - 7200; // Two hour limit
    $this->db->where('captcha_time < ', $expiration)
            ->delete('captcha');

    // Then see if a captcha exists:
    $_POST['captcha'] = 'captcha';
    $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
    $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
    $query = $this->db->query($sql, $binds);
    $row = $query->row();
    if ($row->count == 0)
    {
            echo 'You must submit the word that appears in the image.';
    }
    echo "<br>";
    echo "Adding a Database"; echo "<br><br>";
    /*END*/
  }

}

/* End of file Captcha_helper.php */
/* Location: ./application/controllers/helper/Captcha_helper.php */