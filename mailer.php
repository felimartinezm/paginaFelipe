
<?php
  require_once("Exception.php");
  require_once("PHPMailer.php");
  try {
    $mail = new PHPMailer();

    $name = $_POST['nombre'];
    $email = $_POST['email'];
    $user_message = $_POST['mensaje'];

    if($user_message != "" && $email != ""){

      //Luego tenemos que iniciar la validación por SMTP:
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
      //Si activas esto se mostrarán todos los logs de errores
      //$mail->SMTPDebug = 2;
      $from = "noreply@felimartinez.cl"; // Correo desde el cual se mandan las solicitudes
      $mail->SMTPSecure = 'tls';
      $mail->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
      $mail->Username = $from; // Correo completo a utilizar
      $mail->Password = "piriwo_2017"; // Contraseña
      $mail->Port = 587; // Puerto a utilizar
      $mail->AddReplyTo($_POST['email'], $_POST['name']);
      $mail->SetFrom($from, $_POST['name'], $_POST['name']);
      $mail->AddAddress("hola@felimartinez.cl"); // Destinatario, debe ser el correo del cliente al cual recibe las solicitudes
      $mail->IsHTML(false); // El correo se envía como HTML
      $mail->Subject = "Contacto de la página"; // Este es el titulo del email.
      $body =  "Nombre: " . $name . "\n\n" .
        "Email Address: " . $email . "\n\n" .
        "Mensaje: " . $user_message ;
      $mail->Body = $body; // Mensaje a enviar
      $exito = $mail->Send(); // Envía el correo.
    }
    echo 
        '<script type="text/javascript">
          alert("Tu mensaje ha sido enviado con éxito");
          location.replace("https://www.felimartinez.cl/");
        </script>';
  } catch (Exception $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
  } catch (\Exception $e) { //The leading slash means the Global PHP Exception class will be caught
      echo $e->getMessage(); //Boring error messages from anything else!
  }
?>