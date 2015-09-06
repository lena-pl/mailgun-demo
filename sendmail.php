<?php

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
    echo "Valid!";

}