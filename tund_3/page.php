<?php

   $name = "Tundmatu";
   $surname = "Inimene";
   
   //var_dump ($_POST);
   if (isset($_POST["firstName"])) {
	   $name = $_POST["firstName"];
   }
   if (isset($_POST["surName"])) {
	   $surname = $_POST["surName"];
   }
 ?>
   
<!DOCTYPE html>
<html>
<head>
  <!-- charset on tähestik -->
  <meta charset="utf-8">
  <title>
    <?php
	  echo $name;
	  echo " ";
	  echo $surname;
	?>
  , veebiproge</title>
</head>
<body>
  <!--<body bgcolor="#000000">
  <font color="green"> -->
  <h1>
    <?php 
	echo $name ." " . $surname;
	?>
	, IFI2018
  </h1>
  <p>Sellest võibolla saab kunagi korrektne lehekülg isegi</p>
  <p>See leht on valminud <a href="https://www.tlu.ee/" target="_blank"> TLU</a> õppetöö raames. </p>
  <hr>
  
  <form method="POST">
    <label>Eesnimi:</label>
    <input name="firstName" type="text" value="">
    <label>Perekonnanimi:</label>
    <input name="surName" type="text" value="">
	<label>Sünniaasta</label>
	<input name="birthYear" type="number" min="1914" max="2003" value="1997">
    <br>
    <input name="submitUserData" type="submit" value="Saada andmed">
  </form>
  
  <?php
    if (isset($_POST["submitUserData"])){
		echo "<br><p>Olete elanud järgnevatel aastatel:</p>";
		echo "<ul> \n";
		for ($i = $_POST["birthYear"]; $i <= date("Y"); $i ++) {
			echo "<li> . $i .</li> \n";
		}
		
		echo "</ul> \n";
	}
  ?>
  
</body>
</html>
