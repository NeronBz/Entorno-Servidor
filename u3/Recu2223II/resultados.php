<?php
require_once 'Modelo.php';

$bd = new Modelo();
if ($bd->getConexion() == null) {
	$mensaje = "Error, no hay conexión con la bd";
} else {
	session_start();
	if (
		!isset($_SESSION['codPartido']) && !isset($_SESSION['jugador1Partido']) &&
		!isset($_SESSION['jugador2Partido'])
	) {
		header('location:index.php');
	} else {
		if (isset($_POST['cambiar'])) {
			session_unset();
			header('location:index.php');
		} elseif (isset($_POST['grabarSet'])) {
			if (empty($_POST['juegosJ1']) or empty($_POST['juegosJ2'])) {
				$mensaje = "Los campos de los juegos de jugadores están vacíos";
			} else {
				$p = $_SESSION['partido'];
				$rp = new ResultadoPartido($_SESSION['codPartido'], $_POST['set'], $_POST['juegosJ1'], $_POST['juegosJ2']);
				if ($bd->insertarResultadoPartido($rp)) {
					$mensaje = 'Resultado del partido definido';
				} else {
					$mensaje = 'Error al guardar resultados';
				}
			}
		}
	}
}
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Recuperación T3 2</title>
</head>

<body>
	<form action="" method="post">
		<input type="submit" name="cambiar" value="Cambiar Partido" />
		<hr />
		<h1>
			<?php
			$j1 = $_SESSION['jugador1Partido'];
			$j2 = $_SESSION['jugador2Partido'];
			echo $j1, '/', $j2;
			?>
		</h1>
		<h2 style="color:red;"><?php if (isset($mensaje)) echo $mensaje ?></h2>
		<hr />
		<h2>Datos del Partido</h2>
		<table width="50%">
			<tr>
				<td><b>Código</b></td>
				<td><b>Jugador 1</b></td>
				<td><b>Jugador 2</b></td>
				<td><b>Fecha</b></td>
				<td><b>Número de Sets</b></td>
				<td><b>Finalizado</b></td>
			</tr>
			<?php
			if (isset($_SESSION['partido'])) {
				$p = $_SESSION['partido'];
				echo '<tr>';
				echo '<td>', $p->getCodigo(), '</td>';
				echo '<td>', $p->getJugador1(), '</td>';
				echo '<td>', $p->getJugador2(), '</td>';
				echo '<td>', $p->getFecha(), '</td>';
				echo '<td>', $p->getNumSets(), '</td>';
				if ($p->getFinalizado() == 0) {
					echo '<td>No</td>';
				} elseif ($p->getFinalizado() == 1) {
					echo '<td>Sí</td>';
				}
				echo '</tr>';
			}
			?>
		</table>
		<hr />
		<h2>Estadísticas Jugadores</h2>
		<table width="50%">
			<tr>
				<th align="left">Jugador</th>
				<th align="left">Ganados</th>
				<th align="left">Jugados</th>
			</tr>
			<?php
			$jugador1 = $bd->obtenerJugadorPartido($j1);
			$jugador2 = $bd->obtenerJugadorPartido($j2);
			$jugados1 = $bd->calcularJugados($j1);
			$jugados2 = $bd->calcularJugados($j2);
			echo '<tr>';
			echo '<td>', $jugador1->getNombre(), '</td>';
			echo '<td>', $jugador1->getGanados(), '</td>';
			echo '<td>', $jugados1, '</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>', $jugador2->getNombre(), '</td>';
			echo '<td>', $jugador2->getGanados(), '</td>';
			echo '<td>', $jugados2, '</td>';
			echo '</tr>';
			?>
		</table>
		<hr />

		<h2>Resultados del Partido</h2>
		<table width="50%">
			<tr>
				<th align="left">Set</th>
				<th align="left">Juegos Jugador1</th>
				<th align="left">Juegos Jugador2</th>
				<th align="left">Acción</th>
			</tr>
			<tr>
				<?php
				$resultadoP = $bd->obtenerResultadoPartido($_SESSION['codPartido']);
				if (empty($resultadoP)) {
					echo 'No hay ningún resultado de partido';
				} else {
					foreach ($resultadoP as $resul) {
						echo '<tr>';
						echo '<td>', $resul->getNumSet(), '</td>';
						echo '<td>', $resul->getJuegosJ1(), '</td>';
						echo '<td>', $resul->getJuegosJ2(), '</td>';
						echo '</tr>';
					}
				}
				?>
			</tr>
			<tr>
				<td><select name="set">
						<?php
						$nSet = 6;
						for ($i = 1; $i < $nSet; $i++) {
							echo '<option value"' . $i . '">' . $i . '</option>';
						}
						?>
					</select></td>
				<td><input type="number" name="juegosJ1" /></td>
				<td><input type="number" name="juegosJ2" /></td>
				<td><input type="submit" name="grabarSet" value="Guardar Set" /></td>

			</tr>
			<tr>
				<td></td>
				<td><input type="radio" name="ganador" value="j1" />Gana
					<?php
					if ($resultadoP !== null) {
						foreach ($resultadoP as $res) {
							if ($res->getJuegosJ1() === null) {
								echo 'No hay Jugador 1';
							} else {
								echo $jugador1->getNombre();
							}
						}
					} else {
						echo '(Jugador en blanco)';
					}
					?>
				</td>
				<td><input type="radio" name="ganador" value="j2" />Gana
					<?php
					if ($resultadoP !== null) {
						foreach ($resultadoP as $res) {
							if ($res->getJuegosJ2() === null) {
								echo 'No hay Jugador 2';
							} else {
								echo $jugador2->getNombre();
							}
						}
					} else {
						echo '(Jugador en blanco)';
					}
					?>
				</td>
				<td><input type="submit" name="finPartido" value="Finalizar" /></td>
			</tr>

		</table>
	</form>
</body>

</html>