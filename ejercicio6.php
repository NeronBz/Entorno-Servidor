<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $num1=rand(0,10);
    $num2=rand(0,10);

    if(is_int($num1) && is_int($num2)){
        if($num2==0){
            echo 'Error, el segundo número es 0';
        } else{

    echo 'La suma de '.$num1.'+'.$num2.' es: '.($num1+$num2);
    echo '<br/>La resta de '.$num1.'-'.$num2.' es: '.($num1-$num2);
    echo '<br/>La multiplicación de '.$num1.'*'.$num2.' es: '.($num1*$num2);
    echo '<br/>La división de '.$num1.'/'.$num2.' es: '.($num1/$num2);
    echo '<br/>El resto de '.$num1.'%'.$num2.' es: '.($num1%$num2);
    echo '<br/>La potencia de '.$num1.' elevado a '.$num2.' es: '.($num1**$num2);
        }
    } else{
        echo 'Algún número no es entero';
    }

    ?>
</body>
</html>