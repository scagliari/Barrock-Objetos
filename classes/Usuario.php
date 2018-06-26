
<?php

class Usuario
{
    private $id;
    private $nombreapellido;
    private $password;
    private $email;
    private $avatar;
    private static $db;


    public static function setDb($db)
    {
        self::$db = $db;
    }





    public function __construct($nombreapellido, $password, $email, $avatar = null)
    {
        $this->setNombre($nombreapellido);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setAvatar($avatar);
    }


    // Getters
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    // Setters
    public function setNombre($nombreapellido)
    {

          $this->nombreapellido = $nombreapellido;

    }


    public function setEmail($email)
    {
            $this->email = $email;
    }

    public function setPassword($password)
    {

            $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setAvatar($avatar)
    {

    }


    // Methods
    public function validaryguardar()
    {

      session_start();

      global $db;
      // Preparo un stmt de tipo INSERT
      $stmt = $db->prepare('INSERT INTO usuarios
          (NombreApellido, email, contrasenia)
          VALUES (:username, :email, :password)');

      // Bindeo los valores
      $stmt->bindValue(":username", $this->nombreapellido);
      $stmt->bindValue(":email", $this->email);
      $stmt->bindValue(":password", $this->password);
      // Ejecuto el stmt
      $stmt->execute();

      //Macheo el nombre que me llega por Post con usuarios SESSION
      $_SESSION['usuario'] = $_POST['nombre'];
      //Si está todo bien redirijo a la página de bienvenido
      header("Location: bienvenido.php");
      exit;
      }

      public function guardarAvatar($nombreDelFile) {

      $file = $_FILES[$nombreDelFile];
      $nombre = $file['name'];
      $tmp = $file['tmp_name'];
      $ext = pathinfo($nombre, PATHINFO_EXTENSION);
      $carpetaDondeQuieroGuardar = "./avatar/";

      $date = new DateTime();
      $urlFinalConNombreYExtension = $carpetaDondeQuieroGuardar . "perfil_". $_POST["email"] ."." . $ext;
      $result = move_uploaded_file($tmp, $urlFinalConNombreYExtension);
      return $urlFinalConNombreYExtension;

      }



}
