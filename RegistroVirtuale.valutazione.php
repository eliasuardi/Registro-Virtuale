<?php

require_once 'RegistroVirtuale.1.3.php';

registro_virtuale_page_header();

echo '<h2>VALUTAZIONE</h2>';

$today = date("d-m-Y");

//$config["debug"] = 1;
$config["hostname"] = $server_connection["localhost"];
$config["user_name"] = $server_connection["usr_name"];
$config["user_pswd"] = $server_connection["pswd"];
$config["user_db"] = $server_connection["db_db"];
$config["row_count"] = $server_connection["row_count"];
$config["table_name"] = 'VALUTAZIONE';
$config["table_pk"] = 'ID';
$config["table_pk_auto"] = 'yes';
$config["table_sql_select"] = "
SELECT V.ID
, CONCAT( P.NOME , ' ' , P.COGNOME) AS PROFESSORE
, MATERIA
, C.CLASSE
, C.ISTITUTO
, DATE_FORMAT(DATA,'%d-%m-%Y') AS DATA
, CONCAT( PP.NOME , ' ' , PP.COGNOME) AS STUDENTE
, VOTO
, TIPO
, NOTA
, FIRMA
, PP.ID SID
, C.ID CID
FROM VALUTAZIONE V, PERSONA P, PERSONA PP, CLASSE C
WHERE V.PROF_ID = P.ID
AND V.STUDENTE_ID = PP.ID
AND V.CLASSE_ID = C.ID
ORDER BY 2, 3, 4, 5, 6
";
$config["action"] = 'IVUD'; // insert, view, update, delete
$config["column"]["ID"]["name"] = "ID";
$config["column"]["PROF_ID"]["name"] = "PROFESSORE";
$config["column"]["PROF_ID"]["sql_fk"] = "SELECT ID, CONCAT( NOME , ' ' , COGNOME) FROM PERSONA P WHERE RUOLO = 'Professore'";
$config["column"]["PROF_ID"]["filter"] = "CONCAT( P.NOME , ' ' , P.COGNOME)";
$config["column"]["MATERIA"]["name"] = "MATERIA";
$config["column"]["MATERIA"]["sql_enum"] = "SELECT VALORE FROM ENUM WHERE NOME = 'MATERIA' ORDER BY 1";
$config["column"]["MATERIA"]["filter"] = "MATERIA";
$config["column"]["CLASSE_ID"]["name"] = "CLASSE";
$config["column"]["CLASSE_ID"]["sql_fk"] = "SELECT ID, CONCAT( ANNO, ' ', ISTITUTO, ' ', CLASSE, ' ') FROM CLASSE ORDER BY 2";
$config["column"]["CLASSE_ID"]["filter"] = "CLASSE";
$config["column"]["ISTITUTO"]["name"] = "ISTITUTO";
$config["column"]["DATA"]["name"] = "DATA";
$config["column"]["DATA"]["value"] = $today;
$config["column"]["DATA"]["format"] = "d-m-Y";
$config["column"]["STUDENTE_ID"]["name"] = "STUDENTE";
$config["column"]["STUDENTE_ID"]["sql_fk"] = "SELECT ID, CONCAT( NOME , ' ' , COGNOME) FROM PERSONA PP WHERE RUOLO = 'Studente'";
$config["column"]["STUDENTE_ID"]["filter"] = "CONCAT( PP.NOME , ' ' , PP.COGNOME)";
$config["column"]["VOTO"]["name"] = "VOTO";
$config["column"]["TIPO"]["name"] = "TIPO";
$config["column"]["TIPO"]["sql_enum"] = "SELECT VALORE FROM ENUM WHERE NOME = 'TIPO PROVA' ORDER BY VALORE";
$config["column"]["NOTA"]["name"] = "NOTA";
$config["column"]["FIRMA"]["name"] = "FIRMA";
$config["column"]["SID"]["name"] = "SID";
$config["column"]["SID"]["hidden"] = "y";
$config["column"]["CID"]["name"] = "CID";
$config["column"]["CID"]["hidden"] = "y";

$config["task_link"][0]["name"] = "Pagella";
$config["task_link"][0]["url"] = "RegistroVirtuale.pagella.php";
$config["task_link"][0]["param"][0]["name"] = "sid";//nome di variabile in REQUEST
$config["task_link"][0]["param"][0]["col"] = "SID";//nome di colonna in SELECT
$config["task_link"][0]["param"][1]["name"] = "studente";//nome di variabile in REQUEST
$config["task_link"][0]["param"][1]["col"] = "STUDENTE";//nome di colonna in SELECT

// STUDENTE deve avere valori compatibili con quelli usati
// dal task in comunicazione (vedi comunicazione)
$config["task_link"][1]["name"] = "Comunicazione";
$config["task_link"][1]["url"] = "RegistroVirtuale.comunicazione.php";
$config["task_link"][1]["param"][0]["name"] = "studente";
$config["task_link"][1]["param"][0]["col"] = "STUDENTE";

$config["task_link"][2]["name"] = "Valutazione di classe";
$config["task_link"][2]["url"] = "RegistroVirtuale.valutazione.php";
$config["task_link"][2]["param"][0]["name"] = "cid";
$config["task_link"][2]["param"][0]["col"] = "CID";
$config["task_link"][2]["param"][1]["name"] = "cname";
$config["task_link"][2]["param"][1]["col"] = "CLASSE";

$config["task"]["Valutazione di classe"]["action"] = "I";
$config["task"]["Valutazione di classe"]["title"] = "Nuova valutazione per tutti gli studenti della classe " . @$_REQUEST["cname"];
$config["task"]["Valutazione di classe"]["filter"]["CLASSE"] = @$_REQUEST["cname"];
$config["task"]["Valutazione di classe"]["many"]["STUDENTE_ID"] = "SELECT STUDENTE_ID FROM CLASSE_STUDENTE WHERE CLASSE_ID = " . @$_REQUEST["cid"];

$DBEdit = new DBEdit( $config );
if (! $DBEdit->errore)
{
   echo $DBEdit->execute();
}

registro_virtuale_page_footer();


?>
