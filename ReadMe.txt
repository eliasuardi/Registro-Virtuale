INSTALLAZIONE DEL REGISTRO VIRTUALE

PRE-REQUISITI:
 -Connessione a internet
 -Server PHP e MySQL funzionante 
 (e.g. Easyphp 
  link: http://sourceforge.net/projects/quickeasyphp/files/EasyPHP-DevServer/
  13.1VC9/EasyPHP-DevServer-13.1VC9-setup.exe/download )
 -editor (e.g. NetBeans link: https://netbeans.org/downloads/ )
 -scaricare il codice da github: https://github.com/eliasuardi/Registro-Virtuale

ISTRUZIONI:

 1- Scaricare il software da https://github.com/ adatto al vostro s.o.(pulsante azzurro Download) 
    e installarlo (per windows: eseguire il file GitHubSetup.exe appena scaricato)
 2- Accedere al repository (Registro-Virtuale) dal sito GitHub
 3- Cliccare "Clone in Desktop"
 4- Spostare la cartella di "Github" (che si trovera' in C:\Documents and Settings\)
    nella cartella del server php
    Se si apre il programma di Github e si va nelle "local repositories",
    si potra' vedere che ritorna un errore perche' non trova la cartella di Github che
    abbiamo appena spostato.
    Cliccare quindi sul punto esclamativo che trova in parte alla voce della repository
    di Registro-Virtuale.
    Cliccare poi FIND IT e cercare la cartella di Registro-Virtuale che si trova nella 
    cartella Github che hai appena spostato cliccare poi ok.
 5- Avviare il server PHP
 6- Creare il database registro;
 7- Importare le tabelle selezionando prima sql/creatabelle.sql poi caricadati.sql dalla cartella clonata
    Alternativa: scrivere nel command line: 
         mysql --user=root --password=root
         create database registro;
         use registro;
         source creatabelle.sql;
         source caricadati.sql;
 8- Accedere alla root del webserver PHP (di solito localhost o 127.0.0.1)
 9- Cliccare sulla cartella "Github", poi "Registro-Virtuale" ed infine "src" 
 10-Dovrebbe aprirsi la pagina iniziale
    Se ritorna l'errore:
    Warning: mysql_connect(): Access denied...
    significa che la password per entrare nel server MySQL e' sbagliata e va modificata.
    Per risolvere il problema andare nella cartella di github sul tuo computer.
	Aprire con un editor di testo il file RegistroVirtuale.1.3.php nella cartella src
	Modificare la riga 165
	$server_connection["pswd"] = 'root';
	in
	$server_connection["pswd"] = ''; // per toglierla (oppure inserire tra gli apici la password differente)
    Riprovare.
	
Se ci sono problemi contattatemi a 

eliasuardi@gmail.com
