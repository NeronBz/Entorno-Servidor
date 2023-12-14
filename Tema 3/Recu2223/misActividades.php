<?php
require_once 'Modelo.php';
require_once 'Usuario.php';
require_once 'Cliente.php';
function rellenarSelected($id)
{
	if (isset($_POST['actividad'])) {
		if ($_POST['actividad'] == $id) {
			return 'selected = "selected"';
		}
	}
}

session_start();
//Chequear si hay cliente en la sesión
if (!isset($_SESSION['usuario']) or isset($_POST['salir'])) {
	//Redirigir a login
	session_unset();
	header('location:login.php');
} else {
	//Hay empleado conectado
	$usuario = $_SESSION['usuario'];
	if ($usuario->getTipo() != 'C') {
		header('location:login.php');
	}
}

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Recuperaci�n T3 22_23</title>
</head>

<body>
	<?php
	$bd = new Modelo();
	if ($bd->getConexion() == null) {
		$mensaje = 'Error, no hay conexión con la base de datos mensajes';
	} else {
		$cliente = $bd->obtenerCliente($usuario->getUsuario());
		$actividades = $bd->obtenerActividades();
		$actividades_contratadas = $bd->obtenerActividadesContratadas($cliente->getId());
		if (isset($_POST['actividad'])) {
			$aSel = $bd->obtenerActividad($_POST['actividad']);
		} else {
			$aSel = $bd->obtenerPrimeraActividad();
		}
		if (isset($_POST['contratar'])) {
			if ($bd->existeActividadContratada($cliente->getId(), $_POST['actividad'])) {
				$mensaje = 'Ya ha contratado esta actividad';
			} else {
				if ($bd->contratarActividad($cliente->getId(), $_POST['actividad'])) {
					$mensaje = 'Se ha contratado con éxito';
				} else {
					$mensaje = 'No se pudo contratar la actividad';
				}
			}
		}
		if (isset($_POST['baja'])) {
			if ($bd->existeActividadContratada($cliente->getId(), $_POST['actividad'])) {
				if ($bd->darDeBaja($cliente->getId(), $_POST['actividad'])) {
					$mensaje = 'Se ha dado de baja con éxito';
				} else {
					$mensaje = 'No se pudo dar de baja';
				}
			} else {
				$mensaje = 'No ha contratado en un primer momento esta actividad';
			}
		}
	}
	?>
	<form action="misActividades.php" method="post">
		<h1 style="color:blue;">
			<?php echo isset($mensaje) ? $mensaje : ''; ?>
		</h1>
		<h1 style="color:blue;">INSCRIBETE EN LAS ACTIVIDADES QUE TE GUSTEN</h1>
		<h2 style="color:blue;">
			<?php
			echo 'Cliente: ' . $cliente->getId() . ' - ' .
				'Nombre: ' . $cliente->getNombre();
			?>
		</h2>
		<div>
			<h3 style='color:red;'>Mensaje</h3>
		</div>
		<label>Actividad</label>
		<select id="actividad" name="actividad" onchange="this.form.submit()">
			<?php
			foreach ($actividades as $a) {
				echo "<option value='" . $a->getId() . "'" . rellenarSelected($a->getId()) . ">" . $a->getNombre() . "</option>";
			}
			?>
		</select>
		<label>Coste Mensual</label>
		<input type="number" value="<?php echo $aSel->getCoste_mensual(); ?>" disabled="disabled" />
		<input type="submit" name="contratar" value="Contratar" />
		<input type="submit" name="baja" value="Baja" />
		<input type="submit" name="salir" value="Salir" />
	</form>
	<h3 style='color:blue;'>Actividades Contratadas</h3>
	<hr />
	<table width="100%">
		<tr>
			<th align="left">Id</th>
			<th align="left">Nombre</th>
			<th align="left">Coste Mensual</th>
		</tr>
		<?php
		foreach ($actividades_contratadas as $ac) {
			echo '<tr>';
			echo '<td align="left">' . $ac->getId() . '</td>';
			echo '<td align="left">' . $ac->getNombre() . '</td>';
			echo '<td align="left">' . $ac->getCoste_mensual() . '€</td>';
			echo '</tr>';
		}
		?>
	</table>
	<hr />
</body>

</html>