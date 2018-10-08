<!DOCTYPE html>
<html>
<head>
  <title>Upload form</title>
</head>
<body>
  <?php echo $error; ?>
  <?php echo form_open_multipart('pages/form_upload'); ?>
  <input type="file" name="userfile" size="20">
  <br><br>
  <input type="submit" name="" value="Upload">
  <?php echo form_close(); ?>
</body>
</html>