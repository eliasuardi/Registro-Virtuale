<?php
// qui oppure includere RegistroVirtuale.1.3? Perché non separare in file con solo dati connessione?
$server_connection["localhost"] = 'localhost';
$server_connection["usr_name"] = 'root';
$server_connection["pswd"] = '';
$server_connection["db_db"] = 'registro';

$con = mysql_connect($server_connection["localhost"],$server_connection["usr_name"],$server_connection["pswd"])or die("Impossibile stabilire una connessione".mysql_error());
mysql_select_db($server_connection["db_db"],$con)or die("Impossibile accedere al database".mysql_error());
?>
