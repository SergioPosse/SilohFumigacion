<?php
function connect(){
		$mysqli = new mysqli("localhost", "root", "", "siloh");

		if($mysqli)
		{
			return $mysqli;
		}
		else
		{
			echo "<b>Fallo al conectar a la BD: </b>" . $mysqli->connect_errno . "---" . $mysqli->connect_error;
			return $mysqli;
		}

}
?>