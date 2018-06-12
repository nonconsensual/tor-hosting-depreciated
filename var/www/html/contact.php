<?php
if (session_id() == '') session_start();
/*******************************************************************************
*  Title: Easy PHP Contact Form (Captcha Version)
*  Version: 2.1 @ October 17, 2011
*  Author: Vishal P. Rao
*  Website: http://www.easyphpcontactform.com
********************************************************************************
*  COPYRIGHT NOTICE
*  Copyright 2010 Vishal P. Rao. All Rights Reserved.
*
*  This script may be used and modified free of charge by anyone
*  AS LONG AS COPYRIGHT NOTICES AND ALL THE COMMENTS REMAIN INTACT.
*  By using this code you agree to indemnify Vishal P. Rao or 
*  www.easyphpcontactform.com from any liability that might arise from 
*  it's use.
*
*  Selling the code for this program, in part or full, without prior
*  written consent is expressly forbidden.
*
*  Obtain permission before redistributing this software over the Internet
*  or in any other medium. In all cases copyright and header must remain
*  intact. This Copyright is in full effect in any country that has
*  International Trade Agreements with the India
*
*  Removing any of the copyright notices without purchasing a license
*  is illegal! 
*******************************************************************************/

/*******************************************************************************
 *	Script configuration - Refer README.txt
*******************************************************************************/

require "formfiles/contact-config.php";

$error_message = '';

if (!isset($_POST['submit'])) {

  showForm();

} else { //form submitted

  $error = 0;
  
  if(!empty($_POST['name'])) {
  	$name[2] = clean_var($_POST['name']);
  }
  else {
    $error = 1;
    $name[3] = 'color:#FF0000;';
  }
  
  if(!empty($_POST['email'])) {
  	$email[2] = clean_var($_POST['email']);
  	if (!validEmail($email[2])) {
  	  $error = 1;
  	  $email[3] = 'color:#FF0000;';
  	  $email[4] = '<strong><span style="color:#FF0000;">Invalid email</span></strong>';
	  }
  }
  else {
    $error = 1;
    $email[3] = 'color:#FF0000;';
  }
  
  if(!empty($_POST['subject'])) {
  	$subject[2] = clean_var($_POST['subject']);
  	if (function_exists('htmlspecialchars')) $subject[2] = htmlspecialchars($subject[2], ENT_QUOTES);  	
  }
  else {
  	$error = 1;
    $subject[3] = 'color:#FF0000;';
  }  

  if(!empty($_POST['message'])) {
  	$message[2] = clean_var($_POST['message']);
  	if (function_exists('htmlspecialchars')) $message[2] = htmlspecialchars($message[2], ENT_QUOTES);
  }
  else {
    $error = 1;
    $message[3] = 'color:#FF0000;';
  }    

  if(empty($_POST['captcha_code'])) {
    $error = 1;
    $code[3] = 'color:#FF0000;';
  } else {
  	include_once "formfiles/contact-securimage.php";
		$securimage = new Securimage();
    $valid = $securimage->check($_POST['captcha_code']);

    if(!$valid) {
      $error = 1;
      $code[3] = 'color:#FF0000;';   
      $code[4] = '<strong><span style="color:#FF0000;">Incorrect code</span></strong>';
    }
  }

  if ($error == 1) {
    $error_message = '<div style="font-weight:bold;font-size:90%;margin-bottom:5px;}">Please correct/enter field(s) in red.</div>';

    showForm();

  } else {
  	
  	if (function_exists('htmlspecialchars_decode')) $subject[2] = htmlspecialchars_decode($subject[2], ENT_QUOTES);
  	if (function_exists('htmlspecialchars_decode')) $message[2] = htmlspecialchars_decode($message[2], ENT_QUOTES);  	
  	
    $body = "$name[0]: $name[2]\r\n\r\n";
    $body .= "$email[0]: $email[2]\r\n\r\n";
    $body .= "$message[0]:\r\n$message[2]\r\n\r\n";
    
    if (!$from) $from_value = $email[2];
    else $from_value = $from;
    
    require_once('formfiles/class.phpmailer.php');
    
    $mail = new PHPMailer();
    
    $mail->IsSMTP();
    $mail->SMTPAuth = $smtp_auth;
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password; 
    $mail->SetFrom($from_value);  
    $mail->AddReplyTo($email[2]);
    $mail->Subject = "$subject_prefix - $subject[2]";
    $mail->Body = $body;
    $mail->AddAddress($to);
    
    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }
    
    if (!$thank_you_url) {    
      if ($use_header_footer) {
				include $header_file;
				$form_width = '100%';
			}
      echo '<a name="cform"><!--Form--></a>'."\n";
      echo '<div id="formContainer" style="width: '.$form_width.';height: '.$form_height.';text-align: left; vertical-align: top;">'."\n";
      echo $GLOBALS['thank_you_message']."\n";
      echo '</div>'."\n";
      if ($use_header_footer) include $footer_file;
	  }
	  else {
	  	header("Location: $thank_you_url");
	  }
	  
	  session_unset();
    session_destroy();	  
       	
  }

} //else submitted



function showForm()

{
global $name, $email, $subject, $message, $code;
global $where_included, $use_header_footer, $header_file, $footer_file;
global $form_width, $form_height, $form_background, $form_border_color, $form_border_width, $form_border_style, $cell_padding, $left_col_width; 	

if ($use_header_footer) {
	include $header_file;
	$form_width = '100%';
}

echo <<<EOD
<a name="cform"><!--Form--></a>
<div id="formContainer" style="width: {$form_width};">
{$GLOBALS['error_message']}
<form method="post" id="cForm" action="{$where_included}#cform">
<table style="width:100%; height:{$form_height}; background:{$form_background}; border:{$form_border_width} {$form_border_style} {$form_border_color}; padding:10px;" id="contactForm">
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; font-weight:bold; {$name[3]}">{$name[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" name="{$name[1]}" value="{$name[2]}" id="{$name[1]}" /></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; font-weight:bold; {$email[3]}">{$email[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" name="{$email[1]}" value="{$email[2]}" id="{$email[1]}" /> {$email[4]}</td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; font-weight:bold; {$subject[3]}">{$subject[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" name="{$subject[1]}" value="{$subject[2]}" size="40" id="{$subject[1]}" /></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; font-weight:bold; {$message[3]}">{$message[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><textarea name="{$message[1]}" cols="40" rows="6" id="{$message[1]}">{$message[2]}</textarea></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding};">&nbsp;</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><img id="captcha" src="formfiles/contact-securimage_show.php" alt="CAPTCHA Image" /></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; font-weight:bold; {$code[3]}">{$code[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" name="{$code[1]}" size="10" maxlength="5" id="{$code[1]}" /> {$code[4]}
<br /><br />(Please enter the text in the image above. Text is not case sensitive.)<br />
<a href="#" onclick="document.getElementById('captcha').src = 'formfiles/contact-securimage_show.php?' + Math.random(); return false">Click here if you cannot recognize the code.</a>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:left; vertical-align:middle; padding:{$cell_padding}; font-size:90%; font-weight:bold;">All fields are required.</td>
</tr>
<tr>
<td colspan="2" style="text-align:left; vertical-align:middle; padding:{$cell_padding};"><input type="submit" name="submit" value="Submit" style="border:1px solid #999;background:#E4E4E4;margin-top:5px;" id="submit_button" /></td>
</tr>
</table>
</form>
<!-- Removing the attribution link without obtaining a licence is illegal and prohibited -->
<!-- Check out Branding Removal option at http://www.easyphpcontactform.com/ -->
<div style="width:100%;text-align:right;font-size:80%;margin-top: 0;">
<a href="http://www.easyphpcontactform.com/" title="Easy PHP Contact Form" target="_blank">Easy PHP Contact Form</a>
</div>
</div>
EOD;

if ($use_header_footer) include $footer_file;
}

function clean_var($variable) {
    $variable = strip_tags(stripslashes(trim(rtrim($variable))));
  return $variable;
}

/**
Email validation function. Thanks to http://www.linuxjournal.com/article/9585
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && function_exists('checkdnsrr'))
      {
      	if (!(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
         // domain not found in DNS
         $isValid = false;
       }
      }
   }
   return $isValid;
}


?>

