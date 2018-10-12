<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <form>
    <input type="text" name="myfield" value="<?php echo $string; ?>">
    <input type="text" name="myfield" value="<?php echo html_escape($string); ?>" />
  </form>
  <!-- form Open -->
  <?php 
    $hidden = array('username' => 'Joe', 'member_id' => '234');
    echo form_open('email/send', '', $hidden);
  ?>

  <!-- form Hidden -->
  <?php 
    $data = array(
        'name'  => 'John Doe',
        'email' => 'john@example.com',
        'url'   => 'http://example.com'
    );
    echo form_hidden($data);
  ?>

  <!-- Form Input -->
  <?php 
    $data = array(
        'name'          => 'username',
        'id'            => 'username',
        'value'         => 'johndoe',
        'maxlength'     => '100',
        'size'          => '50',
        'style'         => 'width:50%'
    );
    echo form_input($data);
    $js = 'onClick="some_function()"';
    echo form_input('username', 'johndoe', $js);
    $js = array('onClick' => 'some_function();');
    echo form_input('username', 'johndoe', $js);
  ?>

<!-- form Droprown -->
<?php 
  $options = array(
        'small'         => 'Small Shirt',
        'med'           => 'Medium Shirt',
        'large'         => 'Large Shirt',
        'xlarge'        => 'Extra Large Shirt',
  );
  $shirts_on_sale = array('small', 'large');
  echo form_dropdown('shirts', $options, 'large');

  /*form Fieldset*/
  $attributes = array(
        'id'    => 'address_info',
        'class' => 'address_info'
  );

  echo form_fieldset('Address Information', $attributes);
  echo "<p>fieldset content here</p>\n";
  echo form_fieldset_close();
?>

<!-- form fieldset close -->
<?php 
  $string = '</div></div>';
  echo form_fieldset_close($string);
  // Would produce: </fieldset></div></div>
?>

<!-- form checkbox -->
<?php
  $data = array(
          'name'          => 'newsletter',
          'id'            => 'newsletter',
          'value'         => 'accept',
          'checked'       => TRUE,
          'style'         => 'margin:10px'
  );
  echo form_checkbox($data); 
?>

</body>
</html>