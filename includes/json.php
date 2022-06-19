<?php
include './constants.php';
include './mailto.php';
$ini = parse_ini_file('./emails.ini');
if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case "email_contacto":
            $mail = new mailto();
            $mensaje = sprintf($ini['CUERPO_CONTACTO_PRONET21'], $_POST['name'], $_POST['message'], $_POST['email']);
            $r = $mail->enviar_email($ini['ASUNTO_CONTACTO'], $mensaje, "", USER_MAIL);
            break;

        case "email_cotiza":
           $mail = new mailto();
            $mensaje = sprintf($ini['CUERPO_COTIZA_PRONET21'], $_POST['name'], $_POST['message'], $_POST['email'], $_POST['servicio'], $_POST['celular']);
            $r = $mail->enviar_email($ini['ASUNTO_CONTACTO'], $mensaje, "", USER_MAIL);
            break;
    }
    if ($r == "") {
        $mail = new mailto();
        $mensaje = sprintf($ini['CUERPO_CONTACTO'], $_POST['name']);
        $r = $mail->enviar_email($ini['ASUNTO_CONTACTO'], $mensaje, "", $_POST['email']);
        echo '<h4>Menseje enviado con éxito!</h4>En breve estaremos 
                    contactando con usted.<br>Gracias por su interés.';
    } else {
        echo '<h4>Error al enviar el mensaje.</h4>
                    No se pudo enviar el mensaje. Por favor intente nuevamente.';
    }
}
?>
