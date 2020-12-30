<?php
  require 'functions.php';

  $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

  if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error . ". Please contact admin.");
  }

  $id = newUrl($_GET["url"], $conn);

  $domain = $_SERVER['SERVER_NAME'];
  if(isset($_SERVER['HTTPS'])) {
    $scheme = 'https://';
  } else {
    $scheme = 'http://';
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New url has been generated - Vuosaari</title>
    <link rel="stylesheet" href="/main.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <h1>URL shortening service - Vuosaari</h1>
    <form method="get">
      <h2>Your url has been generated</h2>
      <center>
        <input type="url" value="<?php echo $scheme . $domain . '/?u=' . $id; ?>" disabled>
      </center>
    </form>
  </body>
</html>
