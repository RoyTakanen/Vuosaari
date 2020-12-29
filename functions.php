<?php
  require 'config.php';

  function generateRandomString($length = 4) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

  function newUrl($url, $conn) {
    $stmt = $conn->prepare("INSERT INTO vuosaari_urls (id, url) VALUES (?, ?)");
    $stmt->bind_param("ss", $id, $url);

    $id = generateRandomString();
    $url = $_GET["url"];
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
