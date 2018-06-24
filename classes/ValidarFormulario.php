<?php

require_once "Usuario.php";
require_once "ConectaryValidar.php";

class Validarformulario {

  private static $db;

  public static function setDb($db)
  {
      self::$db = $db;
  }


 public function validarInformacion($informacion) {
   $arrayDeErrores = [];

   foreach ($informacion as $key => $value) {
     $informacion[$key] = trim($value);
   }

   if(strlen($informacion["username"]) < 3 || strlen($informacion["username"]) > 20) {
     $arrayDeErrores["username"] = "El Username es demasiado corto.";
   }



   $validaremail = new ConectaryValidar;
   if ($validaremail->emailyaexiste($informacion["email"]) == true){
   $arrayDeErrores["email"] = "El email ingresado ya existe.";
    }

   else if (strlen($informacion["email"]) == 0) {
     $arrayDeErrores["email"] = "No ingresaste un email.";
   }
   else if(filter_var($informacion["email"], FILTER_VALIDATE_EMAIL) == false) {
     $arrayDeErrores["email"] = "El email ingresado no es válido.";
   }



   if (strlen($informacion["telefono"]) == 0) {
     $arrayDeErrores["telefono"] = "No ingresaste un teléfono.";
   } elseif (!(is_numeric($informacion["telefono"])))
   {$arrayDeErrores["telefono"] = "El número de teléfono debe ser numérico.";}

   if (strlen($informacion["password"]) < 6) {
     $arrayDeErrores["password"] = "La contraseña tiene que tener al menos 6 caracteres.";
   } else if ($informacion["password"] != $informacion["cpassword"]) {
     $arrayDeErrores["password"] = "La contraseña no verifica.";
   }

   if ($_FILES) {
     $errorDeLaFoto = $_FILES["foto-perfil"]["error"];
       $nombreDeLaFoto = $_FILES["foto-perfil"]["name"];
       $extension = pathinfo($nombreDeLaFoto, PATHINFO_EXTENSION);

       if ($errorDeLaFoto != UPLOAD_ERR_OK) {
         $arrayDeErrores["foto-perfil"] = "Por favor, subí una foto.";
       }
       else if ($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif" && $extension != "PNG") {
         $arrayDeErrores["foto-perfil"] = "El archivo que subiste no es una imagen.";
       }
    }

   foreach($arrayDeErrores as $error) : ?>
   <li><?php echo $error ?></li>
   <?php endforeach;

   if (!($arrayDeErrores)) {
$usuario = new Usuario($informacion["username"], $informacion["password"], $informacion["email"]);
$usuario->guardarAvatar("foto-perfil");
$usuario->validaryguardar();



 }
}



 public function validarLogin($informacion) {
   $arrayDeErrores = [];

   $validaremail = new ConectaryValidar;
   if ($validaremail->validarlogin($informacion["email"], $informacion["password"]) == true){

      session_start();
      $_SESSION['usuario'] = $_POST['email'];
      header("Location: bienvenido.php");
    }

  elseif ($validaremail->validarlogin($informacion["email"], $informacion["password"]) == false){

     $arrayDeErrores["email"] = "El email o la contraseña ingresada es incorrecta";
   }


  else if (strlen($informacion["email"]) == 0) {
     $arrayDeErrores["email"] = "Eu, ni pusiste mail";
   }
   else if(filter_var($informacion["email"], FILTER_VALIDATE_EMAIL) == false) {
     $arrayDeErrores["email"] = "Pusiste un mail que no era valido";
   }

   foreach($arrayDeErrores as $error) : ?>
   <li><?php echo $error ?></li>
   <?php endforeach;
 }
}

?>
