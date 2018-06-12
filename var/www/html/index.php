<?php

include_once('../common.php');
try{
        $db=new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
}catch(PDOException $e){
        die('No Connection to MySQL database!');
}

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<title>Wowmee Web Hosting | http://hostingv5fypnk3u.onion/ Wowmee Hosting</title>\n";
echo "<meta charset=\"UTF-8\">\n";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
echo "<meta name=\"Keywords\" content=\"onion,HTML5,CSS,Web,Dark,Hosting,Deep,anonymity,bitcoin,donate,easy,domain,domin,host,freebie,design,photoshop,Wowmee Hosting.\">\n";
echo "<meta name=\"Description\" content=\"hostingv5fypnk3u.onion. Tor hosting onion\">\n";
echo "<link rel=\"icon\" href=\"/favicon.ico\" type=\"image/x-icon\">\n";
echo "<link rel=\"stylesheet\" href=\"/css/st.css\">\n";
echo "<link rel=\"stylesheet\" href=\"/css/tb.css\">\n";
echo "<link rel=\"stylesheet\" href=\"/css/font-awesome/css/font-awesome.min.css\">\n";
echo "\n";
echo "<body class=\"w3-theme-bd\">\n";
echo "<div class=\"w3-top w3-bar w3-teal\">\n";
echo "<a class=\"w3-hide-medium w3-hide-large w3-bar-item w3-button w3-theme-hm\" href=\"/\" title=\"Wowmee Hosting\"><i class=\"fa fa-home\"></i></a>\n";
echo "<a href=\"/\" class=\"w3-hide-small w3-bar-item w3-button w3-theme-hm\" title=\"Wowmee Hosting\"><i class=\"fa fa-home w3-margin-right\"></i>Wowmee Hosting</a>\n";
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
echo "<header class=\"w3-container w3-black\">\n";
echo "<h2 class=\"w3-center\">Wowmee Hosting</h2>\n";
echo "</header>\n";
echo "<div class=\"w3-container w3-grey\">\n";
echo "<p class=\"w3-left w3-tag w3-small\">All Systems Active..</p>\n";
echo "<div class=\"w3-display-container w3-container\">\n";
$stmt=$db->query('SELECT COUNT(*) FROM users WHERE public=1;');
$count=$stmt->fetch(PDO::FETCH_NUM);
$stmt=$db->query('SELECT COUNT(*) FROM users WHERE public=0;');
$hidden=$stmt->fetch(PDO::FETCH_NUM);
echo "<p>We currently have $count[0] public hosted sites and, ($hidden[0] sites hidden):</p>";
echo '<table border="1">';
echo '<p>Current Hosting package Price $10 per month payable by bitcoin, please contact me once payment is sent with details of payment.</p>';
echo '<li><b><a href="/contact.php" target="_blank">Click Here To Contact Me after payment is sent</b></li>';
echo '<li><b><span style="color:#ff0000;text-align:center;">Want a cool vanity url like ours?.</b><a href="vanity.php"><b>Then Click Here</b> To Get your Vanity URL (mynew.onion)</span></a></li>';
echo '<p></p>';
echo '<li><b>My Bitcoin address for hosting account payments: Your Bitcoin Address Here.</b></li>';
echo '<p>What you will get:</p>';
echo '<ul>';
echo '<li>Chose between PHP 7.0-7.2</li>';
echo '<li>Nginx Webserver</li>';
echo '<li>SQLite support</li>';
echo '<li>1 MariaDB (MySQL) database</li>';
echo '<li><a href="/phpmyadmin/" target="_blank">PHPMyAdmin</a> and <a href="/adminer/" target="_blank">Adminer</a> for web based database administration</li>';
echo '<li>Web-based file management, or you can use an FTP client like <a href="https://filezilla-project.org/">FileZilla</a></li>';
echo '<li>FTP access</li>';
echo '<li>SFTP access</li>';
echo '<li>500mb disk quota</li>';
echo '</ul>';
echo '<h2>Rules</h2>';
echo '<ul>';
echo '<li>No child pornography!</li>';
echo '<li>No terroristic propaganda!</li>';
echo '<li>No illegal content according to International law!</li>';
echo '<li>No malware! (e.g. botnets)</li>';
echo '<li>No phishing!</li>';
echo '<li>No scams!</li>';
echo '<li>No spam!</li>';
echo '<li>No shops! (mostly scams anyway)</li>';
echo '<li>No proxy scripts!</li>';
echo '<li>No IP logger or similar de-anonymizer sites!</li>';
echo '<li>We preserve the right to delete any site for violating these rules and adding new rules at any time.</li>';
echo "</div></div>\n";
echo "<footer class=\"w3-container w3-center w3-dark-grey\">\n";
echo "<p></p>\n";
echo "</footer>\n";
echo "</div>\n";
echo "<span class=\"w3-bottom w3-bar w3-tag w3-dark-grey\" style=\"cursor:url(/bugs.png),url(/myBall.cur),auto;\"><strong style=\"color:#cccccc\">hostingv5fypnk3u.onion</strong></span>\n";
echo "</body>\n";
echo "</html>";

?>


