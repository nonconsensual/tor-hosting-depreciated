<?php
include('../common.php');
try{
	$db=new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
}catch(PDOException $e){
	die('No Connection to MySQL database!');
}
session_start();
$user=check_login();
if(!isset($_REQUEST['type'])){
	$_REQUEST['type']='acc';
}
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
	if(!isset($_POST['pass']) || !password_verify($_POST['pass'], $user['password'])){
		$msg.='<p style="color:red;">Wrong password.</p>';
	}elseif(!isset($_POST['confirm']) || !isset($_POST['newpass']) || $_POST['newpass']!==$_POST['confirm']){
		$msg.='<p style="color:red;">Wrong password.</p>';
	}else{
		if($_REQUEST['type']==='acc'){
			$hash=password_hash($_POST['newpass'], PASSWORD_DEFAULT);
			$stmt=$db->prepare('UPDATE users SET password=? WHERE username=?;');
			$stmt->execute([$hash, $user['username']]);
			$msg.='<p style="color:green;">Successfully changed account password.</p>';
		}elseif($_REQUEST['type']==='sys'){
			$stmt=$db->prepare('INSERT INTO pass_change (onion, password) VALUES (?, ?);');
			$hash=get_system_hash($_POST['newpass']);
			$stmt->execute([$user['onion'], $hash]);
			$msg.='<p style="color:green;">Successfully changed system account password, change will take affect within the next minute.</p>';
		}elseif($_REQUEST['type']==='sql'){
			$stmt=$db->prepare("SET PASSWORD FOR '$user[onion].onion'@'%'=PASSWORD(?);");
			$stmt->execute([$_POST['newpass']]);
			$db->exec('FLUSH PRIVILEGES;');
			$msg.='<p style="color:green;">Successfully changed sql password.</p>';
		}else{
			$msg.='<p style="color:red;">Couldn\'t update password: Unknown reset type.</p>';
		}
	}
}
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html><head>';
echo '<title>WowMee\'s Hosting - Change password</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '<meta name="author" content="WowMee">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
//included new theme start
echo "<link rel=\"stylesheet\" href=\"/css/st.css\">\n";
echo "<link rel=\"stylesheet\" href=\"/css/tb.css\">\n";
echo "<link rel=\"stylesheet\" href=\"/css/font-awesome/css/font-awesome.min.css\">\n";
echo "\n";
echo "<body class=\"w3-theme-bd\">\n";
//echo "<div class=\"w3-top w3-bar w3-dark-grey\">\n";
echo "<div class=\"w3-top w3-bar w3-teal\">\n";
//echo "<div class=\"w3-top w3-bar w3-blue\">\n";
//include('../common.php');

echo "<a class=\"w3-hide-medium w3-hide-large w3-bar-item w3-button w3-theme-hm\" href=\"/\" title=\"WowMee Hosting\"><i class=\"fa fa-home\"></i></a>\n";
echo "<a href=\"/\" class=\"w3-hide-small w3-bar-item w3-button w3-theme-hm\" title=\"WowMee Hosting\"><i class=\"fa fa-home w3-margin-right\"></i>WowMee Hosting</a>\n";
echo "<a href=\"/register.php\" class=\"w3-bar-item w3-button\" title=\"Register\">Register</a>\n";
echo "<a href=\"/login.php\" class=\"w3-bar-item w3-button\" title=\"Login\">Login</a>\n";
echo "<a href=\"/list.php\" class=\"w3-hide-small w3-bar-item w3-button\" title=\"List of hosted sites\">List</a>\n";
echo "<a class=\"w3-bar-item w3-hide-medium w3-hide-large w3-button\" href=\"/list/\" title=\"List of hosted sites\"><i class=\"fa fa-sticky-note\"></i></a>\n";
echo "<a href=\"/faq.php\" class=\"w3-hide-small w3-bar-item w3-button\" title=\"FAQ\">FAQ</a>\n";
echo "<a class=\"w3-bar-item w3-hide-medium w3-hide-large w3-button w3-gre\" href=\"/faq\" title=\"FAQ\"><i class=\"fa fa-book\"></i></a>\n";
echo "<a href=\"/contact.php\" class=\"w3-bar-item w3-button w3-hide-small\" title=\"Contact me\">Contact</a>\n";
echo "<a class=\"w3-bar-item w3-button w3-hide-medium w3-hide-large\" href=\"/contact/\" title=\"Contact me\"><i class=\"fa fa-envelope\"></i></a>\n";
echo "</div>\n";
echo "<div class=\"w3-row-padding w3-padding-64\">\n";
echo "<div class=\"w3-container\">\n";
//echo "<header class=\"w3-container w3-dark-grey\">\n";
echo "<header class=\"w3-container w3-black\">\n";
echo "<h2 class=\"w3-center\">WowMee Hosting</h2>\n";
echo "</header>\n";
echo "<div class=\"w3-container w3-grey\">\n";
echo "<p class=\"w3-left w3-tag w3-small\">All Systems Active..</p>\n";
echo "<div class=\"w3-display-container w3-container\">\n";
//include new theme end
echo '</head><body>';
echo $msg;
echo '<form method="POST" action="password.php"><table>';
echo '<tr><td>Reset type:</td><td><select name="type">';
echo '<option value="acc"';
if($_REQUEST['type']==='acc'){
	echo ' selected';
}
echo '>Account</option>';
echo '<option value="sys"';
if($_REQUEST['type']==='sys'){
	echo ' selected';
}
echo '>System account</option>';
echo '<option value="sql"';
if($_REQUEST['type']==='sql'){
	echo ' selected';
}
echo '>MySQL</option>';
echo '</select></td></tr>';
echo '<tr><td>Account password:</td><td><input type="password" name="pass" required autofocus></td></tr>';
echo '<tr><td>New password:</td><td><input type="password" name="newpass" required></td></tr>';
echo '<tr><td>Confirm password:</td><td><input type="password" name="confirm" required></td></tr>';
echo '<tr><td colspan="2"><input type="submit" value="Reset"></td></tr>';
echo '</table></form>';
echo '<p><a href="home.php">Go back to dashboard.</a></p>';
echo '</body></html>';
