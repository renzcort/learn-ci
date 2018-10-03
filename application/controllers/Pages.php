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

  /*bencmark*/
  function benchmark()
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

  // cache
  function cache_driver()
  {
    $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    if (! $foo = $this->cache->get('foo')) {
      echo "Saving to the cache <br />";
      $foo = 'foobar';

      // save info the cache for 5 minutes
      $this->cache->save('foo', $foo, 300);
    }
    echo $foo;
    echo "<br>";

    $this->load->driver('cache', array('adapter' => 'apc', 'bcakup' => 'file', 'key_prefix' => 'my_'));
    // will get the cache entry named my_foo
    $this->cache->get('foo');


    // is_supported
    if ($this->cache->apc->is_supported()) {
      if ($data = $this->cache->apc->get('foo')) {
        echo "string";
        echo "<br>";
      }
    }

    var_dump($this->cache->apc->is_supported());
    var_dump($this->cache->get('foo'));
    echo "<br>";

    // save
    $bar = 'bar';
    var_dump($this->cache->save('bar', $bar));
    var_dump($this->cache->get('bar'));
    echo "<br>";

    // delete
    $this->cache->delete('bar');
    var_dump($this->cache->get('bar'));
    echo "<br>";

    // increment
    var_dump($this->cache->increment('iterator'));
    var_dump($this->cache->increment('iterator', 3));
    echo "<br>";

    // decrement
    var_dump($this->cache->decrement('iterator'));
    var_dump($this->cache->decrement('iterator', 3));
    echo "<br>";

    // clean
    var_dump($this->cache->clean());
    echo "<br>";

    // cache info
    var_dump($this->cache->cache_info());
    echo "<br>";

    // get metadata
    var_dump($this->cache->get_metadata('bar'));
    echo "<br>";

    
    $this->load->driver('cache');
    // Driver APC
    // var_dump($this->cache->apc->save('foo', 'bar', 10));

    // mamcached caching
    var_dump($this->cache->memcached->save('foo', 'bar', 10));

    // wincache caching
    var_dump($this->cache->wincache->save('foo', 'bar', 10));

    // redis
    var_dump($this->cache->redis->save('foo', 'bar', 10));
  }

  function calendar() 
  {
    // $this->load->library('calendar');
    // $this->calendar;
    // echo $this->calendar->generate();
    // echo "<br>";

    // // display month
    // echo $this->calendar->generate(2018, 7);
    // echo "<br>";

    // // passing data to calendar
    // $data = array(
    //     3  => 'http://example.com/news/article/2006/06/03/',
    //     7  => 'http://example.com/news/article/2006/06/07/',
    //     13 => 'http://example.com/news/article/2006/06/13/',
    //     26 => 'http://example.com/news/article/2006/06/26/'
    // );
    // echo $this->calendar->generate(2018, 7, $data);
    // echo "<br>";

    // // setting display preferences
    // $prefs = array(
    //     'start_day'    => 'saturday',
    //     'month_type'   => 'short',
    //     'day_type'     => 'short'
    // );
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate();
    // echo "<br>";

    // // showing next/prev month link
    // $prefs = array(
    //     'show_next_prev'  =>  TRUE,
    //     'next_prev_url'   =>  'http://example.com/index.php/calendar/show/'
    // );
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
    // echo "<br>";

    // // creating template
    // $prefs['template'] = '

    //     {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

    //     {heading_row_start}<tr>{/heading_row_start}

    //     {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
    //     {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
    //     {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

    //     {heading_row_end}</tr>{/heading_row_end}

    //     {week_row_start}<tr>{/week_row_start}
    //     {week_day_cell}<td>{week_day}</td>{/week_day_cell}
    //     {week_row_end}</tr>{/week_row_end}

    //     {cal_row_start}<tr>{/cal_row_start}
    //     {cal_cell_start}<td>{/cal_cell_start}
    //     {cal_cell_start_today}<td>{/cal_cell_start_today}
    //     {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

    //     {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
    //     {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

    //     {cal_cell_no_content}{day}{/cal_cell_no_content}
    //     {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

    //     {cal_cell_blank}&nbsp;{/cal_cell_blank}

    //     {cal_cell_other}{day}{/cal_cel_other}

    //     {cal_cell_end}</td>{/cal_cell_end}
    //     {cal_cell_end_today}</td>{/cal_cell_end_today}
    //     {cal_cell_end_other}</td>{/cal_cell_end_other}
    //     {cal_row_end}</tr>{/cal_row_end}

    //     {table_close}</table>{/table_close}
    // ';
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate();

    // $prefs['template'] = array(
    //     'table_open'           => '<table class="calendar">',
    //     'cal_cell_start'       => '<td class="day">',
    //     'cal_cell_start_today' => '<td class="today">'
    // );
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate();

    // initialize
    $this->load->library('calendar');
    //initialize 
    $prefs = array(
        'month_type'  => 'long',
        'start_day'   => 'sunday'
    );
    echo $this->calendar->initialize($prefs);
    
    // month
    echo $this->calendar->get_month_name(2);   
    
    // get_day_names
    echo $this->calendar->get_day_names($day_type = 'long');   
    
    // adjust_date
    print_r($this->calendar->adjust_date(13, 2014));   

    // get_total_days
    echo $this->calendar->get_total_days(2, 2012);

    // default_template
    echo $this->calendar->default_template();
    
    // parse_template
    echo $this->calendar->parse_template();
  }

  function cart()
  {
    $this->load->library('cart');
    $this->cart;

    $data = array(
      'id'    =>  'sku_123ABC',
      'qty'   =>  1,
      'price' =>  100.89,
      'name'  =>  'Baju',
      'options' =>  array('size' => 'S', 'color' => 'Red')
    );
    $this->cart->insert($data);

    // multiple insert data
    $data = array(
        array(
                'id'      => 'sku_123ABC',
                'qty'     => 1,
                'price'   => 39.95,
                'name'    => 'T-Shirt',
                'options' => array('Size' => 'L', 'Color' => 'Red')
        ),
        array(
                'id'      => 'sku_567ZYX',
                'qty'     => 1,
                'price'   => 9.95,
                'name'    => 'Coffee Mug'
        ),
        array(
                'id'      => 'sku_965QRS',
                'qty'     => 1,
                'price'   => 29.95,
                'name'    => 'Shot Glass'
        )
    );
    $this->cart->insert($data);
    $this->load->view('cart/index');
  }

  function cart_update()
  {
    $post = array();
    $i = 1;
    foreach ( $this->input->post() as $key => $value )
    { 
        var_dump($value);
        die();
        if ($key == 'rowid') {
          $post['{$i}'.$key] = $this->input->post($key);
          $i = $i++;
        } else {
          $post[$key] = $this->input->post($key);
        }
    }
    var_dump($post); 
    die();
    $data = array(
      'rowid' =>  $_POST['[rowid]']
    );
  }
}

/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */
