<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

  public $title;
  public $content;
  public $date;

  public function get_last_ten_enteries()
  {
    $query = $this->db->get('entries', 10);
    return $query->result();
  }

  public function insert_entry()
  {
    $this->title = $_POST['title'];
    $this->content = $_POST['content'];
    $this->date = time();

    $this->db->insert('entries', $this);
  }

  public function update_entry()
  {
    $this->title = $_POST['title'];
    $this->content = $_POST['content'];
    $this->date = time();

    $this->db->update('entries', $this, array('id' => $_POST['id']));
  }

}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */