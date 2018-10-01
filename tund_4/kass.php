<?php

$name = "Tundmatu";
$catColor = "Inimene";
$fullName = $name ." " .$catColor;
$birthMonth = date("m");
$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill"
, "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
 
   
   //var_dump ($_POST);
if (isset($_POST["catName"])) {
	   //$name = $_POST["catName"];
	   $name = test_input ($_POST["catName"]);
   }
if (isset($_POST["catColor"])) {
	   //$catColor = $_POST["catColor"];
	   $catColor = test_input ($_POST["catColor"]);
   }
   
function test_input($data) {
		echo "Koristan!\n";
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
}

function fullName() {
$GLOBALS["fullName"] = $GLOBALS["name"] . " " .$GLOBALS["catColor"];
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
	  echo $catColor;
	?>
  , veebiproge</title>
</head>
<body>
  <!--<body bgcolor="#000000">
  <font color="green"> -->
  <h1>Kasside nimekiri
  </h1>
  <hr>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Kassi nimi:</label>
    <input name="catName" type="text" value="">
    <label>Kassi värv:</label>
    <input name="catColor" type="text" value="">
	<label>Kassi saba pikkus(cm)</label>
	<input name="tailLength" type="number" min="0" max="40" value="20">
    <br>	
    <input name="submitUserData" type="submit" value="Saada andmed">
  </form>
  
  <?php
    if (isset($_POST["submitUserData"])){
		//demoks üks väike funktsioon, tegelikult mõttetu
		$fullName = fullName();
		echo "<br><p>" .$fullName .". Olete elanud järgnevatel aastatel:</p>";
		echo "<ul> \n";
		for ($i = $_POST["tailLength"]; $i <= date("Y"); $i ++) {
			echo "<li> . $i .</li> \n";
		}
		
		echo "</ul> \n";
	}
  ?>
  
</body>
</html>
