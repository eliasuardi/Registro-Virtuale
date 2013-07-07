<?php
    /* eventuale redirect se accesso già effettuato */
    session_start();
    if(isset($_SESSION['user'])){
        header("Location:RegistroVirtuale.classe.php");
    }
    /* controllo se c'è stato un errore nell'accesso (cioè se si accede a questa pagina per un redirect da php/valida.php */
    if(isset($_GET['errore'])){
        $display = "visible";
    }else{
        $display = "hidden";
    }
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registro Virtuale</title>
		<link rel="stylesheet" href="css/stile.css" type="text/css">
		<script type="text/javascript">
function controllo(){
  if (document.frmLogin.user.value.length==0){
      alert("Inserisci l'identificativo utente");
      document.frmLogin.user.focus();
      return false;
  }else{
	  if (document.frmLogin.pw.value.length==0){
	      alert("Inserisci la password");
	      document.frmLogin.pw.focus();
	      return false;
	  }
  }
  return true;
}
		</script>
    </head>
    <body>
        <h1>Registro Virtuale</h1>
        <div id="login">
            <div id='form_login'>
                <form action="controllo_login.php" name='frmLogin' method='post' onSubmit='return controllo();'>
                    Utente<input type="text" name="user" onblur="document.getElementById('f').style.visibility='hidden';" onclick="document.getElementById('f').style.visibility='hidden';"/>
                    Password<input type="password" name="pw" />
					<hr>
                    <input type="submit" value="Entra" class="invio" />
					<input type="button" value="Esci" class="invio" onclick="document.frmLogin.action='../index.php';frmLogin.submit();"/>
                </form>
             </div>
       </div>
        <footer id='f' style='visibility:<?php echo $display;?>'><div>Dati non corretti. Accesso non consentito.</div></footer>
    </body>
</html>
