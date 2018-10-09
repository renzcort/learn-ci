<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ftp extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('ftp');
  }

  public function index()
  {
    $config['hostname'] = '';
    $config['username'] = '';
    $config['password'] = '';
    $config['port']     = 21;
    $config['passive']  = FALSE;
    $config['debug']    = TRUE;

    $this->ftp->connect($config);
    // upload
    $this->ftp->upload('/local/path/to/myfile.html', '/public_html/myfile.html', 'ascii', 0775);
    
    // download
    $this->ftp->download('/public_html/myfile.html', '/local/path/to/myfile.html', 'ascii');

    // Renames green.html to blue.html
    $this->ftp->rename('/public_html/foo/green.html', '/public_html/foo/blue.html');

    // Moves blog.html from "joe" to "fred"
    $this->ftp->move('/public_html/joe/blog.html', '/public_html/fred/blog.html');

    // Delete File
    $this->ftp->delete_file('/public_html/joe/blog.html');

    // Delete DIR
    $this->ftp->delete_dir('/public_html/path/to/folder/');

    // List File 
    $list = $this->ftp->list_files('/public_html/');
    print_r($list);

    // mirror
    $this->ftp->mirror('/path/to/myfolder/', '/public_html/myfolder/');

    // Creates a folder named "bar"
    $this->ftp->mkdir('/public_html/foo/bar/', 0755);

    // Chmod "bar" to 755 Permission
    $this->ftp->chmod('/public_html/foo/bar/', 0755);

    $this->ftp->close(); 
  }

  public function retrieved_server()
  {
    $config['hostname'] = 'ftp.example.com';
    $config['username'] = 'your-username';
    $config['password'] = 'your-password';
    $config['debug']        = TRUE;
    $this->ftp->connect($config);

    $list = $this->ftp->list_files('/public_html');
    print_r($list);

    $this->ftp->close();
  }

  public function local_server()
  {
    $config['hostname'] = 'ftp.example.com';
    $config['username'] = 'your-username';
    $config['password'] = 'your-password';
    $config['debug']        = TRUE;
    $this->ftp->connect($config);

    $this->ftp->mirror('/path/to/myfolder/', '/public_html/myfolder/');
    
    $this->ftp->close();
  }

}

/* End of file Ftp.php */
/* Location: ./application/controllers/Ftp.php */