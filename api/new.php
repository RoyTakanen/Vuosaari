<?php
  require '../functions.php';

  $url = $_GET["url"];

  if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
      die("Connection to database failed: " . $conn->connect_error . ". Please contact admin.");
    }

    if (urlAlreadyExists($url, $conn)) {
      $id = getIdByUrl($url, $conn);
    } else {
      $id = newUrl($url, $_SERVER['REMOTE_ADDR'], $conn);
    }

    $domain = $_SERVER['SERVER_NAME'];
    if(isset($_SERVER['HTTPS'])) {
      $scheme = 'https://';
    } else {
      $scheme = 'http://';
    }
  } else {
    if ($_GET["info"] == 1) {
      header("Location: /errors/valid_url.php");
      die();
    } else {
      http_response_code(500);
      echo 'Invalid url.';
    }
  }

  if ($_GET["info"] == 1) {
    header("Location: /info.php?id=$id");
    die();
  }

  echo $scheme . $domain . '/?u=' . $id;
?>
