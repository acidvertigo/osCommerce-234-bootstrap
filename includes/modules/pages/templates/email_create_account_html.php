<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo STORE_NAME; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<style>
div { margin-top: 14px;}
</style>
</head>
<body>

<div class="content">
<h1><?php echo $email_text; ?></h1>
<div><?php echo EMAIL_WELCOME; ?></div>
<div><ul><?php echo EMAIL_TEXT; ?></ul></div>
<div><?php echo EMAIL_CONTACT; ?></div>
<div><?php echo EMAIL_WARNING; ?></div>
</div>

</body>
</html>
