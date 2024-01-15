<?php
function dividir($a, $b)
{
    return $a / $b;
}

$num1 = 10;
$num2 = 0;
//Se produce excepción y no la capturamos
//echo 'Resultado: ' . dividir($num1, $num2);

try {
    echo 'Resultado: ' . dividir($num1, $num2);
} catch (Throwable $e) {
    //Capturamos excepción con clase Throwable
    echo 'Error: ' . $e->getMessage();
}

function dividirConExcepcion($a, $b)
{
    //Comprueba que los tipos de datos son enteros y si no, lanza una excepción de tipo Exception
    if (!is_int($a) or !is_int($b)) {
        throw new Exception('Excepción tipos de datos incorrecto');
    }
    return $a / $b;
}

//Capturar las dos excepciones con Throwable
$num1 = 'a';
try {
    echo 'Resultado: ' . dividirConExcepcion($num1, $num2);
} catch (Throwable $e) {
    //Capturamos excepción con clase Throwable
    echo 'Error: ' . $e->getMessage();
}

//Capturar las dos excepciones con Throwable
$num1 = 'a';
try {
    echo 'Resultado: ' . dividirConExcepcion($num1, $num2);
} catch (Error | Exception $e) {
    //Capturamos excepción con clase Throwable
    echo 'Error: ' . $e->getMessage();
}
