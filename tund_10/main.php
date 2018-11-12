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
 
  $pageTitle = "Pealeht";
 
  require("header.php");
  ?>


	<p>See leht on valminud <a href="http://www.tlu.ee" target="_blank">TLÜ</a> õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>
	<hr>
	<p>Olete sisse loginud nimega: <?php echo $_SESSION["userFirstName"] ." " .$_SESSION["userLastName"]; ?>.<b><a href="?logout=1">Logi välja</a></b></p> 
	<ul>
	  <li>Muuda <a href="userprofile.php"> profiili</a></li>
	  <li>Valideeri anonüümseid  <a href="validatemsg.php"> sõnumeid</a></li>
	  <li><a href="users.php"> Süsteemi kasutajad</a></li>
	  <li><a href="validatemessages.php"> Valideeritud sõnumid kasutajate kaupa</a></li>
	  <li><a href="picuploads.php"> Fotode üleslaadimine</a></li>
	</ul>
	
  </body>
</html>