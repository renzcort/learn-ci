<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_parser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
    $this->load->library('parser');
    $this->load->database();
	}

	public function index()
	{
		// parse template
    $data = array(
      'blog_title'    =>  'My Blog Title',
      'blog_heading'  =>  'My Blog Heading',
      'title'         =>  'My Title',
      'blog_entries'  =>  array(
        array('title' => 'Title 1', 'body'  =>  'Body 1'),
        array('title' => 'Title 2', 'body'  =>  'Body 2'),
        array('title' => 'Title 3', 'body'  =>  'Body 3'),
        array('title' => 'Title 4', 'body'  =>  'Body 4'),
        array('title' => 'Title 5', 'body'  =>  'Body 5'),
      )

    ); 
    // $this->parser->parse('libraries/template-parser/index', $data);
    $string = $this->parser->parse('libraries/template-parser/index', $data, TRUE);
    // echo $string;

    // variable pairs with database
    $query = $this->db->query('SELECT * FROM blog');
    $data = array(
      'blog_title'  =>  'My Blog Title',
      'blog_heading'=>  'My Blog Heading',
      'blog_entries'=>  $query->result_array(),
    );
    // $this->parser->parse('libraries/template-parser/index', $data);

    // Usage Notes
    $template = 'Hello, {firstname} {lastname}';
    $data = array(
            'title' => 'Mr',
            'firstname' => 'John',
            'lastname' => 'Doe'
    );
    $this->parser->parse_string($template, $data);

    $template = 'Hello, {firstname} {initials} {lastname}';
    $data = array(
            'title' => 'Mr',
            'firstname' => 'John',
            'lastname' => 'Doe'
    );
    $this->parser->parse_string($template, $data);

    $template = 'Hello, {firstname} {lastname} ({degrees}{degree} {/degrees})';
    $data = array(
            'degrees' => 'Mr',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'titles' => array(
                    array('degree' => 'BSc'),
                    array('degree' => 'PhD')
            )
    );
    $this->parser->parse_string($template, $data);

    $template = 'Hello, {firstname} {lastname} ({degrees}{degree} {/degrees})';
    $data = array(
            'degree' => 'Mr',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'degrees' => array(
                    array('degree' => 'BSc'),
                    array('degree' => 'PhD')
            )
    );
    $this->parser->parse_string($template, $data);

    // View Fragments
    $template = '<ul>{menuitems}
        <li><a href="{link}">{title}</a></li>
    {/menuitems}</ul>';
    $data = array(
            'menuitems' => array(
                    array('title' => 'First Link', 'link' => '/first'),
                    array('title' => 'Second Link', 'link' => '/second'),
            )
    );
    $this->parser->parse_string($template, $data);

    $temp = '';
    $template1 = '<li><a href="{link}">{title}</a></li>';
    $data1 = array(
            array('title' => 'First Link', 'link' => '/first'),
            array('title' => 'Second Link', 'link' => '/second'),
    );
    foreach ($data1 as $menuitem)
    {
            $temp .= $this->parser->parse_string($template1, $menuitem, TRUE);
    }
    $template = '<ul>{menuitems}</ul>';
    $data = array(
            'menuitems' => $temp
    );
    $this->parser->parse_string($template, $data);
    
	}

}

/* End of file Template_parser.php */
/* Location: ./application/controllers/libraries/Template_parser.php */