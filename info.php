<?php
  require 'functions.php';

  $id = $_GET["id"];

  if (isset($id)) {
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
      die("Connection to database failed: " . $conn->connect_error . ". Please contact admin.");
    }

    $domain = $_SERVER['SERVER_NAME'];
    if(isset($_SERVER['HTTPS'])) {
      $scheme = 'https://';
    } else {
      $scheme = 'http://';
    }

    $url = getUrlById($id, $conn);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New url has been generated - Vuosaari</title>
    <link rel="stylesheet" href="/main.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="/libraries/qrcode.js" charset="utf-8"></script>
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
      <strong><i>running on <a href="https://github.com/kaikkitietokoneista/Vuosaari">Vuosaari</a></i></strong>
      <br>
      <nav>
        <a href="/">New</a>
        <a href="/docs.php">Docs</a>
      </nav>
    </header>
    <?php if ($error) { ?>
      <div class="centerverhor">
        <?php echo $error; ?>
      </div>
    <?php } else { ?>
      <form class="centerverhor">
        <h2>Your url has been generated</h2>
        <center>
          <input type="url" id="urlinput" value="<?php echo $scheme . $domain . '/?u=' . htmlspecialchars($id); ?>">
          <button class="button" type="button" onclick="copyText('urlinput');">Copy</button>
          <p>
            Link is redirecting to page <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
          </p>
          <div id="qrcode"></div>
        </center>
      </form>
    <?php } ?>
    <script type="text/javascript">
      new QRCode(document.getElementById("qrcode"), "<?php echo $url . '?u=' . $id; ?>");
    </script>
  </body>
</html>
