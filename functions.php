<?php

	//established the connection between databse
	require("../dbconnection.php");

	session_start();
	
	//insert user defined function here
	// TODO - dynamic query
	function getNumRowsQuery($query) {
		global $sqlconnection;
		if ($result = $sqlconnection->query($query))
			return $result->num_rows;
		else
			echo "¡Algo anda mal en la consulta!";
	}

?>