<?php
/****************************************************************************
*																			*
*	File:		contact_us.php  											*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file sets the contact us page.							*
*																			*
****************************************************************************/

//	Initialize session

	require_once('includes/php_session/init.php');

//	Include headers

	$PAGE_TITLE = 'Contact Us';
	require_once('includes/page_parts/header.php');
?>
	<div id="contactPage" class="page">
		<h1 class="pageTitle">Contact Us</h1>
		<p>
			We highly value any questions or comments. To reach us, send us a message <a href="mailto:dukehalapps@gmail.com?subject=SHOW:">here</a>!
		</p>
		<p>
			If you're experiencing any issues, we recommend using the latest version of Chrome.
		</p>
	</div>
<?php require_once('includes/page_parts/footer.php');?>
