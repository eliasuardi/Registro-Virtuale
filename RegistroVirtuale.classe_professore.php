<?php

require_once 'RegistroVirtuale.1.3.php';

registro_virtuale_page_header();

echo '<h2>CLASSE_PROFESSORE</h2>';
echo '<p>Definizione delle classi dei professori.</p>';

$config["hostname"] = $server_connection["localhost"];
$config["user_name"] = $server_connection["usr_name"];
$config["user_pswd"] = $server_connection["pswd"];
$config["user_db"] = $server_connection["db_db"];
$config["row_count"] = $server_connection["row_count"];
$config["table_name"]   = 'CLASSE_PROFESSORE';
$config["table_pk"]     = 'ID';
$config["table_pk_auto"] = 'yes';
$config["table_sql_select"] = "
SELECT CP.ID
, C.CLASSE
, C.ISTITUTO
, C.ANNO
, CONCAT( P.NOME , ' ' , P.COGNOME) AS PROFESSORE
, CP.MATERIA
, CP.TESTO
, CP.CLASSE_ID
FROM CLASSE C, CLASSE_PROFESSORE CP, PERSONA P
WHERE CP.PROF_ID = P.ID
AND CP.CLASSE_ID = C.ID
";
$config["action"]       = 'IVUD'; // insert, view, update, delete
$config["column"]["ID"]["name"] = "ID";
$config["column"]["CLASSE_ID"]["name"] = "CLASSE";
$config["column"]["CLASSE_ID"]["sql_fk"] = "SELECT ID, CONCAT( CLASSE, ' ' , ISTITUTO, ' ' , ANNO) FROM CLASSE ORDER BY 2";
$config["column"]["CLASSE_ID"]["filter"] = "CLASSE";
$config["column"]["PROF_ID"]["name"] = "PROFESSORE";
$config["column"]["PROF_ID"]["sql_fk"] = "SELECT ID, CONCAT( NOME , ' ' , COGNOME) FROM PERSONA P WHERE RUOLO = 'Professore' ORDER BY 1";
$config["column"]["PROF_ID"]["filter"] = "CONCAT( P.NOME , ' ' , P.COGNOME)";
$config["column"]["MATERIA"]["name"] = "MATERIA";
$config["column"]["MATERIA"]["sql_enum"] = "SELECT VALORE FROM ENUM WHERE NOME = 'MATERIA' ORDER BY VALORE";
$config["column"]["MATERIA"]["filter"] = "MATERIA";

$config["task_link"][0]["name"] = "Studenti";
$config["task_link"][0]["url"] = "RegistroVirtuale.classe_studente.php";
$config["task_link"][0]["param"][0]["name"] = "cid";
$config["task_link"][0]["param"][0]["col"] = "CLASSE_ID";
$config["task_link"][0]["param"][1]["name"] = "cna";
$config["task_link"][0]["param"][1]["col"] = "CLASSE";

$DBEdit = new DBEdit( $config );
if (! $DBEdit->errore)
{
   echo $DBEdit->execute();
}

registro_virtuale_page_footer();


?>
