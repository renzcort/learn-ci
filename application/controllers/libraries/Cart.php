<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index()
	{
		$this->load->library('cart');

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
    // $this->cart->destroy();
    $this->cart->insert($data);
    $this->load->view('libraries/cart/index');
	}

  function cart_add()
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
  }

  function cart_update()
  {
    $this->load->library('cart');
    $post = array();
    foreach ( $this->input->post() as $key => $value )
    { 
      /*var_dump($this->cart->get_item($value['rowid']));
      echo "<br/>";
      var_dump($this->cart->has_options($value['rowid']));
      echo "<br/>";
      var_dump($this->cart->product_options($value['rowid']));
      die();*/
      $post[$key] = $this->input->post($key);
    }
    $this->cart->update($post);
    redirect('pages/cart','refresh');
  }

  function cart_delete()
  {
   $this->load->library('cart');
    $post = array();
    foreach ( $this->input->post() as $key => $value )
    { 
      $this->cart->remove($value['rowid']);
      $post[$key] = $this->input->post($key);
    }
    redirect('pages/cart','refresh'); 
  }
  /*end cart*/

}

/* End of file Cart.php */
/* Location: ./application/controllers/libraries/Cart.php */