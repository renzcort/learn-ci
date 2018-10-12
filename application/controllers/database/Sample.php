<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sample extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}

	public function index()
	{
		$query = $this->db->query('SELECT username, email, firstname FROM users ');
		foreach ($query->result() as $row) {
			echo $row->username;
			echo $row->email;
			echo $row->firstname;
		}
		echo "Total Result :" .$query->num_rows();
		echo "<br>";

		// Standard Query With Multiple Results 
		$query = $this->db->query('SELECT username, email, firstname FROM users');
		foreach ($query->result_array() as $row) {
			echo $row['username'];
			echo $row['email'];
			echo $row['firstname'];			
		}
		echo "<br>";

		// Standard Que/ry With Single Result
		$query = $this->db->query('SELECT username FROM users LIMIT 1');
		$row = $query->row();
		echo $row->username;
		echo "<br>";

		// Standard Query With Single Result (Array version)
		$query = $this->db->query('SELECT username FROM users LIMIT 1');
		$row = $query->row_array();
		echo $row['username'];
		echo "<br>";

		// Standard Insert
		$title = 'News 1';
		$slug = url_title($title);
		$sql = "INSERT INTO news (title, slug) VALUES (".$this->db->escape($title).", ".$this->db->escape($slug).")";
		$this->db->query($sql);
		echo $this->db->affected_rows();
		echo "<br>";

		// Query Builder Query
		$query = $this->db->get('users');
		foreach ($query->result() as $row) {
			echo $row->username;
		}
		echo "<br>";

		// Query Builder Insert
		$data = array(
        'title' => $title,
        'slug' => $slug
		);
		$this->db->insert('news', $data);  // Produces: INSERT INTO news (title, name, date) VALUES ('{$title}', '{$name}', '{$date}')
	}

	function running()
	{
		// Simplified Queries
		if ($this->db->simple_query('SELECT username FROM users LIMIT 1'))
		{
			echo "Success!";
		}
		else
		{
			echo "Query failed!";
		}

		// Working with Database prefixes manually
		/*$this->db->set_dbprefix('newprefix_');
		$this->db->dbprefix('news'); // outputs newprefix_tablename*/

		// Protecting identifiers
		var_dump($this->db->protect_identifiers('news', TRUE));
		echo "<br>";

		// Escaping Queries
		$title = 'News 2';
		$sql = "INSERT INTO news (title) VALUES(".$this->db->escape($title).")";
		var_dump($sql); 
		echo "<br>";
		$sql = "INSERT INTO news (title) VALUES('".$this->db->escape_str($title)."')";
		var_dump($sql); 
		echo "<br>";
		$search = '20% raise';
		$sql = "SELECT id FROM news WHERE column LIKE '%" .
		    $this->db->escape_like_str($search)."%' ESCAPE '!'";
		var_dump($sql); 
		echo "<br>";

		// Query Bindings
		$sql = "SELECT * FROM news WHERE title = ? AND slug = ? AND body = ?";
		$this->db->query($sql, array('News 123', 'live', 'Rick'));
		// 2
		$sql = "SELECT * FROM news WHERE id IN ? AND title = ?";
		$row = $this->db->query($sql, array(array(3, 4), 'News 1'))->row();
		echo $row->title;
		echo "<br>";

		// Handling Errors
		if ( ! $this->db->simple_query('SELECT `example_field` FROM `example_table`'))
		{
			$error = $this->db->error(); // Has keys 'code' and 'message'
			var_dump($error);
		}
	}

	function generating()
	{
		$query = $this->db->query('SELECT * FROM news');
		// result
		foreach ($query->result() as $row) {
			echo $row->title;
			echo $row->slug;
			echo $row->body;
		}
		echo "<br>";
		// result 2
		/*foreach ($query->result('news') as $key) {
			echo $row->title;
			echo $row->reverse_name();
		}
		echo "<br>";*/

		// reusult Array
		foreach ($query->result_array() as $row) {
			echo $row['title'];
			echo $row['slug'];
			echo $row['body'];
		}
		echo "<br>";

		// Row
		$row = $query->row();
		if (isset($row)) {
			echo $row->title;
			echo $row->slug;
			echo $row->body;
		}
		echo "<br>";
		// specific row parameter
		var_dump($query->row(5));
		echo "<br>";
		// add second string parameter
		/*$row = $query->row(1, 'News');
		echo $row->title;
		echo $row->reverse_name();
		echo "<br>";*/

		// ROW Array
		$row = $query->row_array();
		if (isset($row)) {
			echo $row['title'];
			echo $row['slug'];
			echo $row['body'];
		}
		echo "<br>";
		// specsific row
		var_dump($query->row_array(5));
		echo "<br>";

		// you can walk forward/backwards/first/last
		var_dump($query->first_row());
		echo "<br>";
		var_dump($query->last_row());
		echo "<br>";
		var_dump($query->next_row());
		echo "<br>";
		var_dump($query->previous_row());
		echo "<br>";

		// unbuffered row
		while ($row = $query->unbuffered_row()) {
			echo $row->title;
			echo $row->slug;
			echo $row->body;	
		}
		$query->unbuffered_row();               // object
		$query->unbuffered_row('object');       // object
		$query->unbuffered_row('array');        // associative array
		echo "<br>";

		// Custom Result Objects
		$rows = $query->custom_result_object('User');
		foreach ($rows as $row)
		{
	    echo $row->id;
	    echo $row->title;
	    // echo $row->last_login('Y-m-d');
		}
		echo "<br>";
		// custom_row_object
		$row = $query->custom_row_object(0, 'User');
		if (isset($row))
		{
      echo $row->title;   // access attributes
      // echo $row->last_login('Y-m-d');   // access class methods
		}
		echo "<br>";

		// Result Helper Methods
		// num rows
		echo $query->num_rows();
		echo "<br>";
		// num field
		echo $query->num_fields();
		echo "<br>";
		// Free Result
		foreach ($query->result() as $row)
		{
	    echo $row->title;
		}
		echo $query->free_result();  // The $query result object will no longer be available
		echo "<br>";
		// Data Seek
		/*$query->data_seek(0); // Skip the first 5 rows
		$row = $query->unbuffered_row();
		echo "<br>";*/
	}

	function helper_method()
	{
		$query = $this->db->query('SELECT * FROM news');
		// The insert ID number
		echo $this->db->insert_id();
		echo "<br>";
		// Displays the number of affected rows
		echo $this->db->affected_rows();
		echo "<br>";
		// Returns the last query that was run 
		echo $this->db->last_query();
		echo "<br>";

		// Information About Your Database
		// number of rows in a particular table
		echo $this->db->count_all('news');
		echo "<br>";
		// Outputs the database platform you are running 
		echo $this->db->platform();
		echo "<br>";
		// Outputs the database version you are running
		echo $this->db->version();
		echo "<br>";

		// Making Your Queries Easier
		// simplifies the process of writing database inserts
		$data = array(
			'title'	=>	'NEWS BARU',
			'body'	=>	'BODY BARU',
		);
		echo $this->db->insert_string('news', $data);
		echo "<br>";
		// implifies the process of writing database updates
		$data = array(
			'title'	=>	'NEWS BARU Update',
			'body'	=>	'BODY BARU Update',
		);
		$where = "id = 1";
		echo $this->db->update_string('news', $data, $where);
		echo "<br>";
	}

	function query_builder()
	{
		// Selecting Data 
		var_dump($this->db->get('news')); echo "<br><br>";
		// The second and third parameters enable you to set a limit and offset clause:
		 var_dump($this->db->get('news', 10, 20)); echo "<br><br>";
		// You’ll notice that the above function is assigned to a variable named $query, which can be used to show the results:
		$query = $this->db->get('news');
		foreach ($query->result() as $row) {
			echo $row->title;
		}
		echo "<br><br>";
		
		// This method simply returns the SQL query as a string.
		$sql = $this->db->get_compiled_select('news');
		echo $sql;
		echo $this->db->select('title','body')->get_compiled_select();
		echo "<br><br>";
		
		// Identical to the above function except that it permits you to add a “where” clause in the second parameter
		$limit = 5;
		$offset = 2;
		var_dump($this->db->get_where('news', array('id' => 5), $limit, $offset));
		echo "<br><br>";
		
		// Permits you to write the SELECT portion of your query
		$this->db->select('title', 'body');
		var_dump($this->db->get('news')); echo "<br><br>";
		//result 2
		$this->db->select('(SELECT SUM(title) FROM news) AS amount_paid', FALSE);
		var_dump($this->db->get('news')); echo "<br><br>";

		// MAX 
		$this->db->select_max('id');
		var_dump($this->db->get('news')); echo "<br><br>";
		// MAX 2
		$this->db->select_max('id', 'member_age');
		var_dump($this->db->get('news')); // Produces: SELECT MAX(age) as member_age FROM members
		echo "<br><br>";

		// MIN
		$this->db->select_min('id');
		var_dump($this->db->get('news')); echo "<br><br>";

		// AVG
		$this->db->select_avg('id');
		var_dump($this->db->get('news')); echo "<br><br>";

		// SUM
		$this->db->select_sum('id');
		var_dump($this->db->get('news')); echo "<br><br>";

		// FROM
		$this->db->select('*');
		$this->db->from('news');
		var_dump($this->db->get()); echo "<br><br>";

		// JOIN
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('blog', 'blog.id = news.id');
		var_dump($this->db->get()); echo "<br><br>";		
		echo 'Selecting Data'; echo "<br><br>";	
		/*END*/
		

		/*Looking for Specific Data*/
		// This function enables you to set WHERE clauses using one of four methods
		// 1 Custom key/value method:
		$this->db->where('id', 2);
		$this->db->where('title', 'NEWS 10');
		var_dump($this->db->get('news')); echo "<br><br>";		
		// 2 Custom key/value method:
		$this->db->where('title !=', 'NEWS 1');
		$this->db->where('id <', '2'); // Produces: WHERE name != 'Joe' AND id < 45
		var_dump($this->db->get('news')); echo "<br><br>";		
		// 3 Custom key/value method:
		$array = array('title' => 'NEWS 1');
		$this->db->where($array);
		var_dump($this->db->get('news')); echo "<br><br>";		
		var_dump($this->db->get('news')); echo "<br><br>";		
		$array = array('title !=' => 'NEWS 10', 'id <' => 3);
		$this->db->where($array);
		var_dump($this->db->get('news')); echo "<br><br>";		
		// 4 Custom key/value method:
		$where = "title='Joe' AND body='boss' OR id=1";
		$this->db->where($where);
		var_dump($this->db->get('news')); echo "<br><br>";		

		// multiple instances are joined by OR
		$this->db->where('title !=', 'NEWS 1');
		$this->db->or_where('id >', 5);  // Produces: WHERE name != 'Joe' OR id > 50
		var_dump($this->db->get('news')); echo "<br><br>";		

		//field NOT IN (‘item’, ‘item’) 
		$names = array('NEWS 1', 'NEWS 2');
		$this->db->where_in('title', $names);
		var_dump($this->db->get('news')); echo "<br><br>";		

		// OR WHERE IN
		$names = array('NEWS 1', 'NEWS 2');
		$this->db->or_where_in('title', $names);
		var_dump($this->db->get('news')); echo "<br><br>";		
		// Produces: OR username IN ('Frank', 'Todd', 'James')
		
		// WHERE NOT IN
		$names = array('NEWS 1', 'NEWS 2');
		$this->db->where_not_in('title', $names);
		var_dump($this->db->get('news')); echo "<br><br>";		

		// OR WHERE NOT IN
		$names = array('NEWS 1', 'NEWS 2');
		$this->db->where_not_in('title', $names);
		var_dump($this->db->get('news')); echo "<br><br>";				
		echo 'Looking for Specific Data'; echo "<br><br>";	
		/*END*/




		/*Looking for Similar Data*/
		// Like
		$this->db->like('title', 'match');
		var_dump($this->db->get('news')); echo "<br><br>";		
		// Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
		$this->db->like('title', 'match');
		$this->db->like('body', 'match');
		var_dump($this->db->get('news')); echo "<br><br>";		
		// WHERE `title` LIKE '%match%' ESCAPE '!' AND  `body` LIKE '%match% ESCAPE '!'
		$this->db->like('title', 'match', 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
		$this->db->like('title', 'match', 'after');     // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
		$this->db->like('title', 'match', 'both');      // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
		var_dump($this->db->get('news')); echo "<br><br>";		
		// WHERE `title` LIKE '%match%' ESCAPE '!' AND  `page1` LIKE '%match%' ESCAPE '!' AND  `page2` LIKE '%match%' ESCAPE '!'
		// Associative array method:
		$array = array('title' => 'NEWS 1', 'blog' => 'blog 2');
		/*$this->db->like($array);
		var_dump($this->db->get('news')); echo "<br><br>";*/		
		
		// OR LIKE
		/*$this->db->like('title', 'match'); $this->db->or_like('body', $array);
		var_dump($this->db->get('news')); echo "<br><br>";*/		
		// WHERE `title` LIKE '%match%' ESCAPE '!' OR  `body` LIKE '%match%' ESCAPE '!'
		
		// NOT LIKE
		$this->db->not_like('title', 'match');  // WHERE `title` NOT LIKE '%match% ESCAPE '!'
		var_dump($this->db->get('news')); echo "<br><br>";		

		// OR NOT LIKE
		$this->db->like('title', 'match');
		$this->db->or_not_like('body', 'match');
		var_dump($this->db->get('news')); echo "<br><br>";		
		// WHERE `title` LIKE '%match% OR  `body` NOT LIKE '%match%' ESCAPE '!'
		
		// GROUP BY
		$this->db->group_by("title"); // Produces: GROUP BY title
		var_dump($this->db->get('news')); echo "<br><br>";		
		// array of multiple values
		$this->db->group_by(array("title", "body"));  // Produces: GROUP BY title, date
		var_dump($this->db->get('news')); echo "<br><br>";		

		// DISTINCT
		$this->db->distinct();
		var_dump($this->db->get('news')); // Produces: SELECT DISTINCT * FROM table
		echo "<br><br>";		

		// HAVING
		$this->db->having('id = 5');  // Produces: HAVING id = 5
		$this->db->having('id',  5);  // Produces: HAVING id = 5
		var_dump($this->db->get('news')); echo "<br><br>";		
		// multiple values
		$this->db->having(array('title =' => 'My Title', 'id <' => 2));
		var_dump($this->db->get('news')); echo "<br><br>";		
		// Produces: HAVING title = 'My Title', id < 5
		// Third valuew
		$this->db->having('id',  5);  // Produces: HAVING `id` = 5 in some databases such as MySQL
		$this->db->having('id',  5, FALSE);  // Produces: HAVING id = 5
		var_dump($this->db->get('news')); echo "<br><br>";		

		// OR HAVING
		$this->db->or_having('id = 5');  // Produces: HAVING user_id = 45
		var_dump($this->db->get('news')); echo "<br><br>";		
		echo 'Looking for Similar Data'; echo "<br><br>";	
		/*END*/




		/*Ordering results*/
		// ORDER BY
		$this->db->order_by('title', 'DESC');
		var_dump($this->db->get('news')); echo "<br><br>";		
		// Produces: ORDER BY `title` DESC
		// You can also pass your own string in the first parameter
		$this->db->order_by('title DESC, body ASC');
		var_dump($this->db->get('news')); echo "<br><br>";		
		// Produces: ORDER BY `title` DESC, `name` ASC
		//  multiple function
		$this->db->order_by('title', 'DESC');
		$this->db->order_by('body', 'ASC');
		var_dump($this->db->get('news')); echo "<br><br>";		
		// Produces: ORDER BY `title` DESC, `name` ASC
		// RANDOM direction option
		$this->db->order_by('title', 'RANDOM');
		// Produces: ORDER BY RAND()
		$this->db->order_by(42, 'RANDOM');
		// Produces: ORDER BY RAND(42)
		var_dump($this->db->get('news')); echo "<br><br>";		
		echo 'Ordering results'; echo "<br><br>";	
		/*END*/




		/*Limiting or Counting Results*/
		// LIMIT
		$this->db->limit(10);  // Produces: LIMIT 10
		var_dump($this->db->get('news')); echo "<br><br>";		
		// The second parameter lets you set a result offset
		$this->db->limit(10, 20);  // Produces: LIMIT 20, 10 (in MySQL.  Other databases have slightly different syntax)
		var_dump($this->db->get('news')); echo "<br><br>";		

		// Count All Result
		echo $this->db->count_all_results('news');  // Produces an integer, like 25
		$this->db->like('title', 'match');
		$this->db->from('news');
		echo $this->db->count_all_results(); echo "<br><br>";	 // Produces an integer, like 17 
		// If you need to keep them, you can pass FALSE as the second parameter
		echo $this->db->count_all_results('news', FALSE); echo "<br><br>";	

		// COUNT ALL
		echo $this->db->count_all('news'); echo "<br><br>";	  // Produces an integer, like 25
		echo 'Limiting or Counting Results'; echo "<br><br>";	
		/*END*/



		/*Query grouping*/
		/*echo $this->db->select('*')->from('news')
        ->group_start()
                ->where('title', 'NEWS 1')
                ->or_group_start()
                        ->where('body', 'body')
                        ->where('id', 5)
                ->group_end()
        ->group_end()
        ->where('text', 'd')
				->get(); echo "<br><br>";
				// Generates:
				// SELECT * FROM (`my_table`) WHERE ( `a` = 'a' OR ( `b` = 'b' AND `c` = 'c' ) ) AND `d` = 'd'
		echo 'Query grouping'; echo "<br><br>";	*/
		/*EMD*/

		/*Inserting Data*/
		// INSERT
		$data = array(
        'title' => 'My title',
        'body' => 'My Name',
		);
		$this->db->insert('news', $data);
		// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
		// Here is an example using an object:
		/*$object = new Myclass;
		$this->db->insert('news', $object);*/
		// Produces: INSERT INTO mytable (title, content, date) VALUES ('My Title', 'My Content', 'My Date')

		// get Compiled insert
		$data = array(
        'title' => 'My title',
        'body'  => 'My Name',
		);
		$sql = $this->db->set($data)->get_compiled_insert('news');
		echo $sql; echo "<br><br>";
		// Produces string: INSERT INTO mytable (`title`, `name`, `date`) VALUES ('My title', 'My name', 'My date')
		// The second parameter enables 
		echo $this->db->set('title', 'My Title')->get_compiled_insert('news', FALSE); echo "<br><br>";
		// Produces string: INSERT INTO mytable (`title`) VALUES ('My Title')
		echo $this->db->set('content', 'My Content')->get_compiled_insert(); echo "<br><br>";
		// Produces string: INSERT INTO mytable (`title`, `content`) VALUES ('My Title', 'My Content')
		
		// INSERT BATCH
		$data = array(
        array(
                'title' => 'My title',
                'body' => 'My body',
        ),
        array(
                'title' => 'Another title',
                'body' => 'Another Name',
        )
		);
		$this->db->insert_batch('news', $data);
		// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date'),  ('Another title', 'Another name', 'Another date')
		echo 'Inserting Data'; echo "<br><br>";	
		/*END*/

		/*Updating Data*/
		// REPLACE
		$data = array(
        'title' => 'My title',
        'body'  => 'My Name',
		);
		$this->db->replace('news', $data);
		// Executes: REPLACE INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
		
		// SET
		$this->db->set('title', 'NEWS 12');
		$this->db->insert('news');  // Produces: INSERT INTO mytable (`name`) VALUES ('{$name}')
		// set Update
		$this->db->set('title', 'title+1', FALSE);
		$this->db->where('id', 2);
		$this->db->update('news'); // gives UPDATE news SET title = title+1 WHERE id = 2
		echo "<br><br>";
		$this->db->set('title', 'title+1');
		$this->db->where('id', 2);
		$this->db->update('news'); // gives UPDATE `mytable` SET `title` = 'title+1' WHERE `id` = 2
		// You can also pass an associative array to this function:
		$data = array(
        'title' => 'My title',
        'body'  => 'My Name',
		);
		$this->db->set($data);
		$this->db->insert('news');
		// UPDATE
		$data = array(
        'title' => 'My title',
        'body'  => 'My Name',
		);
		$this->db->where('id', 3);
		$this->db->update('news', $data);
		// Produces:
		//
		//      UPDATE mytable
		//      SET title = '{$title}', name = '{$name}', date = '{$date}'
		//      WHERE id = $id
		// Or you can supply an object
		/*
		class Myclass {
		        public $title = 'My Title';
		        public $content = 'My Content';
		        public $date = 'My Date';
		}
		*/
		/*$object = new Myclass;
		$this->db->where('id', 3);
		$this->db->update('news', $object);*/
		// Produces:
		//
		// UPDATE `mytable`
		// SET `title` = '{$title}', `name` = '{$name}', `date` = '{$date}'
		// WHERE id = `$id`
		
		// UPDATE BARCH
		$data = array(
		   array(
		      'title' => 'My title' ,
		      'body' => 'My body 2' ,
		   ),
		   array(
		      'title' => 'Another title' ,
		      'body' => 'Another Name 2' ,
		   )
		);

		$this->db->update_batch('news', $data, 'title');
		// Produces:
		// UPDATE `mytable` SET `name` = CASE
		// WHEN `title` = 'My title' THEN 'My Name 2'
		// WHEN `title` = 'Another title' THEN 'Another Name 2'
		// ELSE `name` END,
		// `date` = CASE
		// WHEN `title` = 'My title' THEN 'My date 2'
		// WHEN `title` = 'Another title' THEN 'Another date 2'
		// ELSE `date` END
		// WHERE `title` IN ('My title','Another title')
		echo 'Updating Data'; echo "<br><br>";	
		/*END*/

		// Deleting Data
		// delete
		$this->db->delete('news', array('id' => 3));  // Produces: // DELETE FROM mytable  // WHERE id = $id
		// You can also use the where() or or_where() functions 
		$this->db->where('id', 3);
		$this->db->delete('news');
		// Produces:
		// DELETE FROM mytable
		// WHERE id = $id
		// An array of table names can be passed into delete() if you would like to delete data from more than 1 table.
		$tables = array('news', 'users', 'blog');
		$this->db->where('id', '3');
		$this->db->delete($tables);

		// EMPTY TABLE
		$this->db->empty_table('news'); // Produces: DELETE FROM mytable

		// TRUNCUTE
		$this->db->from('news');
		$this->db->truncate();
		// or
		$this->db->truncate('news');
		// Produce:
		// TRUNCATE news
		
		// COMPILED DELETE
		// $this->db->get_compiled_insert();
		echo 'Deleting Data'; echo "<br><br>";	
		/*END*/

		// Method Chaining
		$query = $this->db->select('title')
                ->where('id', 4)
                ->limit(10, 20)
                ->get('news');
   	var_dump($query); echo "<br><br>";
		echo 'Method Chaining'; echo "<br><br>";	
   	/*END */

   	/*Query Builder Caching*/
   	$this->db->start_cache();
		$this->db->select('title');
		$this->db->stop_cache();
		var_dump($this->db->get('news')); echo "<br><br>";
		//Generates: SELECT `title` FROM (`news`)

		$this->db->select('title');
		var_dump($this->db->get('news')); echo "<br><br>";
		//Generates:  SELECT `title`, `title` FROM (`news`)

		$this->db->flush_cache();
		$this->db->select('title');
		var_dump($this->db->get('news')); echo "<br><br>";
		//Generates:  SELECT `field2` FROM (`news`)
		echo 'Query Builder Caching'; echo "<br><br>";	
		/*END Caching*/

		/*Resetting Query Builder*/
		// Note that the second parameter of the get_compiled_select method is FALSE
		$sql = $this->db->select(array('title','body'))
		                                ->where('id',5)
		                                ->get_compiled_select('news', FALSE);
		echo $sql; echo "<br><br>";
		// ...
		// Do something crazy with the SQL code... like add it to a cron script for
		// later execution or something...
		// ...
		var_dump($this->db->get()->result_array()); echo "<br><br>";
		// Would execute and return an array of results of the following query:
		// SELECT field1, field1 from mytable where field3 = 5;
		echo 'Resetting Query Builder'; echo "<br><br>";	
		/*END*/
	}

	function transaction()
	{
		/*Running Transactions*/
		$this->db->trans_start();
		$this->db->query('SELECT * FROM news');
		$this->db->query('SELECT * FROM blog');
		$this->db->query('SELECT * FROM users');
		$this->db->trans_complete();
		echo "Running Transactions"; echo "<br><br>";
		/*END*/

		/*Strict Mode*/
		$this->db->trans_strict(FALSE);
		echo "Strict Mode"; echo "<br><br>";
		/*END*/

		/*Managing Errors*/
		if ($this->db->trans_status() === FALSE)
		{
	    // generate an error... or use the log_message() function to log your error
	    echo "string ERRORS";
		}
		echo "Managing Errors"; echo "<br><br>";
		/*END*/

		/*Disabling Transactions*/
		$this->db->trans_off();
		$this->db->trans_start();
		$this->db->query('SELECT * FROM news');
		$this->db->query('SELECT * FROM blog');
		$this->db->query('SELECT * FROM users');
		$this->db->trans_complete();
		echo "Disabling Transactions"; echo "<br><br>";
		/*END*/

		/*Test Mode*/
		$this->db->trans_start(TRUE);
		$this->db->query('SELECT * FROM news');
		$this->db->trans_complete();
		echo "Test Mode"; echo "<br><br>";
		/*END*/

		/*Running Transactions Manually*/
		$this->db->trans_begin();
		$this->db->query('SELECT * FROM news');
		$this->db->query('SELECT * FROM blog');
		$this->db->query('SELECT * FROM users');
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
		echo "Running Transactions Manually"; echo "<br><br>";
		/*END*/
	}

	function metadata() 
	{
		/*List the Tables in Your Database*/
		/*Table MetaData*/
		$tables = $this->db->list_tables();
		foreach ($tables as $table)
		{
	    echo $table;
		}
		echo "<br><br>";
		echo "List the Tables in Your Database"; echo "<br><br>";
		/*END*/

		/*Determine If a Table Exists*/
		// Check table
		var_dump($this->db->table_exists('news'));
		echo "<br><br>";
		echo "Determine If a Table Exists"; echo "<br><br>";
		echo "Table MetaData"; echo "<br><br>";
		/*END Table MetaData*/
		/*END*/

		/*Field MetaData*/
		// List the Field
		$fields = $this->db->list_fields('news');
		foreach ($fields as $field)
		{
		        echo $field;
		}
		echo "<br><br>";
		$query = $this->db->query('SELECT * FROM news');
		foreach ($query->list_fields() as $field)
		{
		  echo $field;
		}
		echo "<br><br>";
		echo "List the Fields in a Table"; echo "<br><br>";

		// Determine If a Field is Present in a Table
		// Check field Exist
		var_dump($this->db->field_exists('title', 'news'));
		if ($this->db->field_exists('title', 'news'))
		{
	    // some code...
	    echo "field exist";
		} else {
	    echo "field not exist";
		}
		echo "<br><br>";
		echo "Determine If a Field is Present in a Table"; echo "<br><br>";

		// Retrieve Field Metadata
		$fields = $this->db->field_data('news');
		foreach ($fields as $field)
		{
	    echo $field->name;
			echo "<br>";
	    echo $field->type;
			echo "<br>";
	    echo $field->max_length;
			echo "<br>";
      echo $field->primary_key;
			echo "<br>";
		}
		echo "<br><br>";
		// reseult 2
		$query = $this->db->query("SELECT * FROM news");
		$fields = $query->field_data();
		foreach ($fields as $field)
		{
	    echo $field->name;
			echo "<br>";
	    echo $field->type;
			echo "<br>";
	    echo $field->max_length;
			echo "<br>";
      echo $field->primary_key;
			echo "<br>";
		}
		echo "Retrieve Field Metadata"; echo "<br><br>";
		echo "Field MetaData"; echo "<br><br>";
		/*END*/
	}

	function custom_call()
	{
		/*Custom Function Calls*/
		$this->db->call_function('get_client_info');

		// connecting ID
		$this->db->conn_id;

		// The result ID can be accessed from within your result object
		$query = $this->db->query("SELECT * FROM news");
		$query->result_id;
		echo "Custom Function Calls"; echo "<br><br>";
		/*END*/
	}

	function util()
	{
		/*Initializing the Utility Class*/
		$this->load->dbutil();
		// sample other
		// $this->myutil = $this->load->dbutil($this->other_db, TRUE);
		var_dump($this->dbutil);
		echo "Initializing the Utility Class"; echo "<br><br>";
		/*END*/

		/*Using the Database Utilities*/
		// Retrieve list of database names
		$dbs = $this->dbutil->list_databases();
		foreach ($dbs as $db)
		{
		        echo $db;
		        echo "<br>";
		}
		echo "<br>";
		echo "Using the Database Utilities"; echo "<br><br>";

		// Determine If a Database Exists
		if ($this->dbutil->database_exists('db_ci_learn'))
		{
			// some code...
		  echo "databse exist";
		} else {
		  echo "databse exist";
		}
		echo "<br>";
		echo "Determine If a Database Exists"; echo "<br><br>";

		// Optimize a Table
		if ($this->dbutil->optimize_table('news'))
		{
	    echo 'Success!';
		}
		echo "<br>";
		echo "Optimize a Table"; echo "<br><br>";

		// Repair a Table
		if ($this->dbutil->repair_table('news'))
		{
			echo 'Success!';
		}
		echo "<br>";
		echo "Repair a Table"; echo "<br><br>";

		// Optimize a Database
		$result = $this->dbutil->optimize_database();
		if ($result !== FALSE)
		{
	    print_r($result);
		}
		echo "<br>";
		echo "Optimize a Database"; echo "<br><br>";

		// Export a Query Result as a CSV File
		$query = $this->db->query("SELECT * FROM news");
		echo $this->dbutil->csv_from_result($query);
		echo "<br>";
		// Result 2
		$delimiter = ",";
		$newline = "\r\n";
		$enclosure = '"';
		echo $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
		echo "<br>";
		echo "Export a Query Result as a CSV File"; echo "<br><br>";

		// Export a Query Result as an XML Document
		$query = $this->db->query("SELECT * FROM news");
		$config = array (
	    'root'          => 'root',
	    'element'       => 'element',
	    'newline'       => "\n",
	    'tab'           => "\t"
		);
		echo $this->dbutil->xml_from_result($query, $config);
		echo "Export a Query Result as an XML Document"; echo "<br><br>";
		/*END*/

		/*Backup Your Database*/
		// Load the DB utility class
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/path/to/mybackup.gz', $backup);
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		// force_download('mybackup.gz', $backup);

		// Setting Backup Data
		$prefs = array(
        'tables'        => array('table1', 'table2'),   // Array of tables to backup.
        'ignore'        => array(),                     // List of tables to omit from the backup
        'format'        => 'txt',                       // gzip, zip, txt
        'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
		);
		// $this->dbutil->backup($prefs);
		echo "Backup Your Database"; echo "<br><br>";
		/*END*/


	}

}

/* End of file Sample.php */
/* Location: ./application/controllers/database/Sample.php */

class User {

  public $id;
  public $title;
  public $username;

  protected $last_login;

  public function last_login($format)
  {
    return $this->last_login->format($format);
  }

  public function __set($name, $value)
  {
    if ($name === 'last_login')
    {
      $this->last_login = DateTime::createFromFormat('U', $value);
    }
  }

  public function __get($name)
  {
    if (isset($this->$name))
    {
      return $this->$name;
    }
  }
}