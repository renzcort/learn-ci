<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_helper extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->helper('file');
  }
  public function index()
  {
    /*Available Function*/
    // Read file
    $string = read_file('./path/to/file.php'); echo "<br>";
    echo "Available Functions Standart Read File"; echo "<br><br>";

    // Write File
    $data = 'Some file data';
    if ( ! write_file('./path/to/file.php', $data))
    {
      echo 'Unable to write the file';
    }
    else
    {
      echo 'File written!';
    }
    echo "<br>";
    echo "Available Functions Standart Write File"; echo "<br><br>";

    // Delete File
    delete_files('./path/to/directory/'); echo "<br>";
    echo "Available Functions Standart Delete File"; echo "<br><br>";

    // Get Filename
    $controllers = get_filenames(APPPATH.'controllers/index.html');
    echo $controllers; echo "<br>";
    echo "Available Functions Standart Get Filename"; echo "<br><br>";

    // Get Dir File Into
    $models_info = get_dir_file_info(APPPATH.'models/index.html');
    echo $models_info; echo "<br>";
    echo "Available Functions Standart Get Dir File Into"; echo "<br><br>";

    // get_mime_by_extension
    $file = 'somefile.png';
    echo $file.' is has a mime type of '.get_mime_by_extension($file);
    echo "<br>";
    echo "Available Functions Standart Get Mime"; echo "<br><br>";

    // symbolic_permissions
    echo symbolic_permissions(fileperms('./index.php'));  // -rw-r--r--
    echo "<br>";
    echo "Available Functions Standart Get Symbolic"; echo "<br><br>";

    // octal_permissions
    echo octal_permissions(fileperms('./index.php')); // 644
    echo "<br>";
    echo "Available Functions Standart Get Octal Permission"; echo "<br><br>";


    echo "Available Functions Standart Send Email"; echo "<br><br>";

    /*END*/
  }

}

/* End of file File_helper.php */
/* Location: ./application/controllers/helper/File_helper.php */