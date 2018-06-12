<?php
/*******************************************************************************
*  Title: Easy PHP Contact Form (Captcha Version)
*  Version: 2.0 @ September 14, 2010
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

/*******************************************************************************
 *	IMPORTANT
*******************************************************************************/

/* Email address where the messages should be delivered */

$to = 'you@example.com';

/* This will be appended to the subject of contact form message */

$subject_prefix = 'Website Contact Request';

/* Whether use SMTP Authentication? */

$smtp_auth = TRUE;

/* SMTP Host (e.g. smtp.gmail.com)*/

$smtp_host = 'localhost';

/* SMTP Port */

$smtp_port = '25';

/* SMTP username */

$smtp_username = 'you@example.com';

/* SMTP password */

$smtp_password = 'yourpasswordhere!';

/* Name of the file where you are including the contact form */

$where_included = 'contact.php';

/*******************************************************************************
 *	OPTIONAL
*******************************************************************************/

/* From email address, in case your server prohibits sending emails from 
 * addresses other than those of your own domain (e.g. email@yourdomain.com). */

$from = '';

/* Whether to use header/footer files? If yes, then set to TRUE */

$use_header_footer = TRUE;

/* Form header file */

$header_file = 'formfiles/contact-header.php';

/* Form footer file */

$footer_file = 'formfiles/contact-footer.php';

/* Thank you message to be displayed after the form is submitted. Can include 
 * HTML tags. Write your message between <!-- Start message --> and <!-- End message --> */

$thank_you_message = <<<EOD
<!-- Start message -->
<p><strong>We have received your message. If required, we'll get back to you as soon as possible.</strong></p>
<!-- End message -->
EOD;

/* URL to be redirected to after the form is submitted. If this is specified, 
 * then the above message will not be shown and user will be redirected to this 
 * page after the form is submitted. */

$thank_you_url = '';

/*******************************************************************************
 *	COSMETICS
*******************************************************************************/

/* Form width in px or % value */

$form_width = '70%';

/* Form height in px */

$form_height = '500px';

/* Form background color or image. Value can contain just a color value or 
 * complete background shorthand property (with background image). */
 
$form_background = '#F7F8F7';

/* Form border color */

$form_border_color = '#CCCCCC';

/* Form border width */

$form_border_width = '1px';

/* Form border style. Examples - dotted, dashed, solid, double */

$form_border_style = 'solid';

/* Form cell padding */

$cell_padding = '5px';

/* Form left column width */

$left_col_width = '25%';


/*******************************************************************************
 *	Do not change anything below, unless of course you know very well 
 *	what you are doing :)
*******************************************************************************/

$name = array('Name','name',NULL,NULL);
$email = array('Email','email',NULL,NULL,NULL);
$subject = array('Subject','subject',NULL,NULL);
$message = array('Message','message',NULL,NULL);
$code = array('Code','captcha_code',NULL,NULL,NULL);

?>
