<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
    <?php
    for($i=1;$i<11;$i++){
        //Filas impares fondo gris
        if($i%2==1){
            echo '<tr style="background-color:gray;">';
        } else{
            echo '<tr>';
        }
        for($j=1;$j<11;$j++){
            echo '<td>';
            $prod=$i*$j;
            echo $prod.'</td>';
        }
        echo '</tr>';
    }
    ?>
    </table>
</body>
</html>