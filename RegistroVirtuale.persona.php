<?php

require_once 'RegistroVirtuale.1.3.php';

registro_virtuale_page_header();

echo '<h2>PERSONA</h2>';

$config["hostname"] = $server_connection["localhost"];
$config["user_name"] = $server_connection["usr_name"];
$config["user_pswd"] = $server_connection["pswd"];
$config["user_db"] = $server_connection["db_db"];
$config["row_count"] = $server_connection["row_count"];
$config["table_name"]   = 'PERSONA';
$config["table_pk"]     = 'ID';
$config["table_pk_auto"] = 'yes';
$config["column"]["ID"]["name"] = "ID";
$config["column"]["NOME"]["name"] = "NOME";
$config["column"]["COGNOME"]["name"] = "COGNOME";
$config["column"]["COGNOME"]["filter"] = "COGNOME";
$config["column"]["RUOLO"]["name"] = "RUOLO";
$config["column"]["RUOLO"]["filter"] = "RUOLO";
$config["column"]["RUOLO"]["sql_enum"] = "
SELECT VALORE 
FROM ENUM 
WHERE NOME = 'PERSONA RUOLO' 
ORDER BY VALORE";
$config["column"]["INDIRIZZO"]["name"] = "INDIRIZZO";
$config["column"]["CAP"]["name"] = "CAP";
$config["column"]["CITTA"]["name"] = "CITTA";
$config["column"]["CITTA"]["filter"] = "CITTA";
$config["column"]["TELEFONO"]["name"] = "TELEFONO";
$config["action"]       = 'IVUD'; // insert, view, update, delete
$config["table_sql_select"] = "
SELECT P.ID
, NOME
, COGNOME
, RUOLO
, INDIRIZZO
, CAP
, CITTA
, TELEFONO
FROM PERSONA P
ORDER BY 2, 3
";

$DBEdit = new DBEdit( $config );
if (! $DBEdit->errore)
{
   echo $DBEdit->execute();
}

registro_virtuale_page_footer();

?>
