<?php
include('../common.php');
try{
	$db=new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
}catch(PDOException $e){
	die('No Connection to MySQL database!');
}
session_start();
$user=check_login();
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html><head>';
echo '<title>WowMee\'s Hosting - Dashboard</title>';
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
echo "<p>Logged in as $user[username] <a href=\"logout.php\">Logout</a> | <a href=\"password.php\">Change passwords</a> | <a target=\"_blank\" href=\"files.php\">FileManager</a> | <a href=\"delete.php\">Delete account</a></p>";
//echo "<p>Enter system account password to check your $user[onion].onion@" . ADDRESS . " mail:</td><td><form action=\"squirrelmail/src/redirect.php\" method=\"post\" target=\"_blank\"><input type=\"hidden\" name=\"login_username\" value=\"$user[onion].onion\"><input type=\"password\" name=\"secretkey\"><input type=\"submit\" value=\"Login to webmail\"></form></p>";
echo '<h3>Domain</h3>';
echo '<table border="1">';
echo '<tr><th>Onion</th><th>Private key</th></tr>';
echo "<tr><td><a href=\"http://$user[onion].onion\" target=\"_blank\">$user[onion].onion</a></td><td>";
if(isset($_REQUEST['show_priv'])){
	echo "<pre>$user[private_key]</pre>";
}else{
	echo '<a href="home.php?show_priv=1">Show private key</a>';
}
echo '</td></tr>';
echo '</table>';
echo '<h3>MySQL Database</h3>';
echo '<table border="1">';
echo '<tr><th>Database</th><th>Host</th><th>User</th></tr>';
echo "<tr><td>$user[onion]</td><td>localhost</td><td>$user[onion].onion</td></tr>";
echo '</table>';
echo '<p><a href="password.php?type=sql">Change MySQL password</a></p>';
echo '<p>You can use <a href="/phpmyadmin/" target="_blank">PHPMyAdmin</a> for web based database administration.</p>';
echo '<h3>System Account</h3>';
echo '<table border="1">';
echo '<tr><th>Username</th><th>Host</th><th>FTP Port</th><th>SFTP Port</th><th>POP3 Port</th><th>IMAP Port</th><th>SMTP port</th></tr>';
foreach(SERVERS as $server=>$tmp){
	echo "<tr><td>$user[onion].onion</td><td>$server</td><td>$tmp[ftp]</td><td>$tmp[sftp]</td><td>$tmp[pop3]</td><td>$tmp[imap]</td><td>$tmp[smtp]</td></tr>";
}
echo '</table>';
echo '<p><a href="password.php?type=sys">Change system account password</a></p>';
echo '<p>You can use the <a target="_blank" href="files.php">FileManager</a> for web based file management.</p>';
echo '<h3>Logs</h3>';
echo '<table border="1">';
echo '<tr><th>Date</th><th>access.log</th><th>error.log</th></tr>';
echo '<tr><td>Today</td><td><a href="log.php?type=access&amp;old=0" target="_blank">access.log</log></td><td><a href="log.php?type=error&amp;old=0" target="_blank">error.log</a></td></tr>';
echo '<tr><td>Yesterday</td><td><a href="log.php?type=access&amp;old=1" target="_blank">access.log</log></td><td><a href="log.php?type=error&amp;old=1" target="_blank">error.log</a></td></tr>';
echo '</table>';
echo '</body></html>';
