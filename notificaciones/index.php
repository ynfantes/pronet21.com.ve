<?php
include_once '../includes/constants.php';
$accion = isset($_GET['accion']) ? $_GET['accion'] : "";

switch ($accion) {   
    
    case "vencimiento-web":
        $id         = $_GET['id'];
        $hospedaje  = new hospedaje_web();
        $hospedaje->enviarNotificacionVencimiento($id,'plantillas/vencimiento/pagina-web.html');
        //hospedaje_web::enviarNotificacionVencimiento($id,'plantillas/vencimiento/pagina-web.html');
        break;
    default :
        die("Acceso restringido");
        break;
}