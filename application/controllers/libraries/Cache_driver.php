<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cache_driver extends CI_Controller {

	public function index()
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

}

/* End of file Cache_driver.php */
/* Location: ./application/controllers/libraries/Cache_driver.php */