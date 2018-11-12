<?php
  require("functions.php");
  //kui pole sisse loginud
  
  
  //kui pole sisselogitud
  if (!isset($_SESSION["userId"])) {
	  header("Location: leht3.php");
	  exit();
  }
  
  
  //väljalogimine
  if(isset($_GET["logout"])) {
	  session_destroy();
	  header("Location: leht3.php");
	  exit();
  }
  
  if(isset($_GET["id"])) {
	  $msg = readmsgforvalidation($_GET["Id"]);
  }
  
  $messagesbyusers = readallvalidatedmessagesbyuser ();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Valideeritud anonüümsed sõnumid</title>
</head>
<body>
  <h1>Valideeritud sõnumid valideerijate kaupa</h1>
  <p>Siin on minu <a href="http://www.tlu.ee">TLÜ</a> õppetöö raames valminud veebilehed. Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
  <hr>
  <ul>

	<li><a href="validatemsg.php">Tagasi</a> sõnumite lehele!</li>
  </ul>
  <hr>
  
  <?php echo $messagesbyusers ?>

</body>
</html>




