<?php

//Incluir librería phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../../vendor/autoload.php';


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
        $correo->Password = '';
        $correo->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $correo->Port = 465;

        //Configuración del correo que vamos a escribir
        $correo->setFrom('rblazquezi02@educarex.es', 'Raúl');
        $correo->addAddress($propietario->getEmail(), $propietario->getNombre());
        //Configuración del contenido del mensaje
        $correo->isHTML(true);
        $correo->CharSet = 'UTF-8';
        $correo->Subject = 'Factura de reparación Nº ' . $r->getId();
        $texto = textoReparacion($r, $detalle, $propietario);
        $correo->Body = $texto;
        $correo->AltBody = "<h1>Hola Mundo</h1>";
        $correo->addAttachment('../img/info.png');
        //Enviar correo
        if ($correo->send()) {
            $resultado = true;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $resultado;
}
function textoReparacion(Reparacion $r, $detalle, Propietario $propietario)
{
    $texto = "<div>Nombre: " . $propietario->getNombre() . "</br>";
    $texto .= "DNI: " . $propietario->getDni() . "</div>";
    $texto .= "<div>Nº Reparación: " . $r->getId() . "</br>";
    $texto .= "Fecha: " . date("d/m/Y", strtotime($r->getFecha())) . "</div>";
    $texto .= "<table><tr><td>Concepto</td><td>Cantidad</td><td>Precio Unidad</td>
        <td>Total</td>";
    foreach ($detalle as $d) {
        $texto .= "<tr><td>" . $d['Concepto'] . "</td><td>" . $d['Cantidad'] .
            "</td><td>" . $d['Importe'] . "</td><td>" . $d['Total'] . "</td></tr>";
    }
    $texto .= "<tr><td colspan='3'>Total Reparación</td><td>" .
        $r->getImporteTotal() . "</td></tr>";
    $texto .= "<table>";
    return $texto;
}
