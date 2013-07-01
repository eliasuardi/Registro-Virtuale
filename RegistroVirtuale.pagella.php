<?php

require_once 'RegistroVirtuale.1.3.php';

registro_virtuale_page_header();

echo '<h2>PAGELLA</h2>';

//$config["debug"] = 1;
$config["hostname"] = $server_connection["localhost"];
$config["user_name"] = $server_connection["usr_name"];
$config["user_pswd"] = $server_connection["pswd"];
$config["user_db"] = $server_connection["db_db"];
$config["row_count"] = $server_connection["row_count"];
$config["table_name"]   = 'VALUTAZIONE';
$config["table_sql_select"] = "
SELECT CONCAT( PP.NOME , ' ' , PP.COGNOME) AS STUDENTE
, C.CLASSE
, MATERIA
, ROUND(AVG(VOTO), 1) AS MEDIA
, COUNT(VOTO) AS VOTI
FROM VALUTAZIONE V, PERSONA PP, CLASSE C
WHERE V.STUDENTE_ID = PP.ID
AND V.CLASSE_ID = C.ID
GROUP BY CONCAT( PP.NOME , ' ' , PP.COGNOME)
, C.CLASSE
, MATERIA
";
$config["column"]["STUDENTE_ID"]["name"] = "STUDENTE";
$config["column"]["STUDENTE_ID"]["filter"] = "CONCAT( PP.NOME , ' ' , PP.COGNOME)";
$config["column"]["CLASSE"]["name"] = "CLASSE";
$config["column"]["CLASSE"]["filter"] = "CLASSE";
$config["task"]["Pagella"]["action"] = "S";
$config["task"]["Pagella"]["title"] = "Pagella di " . @$_REQUEST["studente"];
$config["task"]["Pagella"]["where"] = "V.STUDENTE_ID = " . @$_REQUEST["sid"];

$config["task_link_toolbar"]["Primo Trimestre"]["action"] = "S";
$config["task_link_toolbar"]["Primo Trimestre"]["title"] = "Media dei voti del primo trimestre";
$config["task_link_toolbar"]["Primo Trimestre"]["where"] =
"V.DATA >= CONCAT('09-01-',Year(CURDATE())) AND V.DATA <= CONCAT('12-31-',Year(CURDATE()))";

$DBEdit = new DBEdit( $config );
if (! $DBEdit->errore)
{
   echo $DBEdit->execute();
}

registro_virtuale_page_footer();


?>
