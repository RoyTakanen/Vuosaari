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
          <strong><i>running on <a href="https://github.com/kaikkitietokoneista/Vuosaari">Vuosaari</a></i></strong>
          <br>
          <nav>
            <a href="/">New</a>
            <a href="/docs.php">Docs</a>
          </nav>
        </header>

        <section>
          <h2>Create new url</h2>
          <p>
            You have to send GET-request to URL <code>/api/new.php</code> with parameter <code>url</code> which contains shorten url in valid format. If the url already exists old id will be used.
          </p>
          <h2>View url info</h2>
          <p>
            When you create new url you can add GET-parameter <code>info</code> with value 1. This redirects you to url info page.
          </p>
        </section>
      </body>
    </html>
    <?php
  }
?>
