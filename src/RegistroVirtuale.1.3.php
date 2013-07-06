<?php

/*

CREATE TABLE PERSONA(
ID          int             auto_increment primary key,
NOME        varchar(128)    not null,
COGNOME     varchar(128)    not null,
INDIRIZZO   varchar(128),
CAP         varchar(128),
CITTA       varchar(128),
TELEFONO    varchar(128),
NASCITA     date,
RUOLO       varchar(128)
);

CREATE TABLE `CLASSE` (
`ID` int NOT NULL AUTO_INCREMENT,
`ANNO` varchar(128) NOT NULL,
`ISTITUTO` varchar(128) NOT NULL,
`NOME` varchar(128) NOT NULL,
PRIMARY KEY (`ID`)
);

CREATE TABLE `VALUTAZIONE` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DATA` date NOT NULL,
  `MATERIA` varchar(128) NOT NULL,
  `TIPO` varchar(128) NOT NULL,
  `VOTO` double,
  `NOTA` varchar(128) DEFAULT NULL,
  `FIRMA` varchar(128) DEFAULT NULL,
  `PROF_ID` int NOT NULL,
  `STUDENTE_ID` int NOT NULL,
  `CLASSE_ID` int NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE CLASSE_STUDENTE(
  `ID` int NOT NULL AUTO_INCREMENT,
  `CLASSE_ID` int NOT NULL,
  `STUDENTE_ID` int NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE CLASSE_PROFESSORE(
  `ID` int NOT NULL AUTO_INCREMENT,
  `CLASSE_ID` int NOT NULL,
  `PROF_ID` int NOT NULL,
  `MATERIA` varchar(128),
  `TESTO` varchar(128),
  PRIMARY KEY (`ID`)
);

CREATE TABLE `COMUNICAZIONE` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DATA` date NOT NULL,
  `TIPO` varchar(128) NOT NULL,
  `NOTA` varchar(1024) DEFAULT NULL,
  `ASSENZA_GIORNI` int,
  `ASSENZA_ORE` int,
  `STUDENTE_ID` int NOT NULL,
  `PROF_ID` int,
  `GENITORE_ID` int,
  PRIMARY KEY (`ID`)
);

CREATE TABLE `ENUM` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(20) NOT NULL,
  `SEQUENZA` int(10) DEFAULT NULL,
  `VALORE` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
);

ALTER TABLE VALUTAZIONE
ADD FOREIGN KEY (PROF_ID) REFERENCES PERSONA (ID);

ALTER TABLE VALUTAZIONE
ADD FOREIGN KEY (STUDENTE_ID) REFERENCES PERSONA (ID);

ALTER TABLE VALUTAZIONE
ADD FOREIGN KEY (CLASSE_ID) REFERENCES CLASSE (ID);

ALTER TABLE CLASSE_STUDENTE
ADD FOREIGN KEY (CLASSE_ID) REFERENCES CLASSE (ID);

ALTER TABLE CLASSE_STUDENTE
ADD FOREIGN KEY (STUDENTE_ID) REFERENCES PERSONA (ID);

ALTER TABLE CLASSE_PROFESSORE
ADD FOREIGN KEY (CLASSE_ID) REFERENCES CLASSE (ID);

ALTER TABLE CLASSE_PROFESSORE
ADD FOREIGN KEY (PROF_ID) REFERENCES PERSONA (ID);

ALTER TABLE COMUNICAZIONE
ADD FOREIGN KEY (PROF_ID) REFERENCES PERSONA (ID);

ALTER TABLE COMUNICAZIONE
ADD FOREIGN KEY (STUDENTE_ID) REFERENCES PERSONA (ID);

ALTER TABLE COMUNICAZIONE
ADD FOREIGN KEY (GENITORE_ID) REFERENCES PERSONA (ID);

 * COMANDI MYSQL

 * mysql --user=root --password=root
 * create database registro
 * source registro.sql

 *  */



require_once 'DBEdit/DBEdit.2.7.php';



function registro_virtuale_page_header()
{
    $style = "font-size:14px; font-weight:bold; padding:10px;";

    echo '<html>';
    echo '<head>';
    echo '    <link rel="stylesheet" type="text/css" href="DBEdit/DBEdit.css">';
    echo '</head>';
    echo '<body>';
    echo '<h1>REGISTRO VIRTUALE</h1>';
    echo '<a href="RegistroVirtuale.valutazione.php"><button type="submit" style="'.$style.'">VALUTAZIONE</button></a> &nbsp;';
    echo '<a href="RegistroVirtuale.pagella.php"><button type="submit" style="'.$style.'">PAGELLA</button></a> &nbsp;';
    echo '<a href="RegistroVirtuale.comunicazione.php"><button type="submit" style="'.$style.'">COMUNICAZIONE</button></a> &nbsp;';

    $style .= " color:#BBBBBB; border-style:dotted; border-color:#CCCCCC; background-color:#FFFFFF;";

    echo '<a href="RegistroVirtuale.persona.php"><button type="submit" style="'.$style.'">PERSONA</button></a> &nbsp;';
    echo '<a href="RegistroVirtuale.classe.php"><button type="submit" style="'.$style.'">CLASSE</button></a> &nbsp;';
    echo '<a href="RegistroVirtuale.classe_studente.php"><button type="submit" style="'.$style.'">CLASSE_STUDENTE</button></a> &nbsp;';
    echo '<a href="RegistroVirtuale.classe_professore.php"><button type="submit" style="'.$style.'">CLASSE_PROFESSORE</button></a> &nbsp;';
    echo '<a href="RegistroVirtuale.enum.php"><button type="submit" style="'.$style.'">ENUM</button></a> &nbsp;';
}



function registro_virtuale_page_footer()
{
    echo '<font style="font-size:smaller;">Powered by DBEdit.2.7.php</font>';
    echo '</body>';
    echo '</html>';
}



function registro_virtuale_numero_righe()
{
    return 7;
}



// global configuration and settings

$server_connection["localhost"] = 'localhost';
$server_connection["usr_name"] = 'root';
$server_connection["pswd"] = '';
$server_connection["db_db"] = 'registro';
$server_connection["row_count"] = 7;

date_default_timezone_set('Europe/Rome');

?>



