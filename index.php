<?php
  require 'config.php';
  require 'functions.php';

  if (isset($_GET["u"])) {
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
      die("Connection to database failed: " . $conn->connect_error . ". Please contact admin.");
    }

    $url = getUrlById($_GET["u"], $conn);

    header("Location: $url");
    die();
  } else {
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title>URL shortening service - Vuosaari</title>
        <link rel="stylesheet" href="/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
      <body>
        <header class="wave">
          <br>
          <h1 style="display: inline-block;">URL shortening service</h1>
          <strong><i>running on Vuosaari</i></strong>
          <br>
          <a href="/">New</a>
        </header>
        <form action="/new.php" class="centerverhor" method="get">
          <input type="url" name="url" placeholder="Enter your url...">
          <input type="submit" class="button" value="Create">
        </form>
      </body>
    </html>
    <?php
  }
?>
