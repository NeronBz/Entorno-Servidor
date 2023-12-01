<?php

//Incluir librería phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../../vendor/autoload.php';
//lyhkxccxvyxjuilr

function enviarCorreo(Modelo $bd, $r, $detalle, $propietario)
{
    $resultado = false;
    try {
        $correo = new PHPMailer(true);
        //Configurar datos del servidor saliente
        $correo->isSMTP();
        $correo->Host = 'smtp.gmail.com';
        $correo->SMTPAuth = true;
        $correo->Username = 'rblazquezi02@educarex.es';
        $correo->Password = 'lyhkxccxvyxjuilr';
        $correo->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $correo->Port = 465;

        //Configuración del correo que vamos a escribir
        $correo->setFrom('rblazquezi02@educarex.es', 'Raúl');
        $correo->addAddress($propietario->getEmail(), $propietario->getNombre());
        //Configuración del contenido del mensaje
        $correo->isHTML(true);
        $correo->Subject = 'Factura de reparación Nº ' . $r->getId();
        $correo->Body = "<h1>Hola Mundo</h1>";
        $correo->AltBody = "<h1>Hola Mundo</h1>";
        //Enviar correo
        if ($correo->send()) {
            $resultado = true;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $resultado;
}
