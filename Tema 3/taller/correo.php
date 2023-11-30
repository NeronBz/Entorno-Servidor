<?php

//Incluir librería phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//lyhkxccxvyxjuilr

function enviarCorreo($r, $detalle)
{
    $resultado = false;
    try {
        $correo = new PHPMailer(true);
        //Configurar datos del servidor saliente
        $correo->isSMTP();
        $correo->Host = 'smtp.gmail.com';
        $correo->SMTPAuth = true;
        $correo->Username = 'rblazquezi02@educarex.es';
        $correo->Password = '';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $resultado;
}
