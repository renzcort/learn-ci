<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <?php echo validation_errors(); ?>
  <?php echo validation_errors('<div class="error">', '</div>'); ?>
  <?php echo form_open_multipart('libraries/security'); ?>
  <!-- <p><input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /></p> -->
  <h5>Username</h5>
  <?php echo form_error('username'); ?>
  <?php echo form_error('username', '<div class="error">', '</div>'); ?>
  <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50">
  <h5>Password</h5>
  <?php echo form_error('password'); ?>
  <input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50">
  <h5>Password Confirm</h5>
  <?php echo form_error('passconf'); ?>
  <input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50">
  <h5>Email</h5>
  <?php echo form_error('email'); ?>
  <input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50">
  <div><input type="submit" name="" value="submit"></div>
  <?php echo form_close(); ?>
</body>
</html>