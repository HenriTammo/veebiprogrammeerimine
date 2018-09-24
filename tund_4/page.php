<?php

$name = "Tundmatu";
$surname = "Inimene";
$fullName = $name ." " .$surname;
$birthMonth = date("m");
$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill"
, "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
 
   
   //var_dump ($_POST);
if (isset($_POST["firstName"])) {
	   //$name = $_POST["firstName"];
	   $name = test_input ($_POST["firstName"]);
   }
if (isset($_POST["surName"])) {
	   //$surname = $_POST["surName"];
	   $surname = test_input ($_POST["surName"]);
   }
   
function test_input($data) {
		echo "Koristan!\n";
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
}

function fullName() {
$GLOBALS["fullName"] = $GLOBALS["name"] . " " .$GLOBALS["surname"];
	//echo $fullName;
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
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Eesnimi:</label>
    <input name="firstName" type="text" value="">
    <label>Perekonnanimi:</label>
    <input name="surName" type="text" value="">
	<label>Sünnikuupäev</label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	<label>Sünniaasta</label>
	<input name="birthYear" type="number" min="1914" max="2003" value="1997">
    <br>
    <input name="submitUserData" type="submit" value="Saada andmed">
  </form>
  
  <?php
    if (isset($_POST["submitUserData"])){
		//demoks üks väike funktsioon, tegelikult mõttetu
		$fullName = fullName();
		echo "<br><p>" .$fullName .". Olete elanud järgnevatel aastatel:</p>";
		echo "<ul> \n";
		for ($i = $_POST["birthYear"]; $i <= date("Y"); $i ++) {
			echo "<li> . $i .</li> \n";
		}
		
		echo "</ul> \n";
	}
  ?>
  
</body>
</html>
