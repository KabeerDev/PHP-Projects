<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$msg = $_POST['msg'];

if (!empty($name) && !empty($email)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $receiver = "kabirahmad40allah@gmail.com";
        $subject = "From: $name <$email>";
        $body = "Name: $name\nEmail: $email\nSubject: $email\n\nMessage: $msg";
        $sender = "From: $email";
        if (mail($receiver, $subject, $body, $sender)) {
            echo "Your message has been sent!";
        } else {
            echo "Sorry, failed to send your message!";
        }
    } else {
        echo "Enter a valid email address!";
    }
} else {
    echo 'Please fill all the required fields!';
}
