<?php

require_once 'RegistroVirtuale.1.3.php';

registro_virtuale_page_header();

echo '<h2>COMUNICAZIONE</h2>';

global $server_connection;
$today = date("d-m-Y");

//$config["debug"] = 1;
$config["hostname"] = $server_connection["localhost"];
$config["user_name"] = $server_connection["usr_name"];
$config["user_pswd"] = $server_connection["pswd"];
$config["user_db"] = $server_connection["db_db"];
$config["row_count"] = $server_connection["row_count"];
$config["table_name"]   = 'COMUNICAZIONE';
$config["table_pk"]     = 'ID';
$config["table_pk_auto"] = 'yes';
$config["table_sql_select"] = "
SELECT C.ID
, DATE_FORMAT(DATA,'%d-%m-%Y') AS DATA
, TIPO
, CONCAT( SUBSTRING( NOTA, 1, 15), '...') AS NOTA
, ASSENZA_GIORNI
, ASSENZA_ORE
, CONCAT( PP.NOME , ' ' , PP.COGNOME) AS STUDENTE
, CONCAT( P.NOME , ' ' , P.COGNOME) AS PROFESSORE
, CONCAT( PPP.NOME , ' ' , PPP.COGNOME) AS GENITORE
FROM COMUNICAZIONE C
LEFT JOIN PERSONA P ON C.PROF_ID = P.ID
LEFT JOIN PERSONA PPP ON C.GENITORE_ID = PPP.ID,
PERSONA PP
WHERE C.STUDENTE_ID = PP.ID
ORDER BY 2
";
$config["action"] = 'IVUD'; // insert, view, update, delete
$config["column"]["ID"]["name"] = "ID";
$config["column"]["DATA"]["name"] = "DATA";
$config["column"]["DATA"]["value"] = $today;
$config["column"]["DATA"]["format"] = "d-m-Y";
$config["column"]["TIPO"]["name"] = "TIPO";
$config["column"]["TIPO"]["sql_enum"] = "SELECT VALORE FROM ENUM WHERE NOME = 'TIPO_COMUNICAZIONE' ORDER BY SEQUENZA";
$config["column"]["NOTA"]["name"] = "NOTA";
$config["column"]["NOTA"]["html"] = '<TEXTAREA ROWS="3" COLS="50" NAME="%name%">%value%</TEXTAREA>';
$config["column"]["ASSENZA_GIORNI"]["name"] = "GIORNI";
$config["column"]["ASSENZA_ORE"]["name"] = "ORE";
$config["column"]["STUDENTE_ID"]["name"] = "STUDENTE";
$config["column"]["STUDENTE_ID"]["sql_fk"] = "SELECT ID, CONCAT( NOME , ' ' , COGNOME) FROM PERSONA PP WHERE RUOLO = 'Studente'";
$config["column"]["STUDENTE_ID"]["filter"] = "CONCAT( PP.NOME , ' ' , PP.COGNOME)";
$config["column"]["PROF_ID"]["name"] = "PROFESSORE";
$config["column"]["PROF_ID"]["sql_fk"] = "SELECT ID, CONCAT( NOME , ' ' , COGNOME) FROM PERSONA P WHERE RUOLO = 'Professore'";
$config["column"]["PROF_ID"]["filter"] = "CONCAT( P.NOME , ' ' , P.COGNOME)";
$config["column"]["GENITORE_ID"]["name"] = "GENITORE";
$config["column"]["GENITORE_ID"]["sql_fk"] = "SELECT ID, CONCAT( NOME , ' ' , COGNOME) FROM PERSONA PPP WHERE RUOLO = 'Genitore'";
$config["column"]["GENITORE_ID"]["filter"] = "CONCAT( PPP.NOME , ' ' , PPP.COGNOME)";

// il task di inserimento usa il filtro sulla colonna STUDENTE
// il valore di $_REQUEST["studente"] deve corrispondere alla colonna (vedi valutazione)
$config["task"]["Comunicazione"]["action"] = "I";
$config["task"]["Comunicazione"]["title"] = "Nuova comunicazione per " . @$_REQUEST["studente"];
$config["task"]["Comunicazione"]["filter"]["STUDENTE"] = @$_REQUEST["studente"];

$DBEdit = new DBEdit( $config );
if (! $DBEdit->errore)
{
   echo $DBEdit->execute();
}

registro_virtuale_page_footer();


?>
