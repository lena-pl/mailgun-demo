<?php

require 'config.inc.php';

require 'vendor/autoload.php';
use Mailgun\Mailgun;
use GuzzleHttp;

session_start();

if (formIsValid()) {
    sendMail();
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

function formIsValid() {
    $isValid = true;
    $errors = [
        'name' => '',
        'email' => '',
        'message' => '',
        'recaptcha' => '',
    ];

    if (strlen($_POST['name']) < 2) {
        $isValid = false;
        $errors['name'] = "Must be 2 or more characters long.";
    }

    if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = "Must be a valid email address.";
    }


    if (strlen($_POST['message']) < 10) {
        $isValid = false;
        $errors['message'] = "Must be 10 or more characters long.";
    }

    if ($isValid) {
        return true;
    }

    $_SESSION['formdata'] = $_POST;
    $_SESSION['errors'] = $errors;
    return false;
}


function sendMail() {
    
    $mgClient = new Mailgun(MAILGUN_KEY);
    $result = $mgClient->sendMessage(MAILGUN_DOMAIN, array(
        'from'    => $_POST['name'] . ' <' . $_POST['email'] . '>',
        'to'      => 'Lena Plaksina <lena.plaksina@gmail.com>',
        'subject' => 'Contact Form Submission',
        'text'    => "Message for you...\n\n" . $_POST['message'],
    ));

    echo 'Your message has been sent!';

}

function reCaptchaIsValid() {
    $client = new GuzzleHttp\Client();
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $res = $client->post($url, [
        'body' => [
            'secret' => RECAPTCHA_SECRET,
            'response' => $_POST['g-recaptcha-response'],
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ]
    ]);
    $json = $res->getBody();
    $response = json_decode($json);

    return $response->success;
  }

  if (! reCaptchaIsValid()) {
          $isValid = false;
          $errors['recaptcha'] = "You must prove yourself a human.";
      }