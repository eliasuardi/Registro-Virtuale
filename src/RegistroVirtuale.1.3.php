<?php

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



