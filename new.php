<?php
  require 'functions.php';

  $url = $_GET["url"];

  if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
      die("Connection to database failed: " . $conn->connect_error . ". Please contact admin.");
    }

    $id = newUrl($url, $conn);

    $domain = $_SERVER['SERVER_NAME'];
    if(isset($_SERVER['HTTPS'])) {
      $scheme = 'https://';
    } else {
      $scheme = 'http://';
    }
  } else {
    $error = "Please enter a valid URL.";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New url has been generated - Vuosaari</title>
    <link rel="stylesheet" href="/main.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script type="text/javascript">
       function copyText(input) {
         let text = document.getElementById(input);

         text.select();
         text.setSelectionRange(0, 99999);

         document.execCommand("copy");

         return copyText.value;
       }
     </script>
  </head>
  <body>
    <header class="wave">
      <br>
      <h1 style="display: inline-block;">URL shortening service</h1>
      <strong><i>running on Vuosaari</i></strong>
      <br>
      <a href="/">New</a>
    </header>
    <?php if ($error) { ?>
      <div class="centerverhor">
        <?php echo $error; ?>
      </div>
    <?php } else { ?>
      <form class="centerverhor">
        <h2>Your url has been generated</h2>
        <center>
          <input type="url" id="urlinput" value="<?php echo $scheme . $domain . '/?u=' . $id; ?>">
          <button class="button" type="button" onclick="copyText('urlinput');">Copy</button>
        </center>
      </form>
    <?php } ?>
  </body>
</html>
