<?php
//Declaración de variables de diferentes tipos
$nombre='Raúl';
$edad=19;
$estatura=1.88;
$esAlumno=true;

//Mostrar el valor de las variables
echo 'Nombre: '.$nombre; //Con el . concatenamos
echo "<br/>Edad: $edad"; //Dentro de "" podemos usar las variables y se sustituyen por su valor
echo '<br/>Estatura: '.$estatura;
echo '<br/>Es alumno: '.$esAlumno;

echo '<table border="1">';
echo '<tr><th>Variable</th><th>Tipo</th></tr>';
echo '<tr><th>Nombre</th><th>'.gettype($nombre).'</th></tr>';
echo '<tr><th>Edad</th><th>'.gettype($edad).'</th></tr>';
echo '<tr><th>Estatura</th><th>'.gettype($estatura).'</th></tr>';
echo '<tr><th>Es Alumno</th><th>'.gettype($esAlumno).'</th></tr>';
echo '</table>';
?>