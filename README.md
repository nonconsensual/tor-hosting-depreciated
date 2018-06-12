General Information:
--------------------

This is a setup for a TOR based onion shared hosting server similar to what freedom hosting used. I have made
the install basically copy and paste based, so the prerequisite is to install standard ubuntu 16.04 LTS or 17.04
I have tested the install on server / desktop additions, I have not bothered to correct any postfix / Email on this
production, however this is something you can do in your spare time if required. The step by step I have added, will
allow anyone with basic unix knowledge to create a working web-hosting server. The purpose of this project
is to allow anyone to have a functional onion hosting server up and running within a hour.

I would suggest running a copy of clonzilla and backing up your ubuntu installation prior to installing so you can easily
roll back to prior in case things do not got to plan. Totally optional step.

Also I would suggest if you are not locally at the terminal of the machine and using ssh to set this up that you first run the command screen so if you do lose connection you can log back in and resume where you left off.

This project is provided as is and before putting it into production you should make your own changes as needed.

Supports php 7.0 7.1 7.2

Includes new web layout design and nice landing page for new sites created.

Added contact form.

Modified the copy and paste process to simplify. 


Installation Instructions:
--------------------------
```
The configuration was designed for ubuntu 17.04 desktop 64 bit edition installation, but also works on ubuntu 16.04.04 LTS server. 
The following commands will install all required packages:

Prior To Installation Process: Remove Apache2 & apparmor to prevent any conflicts.
-----------------------------------------------------------------------------------

sudo apt-get purge apparmor

sudo service apache2 stop

sudo apt-get remove apache2*

sudo apt-get autoremove

sudo apt-get purge apache2*

sudo reboot


Installation Process: Copy and paste each line and wait for them to complete.
------------------------------------------------------------------------------


Make sure you are always sudo for all of this installation tutorial
--------------------------------------------------------------------
sudo -i
screen
Now begin installing.
---------------------
sudo apt-get install software-properties-common
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install nano
sudo apt-get install apt-transport-https lsb-release ca-certificates
sudo apt-get update
sudo apt-get install python-software-properties software-properties-common

sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
sudo apt update && sudo apt upgrade
(If you have problems with dependancies I have included a /etc/apt/sources.list just update yours to match on ubuntu 16.04.LTS - It is located in optional directory then run sudo apt update && sudo apt upgrade, and continue to install)

apt-get --no-install-recommends install apt-transport-tor aspell curl dovecot-imapd dovecot-pop3d git haveged hunspell iptables locales-all logrotate mariadb-server nginx-light postfix postfix-mysql php7.0-bcmath php7.0-bz2 php7.0-curl php7.0-dba php7.0-enchant php7.0-fpm php7.0-gd php7.0-gmp php7.0-imap php7.0-json php7.0-mbstring php7.0-mcrypt php7.0-mysql php7.0-opcache php7.0-pspell php7.0-readline php7.0-recode php7.0-soap php7.0-sqlite3 php7.0-tidy php7.0-xml php7.0-xmlrpc php7.0-xsl php7.0-zip php7.1-bcmath php7.1-bz2 php7.1-cli php7.1-curl php7.1-dba php7.1-enchant php7.1-fpm php7.1-gd php7.1-gmp php7.1-imap php7.1-intl php7.1-json php7.1-mbstring php7.1-mcrypt php7.1-mysql php7.1-opcache php7.1-pspell php7.1-readline php7.1-recode php7.1-soap php7.1-sqlite3 php7.1-tidy php7.1-xml php7.1-xmlrpc php7.1-xsl php7.1-zip php7.2-bcmath php7.2-bz2 php7.2-cli php7.2-curl php7.2-dba php7.2-enchant php7.2-fpm php7.2-gd php7.2-gmp php7.2-imap php7.2-intl php7.2-json php7.2-mbstring php7.2-mysql php7.2-opcache php7.2-pspell php7.2-readline php7.2-recode php7.2-soap php7.2-sqlite3 php7.2-tidy php7.2-xml php7.2-xmlrpc php7.2-xsl php7.2-zip phpmyadmin php-imagick sasl2-bin ssh subversion tor vsftpd && apt-get --no-install-recommends install adminer


Accept default internet site settings for mail.

Do not select any webserver to configure!	

Use default server password for myphpadmin when setting up, (your server root password!)
-----------------------------------------------------------------------------------------


Create a mysql user with all permissions for our hosting management: Change the password! CHANGE_TO_YOUR_PASSWORD use root password
------------------------------------------------------------------------------------------------------------------------------------
mysql

CREATE USER 'hosting'@'localhost' IDENTIFIED BY 'CHANGE_TO_YOUR_PASSWORD';

GRANT ALL PRIVILEGES ON *.* TO 'hosting'@'localhost' WITH GRANT OPTION;

FLUSH PRIVILEGES;

quit


You now need to create a unique .onion vanity url. 
--------------------------------------------------

1.) Use eschalot to create the private key and .onion then use the .onion address
that was just created to amend the find examples that follow later.

wget https://github.com/ReclaimYourPrivacy/eschalot/archive/master.zip

unzip master.zip

mv eschalot-master esch

apt install gcc

apt-get install make

apt-get install openssl

apt-get install libcurl4-openssl-dev

apt-get install libssl-dev

cd esch

make

./eschalot -vct6 -r yourhost > yourhost.txt

you now have a nice new onion name and private key!.

Creating a clear-net name for the webserver files.
--------------------------------------------------

2.) Sign up with noip.me and get a free dynamic address to use for your .ddns.net address in the the following.

3.) Sign up and login in to noip.me and set the new dynamic host you created to match your server ip / ubuntu machine.


Now head over to github and pull my file to your server.
---------------------------------------------------------

cd /root/

wget https://github.com/WozMee/tor-hosting/archive/master.zip

apt-get install zip
unzip master.zip

Quick dirty way to edit all the files instead of manually sifting through them all is as follows:
--------------------------------------------------------------------------------------------------

Go to your tor-hosting-master folder in your home directory

cd /root/tor-hosting-master/

make sure you have already issued the sudo -i command and are in the tor-hosting-master directory

Then run the find commands as per examples but change them to your own names and onions like my examples.

EXAMPLES OF HOW THEY SHOULD LOOK WHEN EDITED DO NOT RUN!!!!

find ./ -type f -readable -writable -exec sed -i "s/hosting2271.ddns.net/hosting1171.ddns.net/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/torhostxjah7oso6.onion/torhostxjah7r634.onion/g" {} \;

EXAMPLES OF HOW THEY SHOULD LOOK WHEN EDITED DO NOT RUN!!!!


HERE ARE THE ONES TO RUN ONCE YOU EDIT THEM!

find ./ -type f -readable -writable -exec sed -i "s/hosting2271.ddns.net/CHANGE-THIS-TO-YOUR-OWN-ADDRESS/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/torhostxjah7oso6.onion/CHANGE-THIS-TO-YOUR-OWN-ONION/g" {} \;


NOW ZIP THE MODIFIED FILES & COPY THE NEW ZIP FILES TO ROOT / SO YOU CAN EASILY EXTRACT AND OVERWRITE FROM ROOT DIRECTORY
--------------------------------------------------------------------------------------------------------------------------
zip -r etc.zip etc/*

zip -r var.zip var/*

sudo cp var.zip /

sudo cp etc.zip /

cd /


Next deploy hosting system. (if you require the optional rc.local & ssh config file move to the directory /etc/)
----------------------------
make sure your still using sudo -i terminal 

sudo unzip etc.zip

use option - All overwite!

sudo unzip var.zip

use option - All overwite!

sudo reboot


Now we will display the new onion name that was just created and change it to our vannity address.
--------------------------------------------------------------------------------------------------

Now there should be an onion domain in /var/lib/tor/hidden_service/hostname:
----------------------------------------------------------------------------
cat /var/lib/tor/hidden_service/hostname


To Display your private key
-----------------------------
cat /var/lib/tor/hidden_service/private_key


As tor gives us a rather shitty name by default you will change it here is how.



Now you have its time to use your new vanity url tor has created a new .onion private key & hostname you can add your own vanity url
by using the details from eschalot and edit the old generic ones private_key and hostname.
--------------------------------------------------------------------------------------------
log back into terminal ssh

sudo -i

cd /var/lib/tor/hidden_service/

nano hostname

Delete the onion name in the file and replace this with your new vaniy onion address and save the file changes

nano private_key

Delete the key in the file and replace this with your new vaniy key and save the file changes

service tor restart

Now run all this from command line as root.
--------------------------------------------
Run terminal as root!

sudo -i

nano /etc/fstab

append to the end of file

tmpfs /tmp tmpfs defaults 0 0
tmpfs /var/log/nginx tmpfs rw,user 0 0

nano /etc/login.defs

append to end of file

SUB_GID_COUNT 1
SUB_UID_COUNT 1


As time syncronisation is important, you should configure ntp servers in /etc/systemd/timesyncd.conf and make them match with the entries in /etc/rc.local iptables configuration

To create all required tor and php instances run the following commands:
--------------------------------------------------------------------------
for instance in 2 3 4 5 6 7 a b c d e f g h i j k l m n o p q r s t u v w x y z; do(tor-instance-create $instance) done


for instance in default 2 3 4 5 6 7 a b c d e f g h i j k l m n o p q r s t u v w x y z; do(systemctl enable php7.0-fpm@$instance; systemctl enable php7.1-fpm@$instance; systemctl enable php7.2-fpm@$instance;) done

Optional to get a list of all tor user ids to add in /etc/rc.local run the following:
---------------------------------------------------------------------------------
for instance in 2 3 4 5 6 7 a b c d e f g h i j k l m n o p q r s t u v w x y z; do(id "_tor-$instance") done && id debian-tor


NOW EDIT THE MAIN COMMON.PHP
-----------------------------
cd /var/www

nano common.php

Edit password only as this is all you really need to do.


Now run the setup script
-------------------------
sudo php /var/www/setup.php

Enable systemd timers to regularly run various managing tasks:
--------------------------------------------------------------
systemctl enable hosting-del.timer && systemctl enable hosting.timer

Add empty directories that should be copied when creating a new user and set permissions correctly:
---------------------------------------------------------------------------------------------------
for dir in data logs Maildir tmp .ssh; do(mkdir /var/www/skel/$dir && chmod 750 /var/www/skel/$dir); done

Reboot server:
---------------
Final step is to reboot wait about 5 minutes for all services to start and check if everything is working by creating a test account.
sudo reboot


Now you can edit the postfix - mail sections to your own needs or just leave them as if you are not using mail.
see optional steps - Read Me
------------------------------------------
Reboot server and all should be working.

Remember to open any ports needed for tor & tor instances web server etc.

```
Optional-
----------
If you wish to create a email server on the system follow this guide. 
https://workaround.org/ispmail/wheezy/



