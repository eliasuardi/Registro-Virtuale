<?php

require_once 'RegistroVirtuale.1.3.php';

registro_virtuale_page_header();

echo '<h2>CLASSE</h2>';

//$config["debug"]        = 1;
$config["hostname"] = $server_connection["localhost"];
$config["user_name"] = $server_connection["usr_name"];
$config["user_pswd"] = $server_connection["pswd"];
$config["user_db"] = $server_connection["db_db"];
$config["row_count"] = $server_connection["row_count"];
$config["table_name"]   = 'CLASSE';
$config["table_pk"]     = 'ID';
$config["table_pk_auto"] = 'yes';
$config["table_sql_select"] = "
SELECT ID
, ISTITUTO
, ANNO
, CLASSE
, ID CID
FROM CLASSE
";
$config["column"]["ID"]["name"] = "ID";
$config["column"]["ISTITUTO"]["sql_enum"] = "SELECT VALORE FROM ENUM WHERE NOME = 'ISTITUTO' ORDER BY VALORE";
$config["column"]["ANNO"]["sql_enum"] = "SELECT VALORE FROM ENUM WHERE NOME = 'ANNO SCOLASTICO' ORDER BY VALORE";
$config["column"]["CID"]["name"] = "CID";
$config["column"]["CID"]["hidden"] = "y";
$config["row_count"] = registro_virtuale_numero_righe();
$config["action"]       = 'IUD'; // insert, view, update, delete

$config["task_link"][0]["name"] = "Valutazione di classe";
$config["task_link"][0]["url"] = "RegistroVirtuale.valutazione.php";
$config["task_link"][0]["param"][0]["name"] = "cid";
$config["task_link"][0]["param"][0]["col"] = "CID";
$config["task_link"][0]["param"][1]["name"] = "cname";
$config["task_link"][0]["param"][1]["col"] = "CLASSE";

$DBEdit = new DBEdit( $config );
if (! $DBEdit->errore)
{
   echo $DBEdit->execute();
}

registro_virtuale_page_footer();

?>
