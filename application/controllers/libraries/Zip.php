<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zip extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('zip');
  }

  public function index()
  {
    var_dump($this->zip);

    $name = 'mydata.txt';
    $data = 'A Data/String';

    // compression file 0-9
    $this->zip->compression_level = 0;
    // create dir
    $this->zip->add_dir('myfolder'); // Creates a directory called "myfolder"

    $this->zip->add_data($name, $data);
        // Write the zip file to a folder on your server. Name it "my_backup.zip"
    $this->zip->archive('/path/to/directory/my_backup.zip');
    // Download the file to your desktop. Name it "my_backup.zip"
    $this->zip->download('my_backup.zip');
  }

  function add_data()
  {
    // add data
    $name = 'mydata1.txt';
    $data = 'A Data String!';
    $this->zip->add_data($name, $data);

    $name = 'mydata2.txt';
    $data = 'Another Data String!';
    $this->zip->add_data($name, $data);

    $data = array(
        'mydata1.txt' => 'A Data String!',
        'mydata2.txt' => 'Another Data String!'
    );
    $this->zip->add_data($data);
  }

  function read_data()
  {
    // read file
    $path = '/path/to/photo.jpg';
    $this->zip->read_file($path);
    // Download the file to your desktop. Name it "my_backup.zip"
    $this->zip->download('my_backup.zip');

    $path = '/path/to/photo.jpg';
    $this->zip->read_file($path, TRUE);
    // Download the file to your desktop. Name it "my_backup.zip"
    $this->zip->download('my_backup.zip');
    $path = '/path/to/photo.jpg';
    $new_path = '/new/path/some_photo.jpg';
    $this->zip->read_file($path, $new_path);
    // Download ZIP archive containing /new/path/some_photo.jpg
    $this->zip->download('my_archive.zip');

    // read DIR
    $path = '/path/to/your/directory/';
    $this->zip->read_dir($path);
    // Download the file to your desktop. Name it "my_backup.zip"
    $this->zip->download('my_backup.zip');
    $path = '/path/to/your/directory/';
    $this->zip->read_dir($path, FALSE);
  }

  function get_data()
  {
    // get Zip
    $name = 'my_bio.txt';
    $data = 'I was born in an elevator...';
    $this->zip->add_data($name, $data);
    $zip_file = $this->zip->get_zip();
  }

  function clear_data()
  {
    // clear Data
    $name = 'my_bio.txt';
    $data = 'I was born in an elevator...';
    $this->zip->add_data($name, $data);
    $zip_file = $this->zip->get_zip();
    $this->zip->clear_data();
    $name = 'photo.jpg';
    $this->zip->read_file("/path/to/photo.jpg"); // Read the file's contents
    $this->zip->download('myphotos.zip');
  }

}

/* End of file Zip.php */
/* Location: ./application/controllers/libraries/Zip.php */