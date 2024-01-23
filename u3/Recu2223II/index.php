<?php
require_once 'Modelo.php';

$bd = new Modelo();
if ($bd->getConexion() == null) {
	$mensaje = "Error, no hay conexión con la bd";
} else {
	session_start();
	if (isset($_POST['resultados'])) {
		$partido = $bd->obtenerPartido($_POST['partido']);
		$_SESSION['partido'] = $partido;

		$cod = $partido->getCodigo();
		$_SESSION['codPartido'] = $cod;

		$jug1 = $partido->getJugador1();
		$_SESSION['jugador1Partido'] = $jug1;

		$jug2 = $partido->getJugador2();
		$_SESSION['jugador2Partido'] = $jug2;

		header('location:resultados.php');
	}
}
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Recupearción T3 2</title>
</head>

<body>
	<h1>Selecciona Partido</h1>
	<form action="" method="post">
		<select name="partido">
			<?php
			$partidos = $bd->obtenerPartidos();
			foreach ($partidos as $p) {
				echo '<option value="' . $p->getCodigo() . '">' . $p->getJugador1() . '-' . $p->getJugador2() . '</option>';
			}
			?>
		</select>
		<input type="submit" value="Resultados" name="resultados">
	</form>

</body>

</html>