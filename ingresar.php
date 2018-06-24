<?php

require_once "classes/validarFormulario.php";
require_once "conexion.php";

Validarformulario::setDb($db);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styledesktop.css">

    <title>Barrock Brewery</title>
    <link rel="shortcut icon" href="imagenes/barrockfavicon.png">
  </head>
  <body>
    <div class="main">
      <div class="loQueVaFixed">
              <div class="logo" id="logo">
                <a href="index.html"><img src="imagenes/Barrock Brewery.png" alt=""></a>
              </div>
              <nav class ="rubros">
                    <ul>
                      <a href="index.html"><li>Inicio</li></a>
                      <a href="preguntas.html"><li>Preguntas</li></a>
                      <a href="contacto.html"><li>Contacto</li></a>
                      <a href="ingresar.php"><li>Registrate</li></a>
                      <a href="login.php"><li>Login</li></a>
                    </ul>
              </nav>
              <div class="redes">
                <ul class="social">
                  <li><a href="http://www.twitter.com" target="_blank"><img src="imagenes/icono-tw.svg" alt=""></a></li>
                  <li><a href="http://www.instagram.com" target="_blank"><img src="imagenes/icono-ig.svg" alt=""></a></li>
                  <li><a href="http://www.facebook.com" target="_blank"><img src="imagenes/icono-fb.svg" alt=""></a></li>
                </ul>
              </div>
            </div>
      <div class="contenedor">

        <div class="formularios">

            <div class="registro">
              <h1>REGISTRATE Y OBTENÉ <br>INCREIBLES BENEFICIOS</h1>
              <form role="form" action="" method="post" enctype="multipart/form-data">
           		<div class="ingreso"></div>
              <div>
                <?php if ($_REQUEST) : ?>
                    <div style="font-size: 16px; color: red;">
                        <ul> <?php

                            $informacion = [
                              "username" => $_REQUEST['nombre'],
                              "email" => $_REQUEST['email'],
                              "password" => $_REQUEST['password'],
                              "cpassword" => $_REQUEST['password2'],
                              "telefono" => $_REQUEST['telefono'],
                            ];
                      $validar = new Validarformulario;
                      $validar ->validarInformacion($informacion);

                           ?>
                        </ul>
                    </div>
                <?php endif; ?>
           			<label>Nombre y Apellido</label><br><input type="text" name="nombre" placeholder="Nombre y Apellido" value=<?php if ($_POST) {echo $_POST["nombre"];} ?> >
           			</div>
           		<div>

           			<label>Email</label><br><input type="Email" name="email" placeholder="Ingresá un email" value=<?php if ($_POST) {echo $_POST["email"];} ?>>
           		</div>
           		<div>

           			<label>Contraseña</label><br><input name="password" placeholder="Ingresá una contraseña" type="password" value=<?php if ($_POST) {echo $_POST["password"];} ?> >
           		</div>

              <div>
                <label>Teléfono</label><br><input name="telefono" type="text" placeholder="Ingresá un teléfono" value=<?php if ($_POST) {echo $_POST["telefono"];} ?>  >
              </div>

           		<div>


           			<label>Confirmar Contraseña</label><br><input name="password2" placeholder="Confirmá tu contraseña" type="password" value=<?php if ($_POST) {echo $_POST["password2"];} ?> >

           		</div>
           		<div class="form-group">
           					<label>Foto</label><br>
           					<div>

           						<input type="file" name="foto-perfil">
           					</div>
           				</div>

           			<button type="submit" name="submit">ENVIAR</button>
           			<button type="reset">VOLVER</button>

           	 </form>
            </div>

            <div class="imagenregistro">
              <img src="imagenes/cervezalogin.png" style="width: 100%;">
            </div>
      </div>
    </div>
      <footer>
      <div class="contenedor">
        <div class="copy">
          <p id="copyright">® Copyright 2018</p>
        </div>
        <div class="copy2">
          <p>Cerveza artesanal significa independencia. Significa crear con ingredientes naturales,
            significa permanentemente descubrir, significa materias primas orgánicas, significa
            elaborar pensando siempre en la mejor calidad y en el respeto hacia la comunidad.</p>
        </div>
        <div class="redes2">
          <ul class="social">
            <li><a href="http://www.facebook.com" target="_blank"><img style="width: 100%;" src="imagenes/facebook-black-logo.jpg" alt=""></a></li>
          </ul>
        </div>
      <!--ACA IRIA ANCLA-->
      </div>
    </footer>

  </body>
</html>
