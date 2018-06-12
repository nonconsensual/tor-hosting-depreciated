<?php 
require_once "contact-config.php";
echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Contact Us</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<style type="text/css">
body {
font-family: Verdana,Arial,Helvetica,sans-serif;
font-size: 12px;
background: #FFFFFF;
line-height: 14px;
}

h1 {
	font-size: 160%;
	font-family: "Trebuchet MS",Verdana, Arial, Helvetica, sans-serif;
	margin: 10px 0;
	line-height: 130%;
}
</style> 
<p>| <a href="index.php">Hosting Information</a> | <a href="register.php">Register</a> | <a href="login.php">Login</a> | <a href="list.php">List of hosted sites</a> | <a href="contact.php">Contact</a> |</p>
<tr>
</head>
<body>
<div style="width: {$form_width}; margin: 0 auto;">
<h1>Contact Us</h1>
EOD;
?>
