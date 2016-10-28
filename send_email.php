<?php
/****************************************************************************
*																			*
*	File:		send_email.php     										    *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file sends an email.					                *
*																			*
****************************************************************************/

//	Initialize session

    require_once('includes/session_management/init.php');

    send_mail();
    header('Location: contact_us.php');

//  Retrieve items

    function send_mail() {

    //  Get input fields

        if (isset($_POST['name'])) $name = $_POST['name'];
        if (isset($_POST['email'])) $email = $_POST['email'];
        if (isset($_POST['message'])) $message = $_POST['message'];

        $to = 'bev5@duke.edu';
        $subject = "SHOW: User Inquiry";
        $headers = "From: $email\r\n" .
        "Reply-To: $email\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $sent = mail($to, $subject, $message, $headers);

        if ($sent)
            return "Message sent!";
        else
            return "Uh oh, something went wrong! Please try again later.";
    }
