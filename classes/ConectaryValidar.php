
<?php

class ConectaryValidar
{

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public function emailyaexiste($email) {
      global $db;
      $stmt = $db->prepare("SELECT email FROM usuarios");
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($results as $result) {

        $validar = $result['email'];

      if ($validar == $email) {
        return true;
        }
      }
    }


    public function validarlogin($email, $password) {
      global $db;
      $stmt = $db->prepare("SELECT * FROM usuarios WHERE email like :email");
      $stmt->bindValue(":email", $email);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($results as $result) {

        $validaremail = $result['Email'];
        $validarpass = $result['Contrasenia'];

      if ($validaremail == $email &&  password_verify($password, $validarpass) == true) {
            return true;
      }

      elseif ($validaremail == $email && password_verify($password, $validarpass) == false) { // aca no podria decir: $validaremail !== $email || $validarpass != $password
        return false;
      }


    }
  }


}
