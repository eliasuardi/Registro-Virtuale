<?php

require_once 'RegistroVirtuale.1.3.php';

registro_virtuale_page_header();

echo '<h2>CLASSE_STUDENTE</h2>';
echo '<p>Definizione della struttura delle classi.</p>';

$config["hostname"] = $server_connection["localhost"];
$config["user_name"] = $server_connection["usr_name"];
$config["user_pswd"] = $server_connection["pswd"];
$config["user_db"] = $server_connection["db_db"];
$config["row_count"] = $server_connection["row_count"];
$config["table_name"]   = 'CLASSE_STUDENTE';
$config["table_pk"]     = 'ID';
$config["table_pk_auto"] = 'yes';
$config["table_sql_select"] = "
SELECT CS.ID
, C.CLASSE
, C.ISTITUTO
, C.ANNO
, CONCAT( P.NOME , ' ' , P.COGNOME) AS STUDENTE
FROM CLASSE C, CLASSE_STUDENTE CS, PERSONA P
WHERE CS.STUDENTE_ID = P.ID
AND CS.CLASSE_ID = C.ID
";
$config["action"]       = 'IUD'; // insert, view, update, delete
$config["column"]["ID"]["name"] = "ID";
$config["column"]["CLASSE_ID"]["name"] = "CLASSE";
$config["column"]["CLASSE_ID"]["sql_fk"] = "SELECT ID, CONCAT( CLASSE, ' ' , ISTITUTO, ' ' , ANNO) FROM CLASSE ORDER BY 2";
$config["column"]["CLASSE_ID"]["filter"] = "CLASSE";
$config["column"]["STUDENTE_ID"]["sql_fk"] = "SELECT ID, CONCAT( NOME , ' ' , COGNOME) FROM PERSONA WHERE RUOLO = 'Studente'";
$config["task"]["Studenti"]["action"] = "S";
$config["task"]["Studenti"]["where"] = "C.ID = " . @$_REQUEST["cid"];
$config["task"]["Studenti"]["title"] = "Studenti della classe " . @$_REQUEST["cna"];


$DBEdit = new DBEdit( $config );
if (! $DBEdit->errore)
{
   echo $DBEdit->execute();
}

registro_virtuale_page_footer();

?>
