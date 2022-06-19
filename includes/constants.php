<?php
date_default_timezone_set("America/Caracas");
$debug = true;
$email_error = true;
$mostrar_error = true;

if ($_SERVER['SERVER_NAME'] == "www.pronet21.com.ve" | $_SERVER['SERVER_NAME'] == "pronet21.com.ve") {
    $user = "pronet21_root";
    $password = "pronet215231";
    $db = "pronet21_com_ve";
} else {
    $user = "root";
    $password = "";
    $db = "pronet21_com_ve";
}
define("HOST", "localhost");
define("USER", $user);
define("PASSWORD", $password);
define("DB", $db);

define("SISTEMA", $sistema);
define("EMAIL_ERROR", $email_error);
define("EMAIL_CONTACTO", "ynfantes@gmail.com");
define("EMAIL_TITULO", "error");
define("MOSTRAR_ERROR", $mostrar_error);
define("DEBUG", $debug);

define("mailPHP",0);
define("sendMail",1);
define("SMTP",2);
define("NOMBRE_APLICACION","Conctacto Pronet21");
define("SMTP_SERVER","mail.pronet21.com.ve");
define("PORT","25");
define("USER_MAIL","info@pronet21.com.ve");
define("PASS_MAIL","pronet215231");
define("DEMO",0);

define("SERVER_ROOT", $_SERVER['DOCUMENT_ROOT']);

function __autoload($clase) {
    include_once SERVER_ROOT . "/includes/" . $clase . ".php";
}

spl_autoload_register("__autoload", false);