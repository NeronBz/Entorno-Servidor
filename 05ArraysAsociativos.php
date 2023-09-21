<?php
//Definición de a rray asociativo
$persona = array('Nombre' => 'Ana', 'Edad' => 23, 'Estatura' => 1.73);

//Mostrar array
echo "<h1>Mostrar mascotas con vardump</h1>";
var_dump($persona);

//Acceder al array como si fuera un array escalar
echo "<h1>Acceder a la posición 0 de un array Asociativo</h1>";
$persona[0];

//Acceder por nombre a los elementos de un array asociativo
echo "<p>";
echo "Nombre: " . $persona['Nombre'] . "<br/>Edad: " . $persona['Edad'] . "<br/>Estatura: " . $persona['Estatura'];
echo "</p>";

//Mostrar el array
echo "<h1>Mostrar array personas con foreach</h1>";
foreach ($persona as $valor) {
    echo $valor . " ";
}

//Mostrar el array con foreach mostrando los indices
echo "<h1>Mostrar array con foreach mostrando los clave</h1>";
foreach ($persona as $indice => $valor) {
    echo "Clave: $indice Valor: $valor <br/>";
}

//Crear un array asociativo vacío
$mascota = array();

//Asignar valores al array mascota
$mascota['nombre'] = 'Tobby';
$mascota['tipo'] = 'Perro';
$mascota['nombrePropietario'] = 'Ana';

echo "<h1>Mostrar mascotas con vardump</h1>";
var_dump($mascota);

//Mostrar el array con foreach mostrando los indices
echo "<h1>Mostrar array con foreach mostrando las claves</h1>";
foreach ($mascota as $clave => $valor) {
    echo "Clave: $indice Valor: $valor <br/>";
}

//Crear un nuevo elemento en array mascotas, sin especificar el índice
$mascota['edad'] = 5;

echo "<h1>Mostrar mascotas con vardump</h1>";
var_dump($mascota);

//Mezclar array asociativo y escalar
//Crear un elemento sin especificar la clave
echo "<h1>Mostrar array mascota con posiciones asociativas y escalares</h1>";
$mascota[] = 1234;
var_dump($mascota);
