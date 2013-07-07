<?php
include "connessione_db.php";

$user = $_POST['user'];
$pw = $_POST['pw'];

//ricerca dell'utente nel db
// per ora nome e cognome poi cambieremo con userid e pw
// memorizzare in chiaro ? Meglio Md5? Altra crittografia?
$ris = mysql_query("select * from persona where nome='$user' and cognome='$pw'")
		or die("Errore nel controllo del login. ".mysql_error());
//$ris = mysql_query("select * from persona where userid='$user' and password='$pw'")or die("Errore nel controllo del login. ".mysql_error());

if(mysql_num_rows($ris)==1){
    
    //trovato
    session_start();
    $ris = mysql_fetch_array($ris);
    $_SESSION['user'] = $ris['nome'];
    $_SESSION['ruolo'] = $ris['ruolo'];
    header("Location:RegistroVirtuale.classe.php");
    
}else{
    //non trovato
    header("Location:login.php?errore=true");
}
?>
