<?php

try {
  $db = new PDO('mysql:host=localhost; dbname=barrockdb; charset=utf8', 'root', 'root' );
} catch (PDOException $error) { echo $error->getMessage();

}



?>
