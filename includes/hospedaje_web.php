<?php

/**
 * Description of hospedaje_web
 *
 * @author Edgar Messia
 */
class hospedaje_web extends db implements crud {
    
    const tabla = "hospedaje_web";
    
    public function actualizar($id, $data) {
        return db::update(self::tabla, $data, Array("id"=>$id));
    }

    public function borrar($id) {
        return db::delete(self::tabla, Array("id"=>$id));
    }

    public function borrarTodo() {
        return db::delete(self::tabla);
    }

    public function insertar($data) {
        return db::insert(self::tabla,$data);
    }

    public function listar() {
        return db::select("*", self::tabla);
    }

    public function ver($id) {
        return db::select("*",self::tabla,Array("id"=>$id));
    }

    public function obtenerInformacionCliente($id){
        
        return db::select("*",self::tabla,["id"=>$id]);
    }
    
    public function enviarNotificacionVencimiento($id, $template) {
        
        $data = $this->obtenerInformacionCliente($id);
        
        if ($data['suceed'] && count($data['data'])>0) {
            
            if (file_exists($template)) {
                $contenido_original = file_get_contents($template);
                
                if ($contenido_original=='') {
                    echo "No se puedo cargar el contenido de ".$template;
                    die();
                }
                
                // enviamos el email a los destinatarios
                $resultado='';
                $mail = new mailto(SMTP);
                $contenido = $contenido_original;
                // hacemos la personalizacion del contenido
                foreach ($data['data'][0] as $key => $value) {
                    if ($key=='fecha_vencimiento') $value = date('d-m-Y',strtotime($value));
                    if ($key=='monto') $value = number_format($value, 0,",",".");
                    $contenido = str_replace("[".$key."]", $value, $contenido);
                }
                // aquí enviamos el email
                $destinatario = $data['data'][0]['email'];
                // imagen
                $img = array();
                $imagen = array();
                //logo
                $imagen['path'] = '../img/logo.png';
                $imagen['path'] = realpath($imagen['path']);
                $imagen['cid'] = 'logo.png';
                $imagen['name'] = 'logo.png';
                $imagen['type'] = 'image/png';
                $img[] = $imagen;
                
                //ico facebook
                $imagen['path'] = '../notificaciones/plantillas/images/facebook.png';
                $imagen['path'] = realpath($imagen['path']);
                $imagen['cid'] = 'facebook.png';
                $imagen['name'] = 'facebook.png';
                $imagen['type'] = 'image/png';
                $img[] = $imagen;
                
                //ico twitter
                $imagen['path'] = '../notificaciones/plantillas/images/twitter.png';
                $imagen['path'] = realpath($imagen['path']);
                $imagen['cid'] = 'twitter.png';
                $imagen['name'] = 'twitter.png';
                $imagen['type'] = 'image/png';
                $img[] = $imagen;
                
                //ico pinterest
                $imagen['path'] = '../notificaciones/plantillas/images/pinterest.png';
                $imagen['path'] = realpath($imagen['path']);
                $imagen['cid'] = 'pinterest.png';
                $imagen['name'] = 'pinterest.png';
                $imagen['type'] = 'image/png';
                $img[] = $imagen;
                
                $r = $mail->enviar_email('Estado de cuenta '.$data['data'][0]['dominio'] , $contenido, '', $destinatario, $data['data'][0]['cliente'],null,$data['data'][0]['email_alternativo'],$img);
                //$r = $mail->enviar_email('Estado de cuenta '.$data['data'][0]['dominio'] , $contenido, '', 'ynfantes@gmail.com', '',null,'',$img);
                
                $resultado = "- Mensaje enviado a ".$destinatario." ".$data['data'][0]['email_alternativo'];
                if ($r == '') {
                    $resultado.= " Ok!\n";
                } else {
                    $resultado.= " Falló\n";
                }
                
                echo nl2br($resultado);
            } else {
                echo $template." no existe";
            }
        } else {
            echo "Dominio no registrado [$id]";
        }
    }
}
