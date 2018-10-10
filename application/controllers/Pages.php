<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

   public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public function index($page = 'home')
  {
   var_dump('expression');
   die(); 
  }

  public function view($page = 'home')
  {
    if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
      show_404();
    }
    $data['title'] = ucfirst($page);

    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer', $data);
  }

  /*Remaping Method Class*/
/*  public function _remap($method) 
  {
    if($method === 'some method')
    {
      $this->$method();
    } else {
      $this->default_method();
    }
  }

  public function _remap($method, $params = array())
  {
    $method = 'process_'.$method;
    if(method_exists($this, $method))
    {
      return call_user_func(array($this, $method), $params);
    }
    show_404();
  }
*/

  // common function
  public function commonFunc() 
  {
    // check php version
    var_dump(is_php('8'));

    // create file 
    if (is_really_writable('file.txt')) {
      echo "1 could write to this if i wanted do";
    } else {
      echo "file is not writeable";
    }

    // set status header 
    set_status_header(200);

    // remove null char
    var_dump(remove_invisible_characters('Java\\0script'));

    var_dump(htmlspecialchars("Java\\0script"));
    var_dump(html_escape('Java\\0script'));

    // get mimes
    get_mimes();

    // check https
    var_dump(is_https());

    // check cli
    var_dump(is_cli());

    // check function exist
    function_useable('function_name');
    function_exists('function_name');

  }

  public function passwordfunc() {
    // check hash
    $hashed = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
    if (password_verify('rasmuslerdorf', $hashed)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }
    echo "<br>";

    $password = ['admin123'];
    $hash = '$2y$10$ItW6fSyYMSS5QY4/hdcD0upKka7T6a07TLpJS5dO1kLLKw0..wWHC';
    $options = array('cost' => 11);

    // hassing password
    $hashing = password_hash('password', PASSWORD_DEFAULT, $password);
    var_dump($hashing);
    echo "<br>";

    // get info hash
    var_dump(password_get_info($hashing));
    echo "<br>";

    // rehash with new value
    if (password_verify('rasmuslerdorf', $hashed)) {
        // Check if a newer hashing algorithm is available
        // or the cost has changed
        if (password_needs_rehash($hashed, PASSWORD_DEFAULT, $options)) {
            // If so, create a new hash, and replace the old one
            $newHash = password_hash('rasmuslerdorf', PASSWORD_DEFAULT, $options);
        }
    }
    $newHash = password_needs_rehash($hashed, PASSWORD_DEFAULT, $options);
    var_dump($newHash);
    echo "<br>";


    $expected  = crypt('12345', '$2a$07$usesomesillystringforsalt$');
    $correct   = crypt('12345', '$2a$07$usesomesillystringforsalt$');
    $incorrect = crypt('apple',  '$2a$07$usesomesillystringforsalt$');
    // hash equals comparison
    var_dump(hash_equals($expected, $correct));
    var_dump(hash_equals($expected, $incorrect));
    echo "<br>";

    // hash set PBKDF2
    $password = "admin123";
    $iterations = 1000;
    // Generate a random IV using openssl_random_pseudo_bytes()
    // random_bytes() or another suitable source of randomness
    $salt = openssl_random_pseudo_bytes(16);
    $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
    echo $hash;
    echo "<br>";

    // Get string length
    var_dump(mb_strlen($hashing));
    echo "<br>";

    // Find position of first occurrence of string in a string
    var_dump(mb_strpos($password, 'd'));
    echo "<br>";

    //et part of string
    var_dump(mb_substr($password, '2', '2'));
    echo "<br>";

    //  Return the values from a single column in the input array
    $records = array(
        array(
            'id' => 2135,
            'first_name' => 'John',
            'last_name' => 'Doe',
        ),
        array(
            'id' => 3245,
            'first_name' => 'Sally',
            'last_name' => 'Smith',
        ),
        array(
            'id' => 5342,
            'first_name' => 'Jane',
            'last_name' => 'Jones',
        ),
        array(
            'id' => 5623,
            'first_name' => 'Peter',
            'last_name' => 'Doe',
        )
    );
    $first_names = array_column($records, 'first_name');
    print_r($first_names);
    echo "<br>";
    
    // Decodes a hexadecimally encoded binary string
    $hex = hex2bin("6578616d706c65206865782064617461");
    var_dump($hex);

  }

  /*error heandling*/
  function error_hendling() 
  {
    if($some_var == '') 
    {
      log_message('error', 'Some variable did not contain a value.');
    } else {
      log_message('debug', 'Some variable was correctly set');
    }
    log_message('info', 'The purpose of some variable is to provide some value.');
  }

  /*caching*/
  function caching() {
    $n = time();
    $this->output->cache($n);

    // remove cache
    $this->output->delete_cache();

    // delete cache for /foo/bar
    $this->output->delete_cache('/foo/bar');
  }


  // profiling
  function profiler() {
    // enable profile
    $this->output->enable_profiler(TRUE);

  }

}

/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */
