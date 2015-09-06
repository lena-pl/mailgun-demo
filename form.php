<?php

  $submitAction = "sendmail.php";
  $errors = [
    'name' => '',
    'email' => '',
    'message' => '',
  ];
  $formdata = [
    'name' => '',
    'email' => '',
    'message' => '',
  ];

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

    <div class="container">
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

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
            <button class="btn btn-success">Send Message</button>
          </div>
        </div>

    </div>
  </body>
</html>
