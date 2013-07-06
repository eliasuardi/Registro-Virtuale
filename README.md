#INSTALLAZIONE DEL REGISTRO VIRTUALE

PRE- 
REQUISITI:
<br/>-Connessione a internet
<br/>-Server PHP e MySQL funzionante 
<br/>(e.g. Easyphp 
<br/> link: http://sourceforge.net/projects/quickeasyphp/files/EasyPHP-DevServer/
<br/> 13.1VC9/EasyPHP-DevServer-13.1VC9-setup.exe/download )
<br/>-editor (e.g. NetBeans link: https://netbeans.org/downloads/ )

ISTRUZIONI:

1- Cliccare su "Clone on Desktop"
<br/>2- Se e' la prima volta che usi Github dovete scaricare il programma 
<br/>   sul vostro PC dalla pagina che vi esce
<br/>3- Una volta scaricato ed installato il programma ricliccare "Clone on Desktop"
<br/>4- Spostare la cartella di "Github" (che si trovera' in C:\Documents and Settings\)
<br/>   nella cartella del server php
<br/>   Se si apre il programma di Github e si va nelle "local repositories",
<br/>   si potra' vedere che ritorna un errore perche' non trova la cartella di Github che
<br/>   abbiamo appena spostato.
<br/>   Cliccare quindi sul punto esclamativo che trova in parte alla voce della repository
<br/>   di Registro-Virtuale.
<br/>   Cliccare poi FIND IT e cercare la cartella di Registro-Virtuale che si trova nella 
<br/>   cartella Github che hai appena spostato cliccare poi ok.
<br/>5- Far partire il server PHP
<br/>6- Andare sul sito corrispondente al phpmyadmin del server MySQL e cliccare "Importa"
<br/>7- Selezionare il file che contiene l'SQL necessario per 
<br/>   creare il database e cliccare "Vai"
<br/>8- Andare sul sito del server PHP (di solito localhost o 127.0.0.1)
<br/>9- Cliccare sulla cartella di "Github" poi di "Registro-Virtuale" poi di "src" 
<br/>10-Cliccare su "RegistroVirtuale.classe.php" e dovrebbe funzionare gia' tutto
<br/>   Se ritorna l'errore:
<br/>   Warning: mysql_connect(): Access denied...
<br/>   significa che la password per entrare nel server MySQL e' sbagliato.
<br/>   Per risolvere il problema andare nella cartella di github sul tuo computer.

Se ci sono problemi contattatemi a 

eliasuardi@gmail.com
