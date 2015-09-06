<?php

  require 'config.inc.php';

  session_start();

  $submitAction = "sendmail.php";
  $errors = [
    'name' => '',
    'email' => '',
    'message' => '',
    'recaptcha' => '',
  ];
  $formdata = [
    'name' => '',
    'email' => '',
    'message' => '',
    'recaptcha' => '',
  ];
  if (isset($_SESSION['formdata'])) {
    $formdata = $_SESSION['formdata'];
    unset($_SESSION['formdata']);
  }
  if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mailgun Demo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./form.php">Mailgun Contact Form</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./form.php">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <h1 class="text-center">Contact Us</h1>

      <form method="POST" action="<?= $submitAction ?>" class="form-horizontal" enctype="multipart/form-data">

        <div class="form-group form-group-lg<?php if ($errors['name']): ?> has-error <?php endif; ?>">
          <label for="name" class="col-sm-4 col-md-2 control-label">Your Full Name</label>
          <div class="col-sm-8 col-md-10">
            <input id="name" class="form-control input-lg" name="name"
              value="<?= $formdata['name']; ?>">
            <div class="help-block"><?= $errors['name']; ?></div>
          </div>
        </div>

        <div class="form-group form-group-lg<?php if ($errors['email']): ?> has-error <?php endif; ?>">
          <label for="email" class="col-sm-4 col-md-2 control-label">Email Address</label>
          <div class="col-sm-8 col-md-10">
            <input type="email" id="email" class="form-control input-lg" name="email"
              value="<?= $formdata['email']; ?>">
            <div class="help-block"><?= $errors['email']; ?></div>
          </div>
        </div>   

        <div class="form-group <?php if ($errors['message']): ?> has-error <?php endif; ?>">
          <label for="message" class="col-sm-4 col-md-2  control-label">Message</label>
          <div class="col-sm-8 col-md-10">
            <textarea id="message" class="form-control" name="message" rows="5"
              placeholder="A paragraph about the movie."><?= $formdata['message']; ?></textarea>
            <div class="help-block"><?= $errors['message']; ?></div>
          </div>
        </div>

        <div class="form-group <?php if ($errors['recaptcha']): ?> has-error <?php endif; ?>">
          <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
            <div class="g-recaptcha" data-sitekey=<?= RECAPTCHA_SITEKEY ?>></div>
            <div class="help-block"><?= $errors['recaptcha']; ?></div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
            <button class="btn btn-success">Send Message</button>
          </div>
        </div>
      </form>

      <script src='https://www.google.com/recaptcha/api.js'></script>

    </div>
  </body>
</html>
