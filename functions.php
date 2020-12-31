<?php
  require __DIR__ . '/config.php';

  function generateRandomString($length = 4) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

  function newUrl($url, $ip, $conn) {
    $stmt = $conn->prepare("INSERT INTO vuosaari_urls (id, url, ip) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $url, $ip);

    $id = generateRandomString();
    $url = $url;
    $ip = $ip;
    $stmt->execute();

    $stmt->close();
    $conn->close();

    return $id;
  }

  function getUrlById($id, $conn) {
    $stmt = $conn->prepare("SELECT url FROM vuosaari_urls WHERE id=?");
    $stmt->bind_param("s", $id);

    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data["url"];
  }

  function getIdByUrl($url, $conn) {
    $stmt = $conn->prepare("SELECT id FROM vuosaari_urls WHERE url=?");
    $stmt->bind_param("s", $url);

    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data["id"];
  }

  function urlAlreadyExists($url, $conn) {
    $stmt = $conn->prepare("SELECT id FROM vuosaari_urls WHERE url=?");
    $stmt->bind_param("s", $url);

    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (isset($data["id"])) {
      return True;
    }
    return False;
  }
