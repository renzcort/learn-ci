<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <?php echo validation_errors(); ?>
  <?php echo form_open('pages/form_validation_check'); ?>
  <h5>Username</h5>
  <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50">
  <h5>Password</h5>
  <input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50">
  <h5>Password Confirm</h5>
  <input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50">
  <h5>Email</h5>
  <input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50">
  <div><input type="submit" name="" value="submit"></div>
  <?php echo form_close(); ?>
</body>
</html>