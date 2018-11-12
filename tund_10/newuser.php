          <?php
require ("functions.php");

$name = "";
$surname = "";
$email = "";
$gender = "";
$fullName = $name ." " .$surname;
$birthMonth = null;
$birthYear = null;
$birthDay = null;
$birthDate = null;
$password = "";
$confirmPassword = "";
$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill"
, "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];

//muutujad võimalike veateadetega
$nameError = "";
$surnameError = "";
$birthMonthError = "";
$birthYearError = "";
$birthDayError = "";
$emailError = "";
$genderError = "";
$passwordError = "";
$confirmPasswordError = "";
 
 //kui on uue kasutaja loomise nuppu vajutatud
if (isset($_POST["submitUserData"])){
   
   //var_dump ($_POST);
if (isset($_POST["firstName"]) and !empty($_POST["firstName"])) {
	   //$name = $_POST["firstName"];
	   $name = test_input ($_POST["firstName"]);
   } else {
	   $nameError = "Palun sisesta eesnimi!";
   }
   	
if (isset($_POST["email"]) and !empty($_POST["email"])) {
	$email = test_input ($_POST["email"]);
	} else {
		$emailError = "Palun sisesta email!";
	}
	
if (isset($_POST["surName"]) and !empty($_POST["surName"])) {
	   //$surname = $_POST["surName"];
	   $surname = test_input ($_POST["surName"]);
   } else {
	   $surnameError = "Palun sisesta perekonnanimi!";
   }
   
if (isset($_POST["gender"])) {
	$gender = intval($_POST["gender"]);
	} else {
		$genderError = "Palun märgi sugu!";
	}

//kontrollime sünniaega
if (!empty($_POST["birthDay"])) {
		$birthDay = test_input($_POST["birthDay"]);
	} else {
		$birthDayError = " * Error: birthDay not selected";
	}
	
	if (!empty($_POST["birthMonth"])) {
		$birthMonth = test_input($_POST["birthMonth"]);
	} else {
		$birthMonthError = " * Error: birthMonth not selected";
	}
	if (!empty($_POST["birthYear"])) {
		$birthYear = test_input($_POST["birthYear"]);
	} else {
		$birthYearError = " * Error: birthYear not selected";
	}
	if (!empty($_POST["password"])) {
		if (strlen($_POST["password"]) > 8){
			$password = ($_POST["password"]);
		} else {
			$passwordError = "Error: password not long enough!";
		}
	} else {
		$passwordError = "Error: password not selected";
	}
			
	if (!empty($_POST["confirmPassword"])) {
		$confirmPassword = ($_POST["confirmPassword"]);
		if ($_POST["password"] != $_POST["confirmPassword"]){
			$confirmPasswordError = "Error: Confirmed password does not match!"; 
		}
	} else {
		$confirmPasswordError = "Error: confirmed password not selected";
	}
//kontrollin küüpäeva õigsust
if(isset($_POST["birthDay"]) and (isset($_POST["birthMonth"])) and (isset($_POST["birthYear"]))) {
	if(checkdate(intval($_POST["birthMonth"]),intval($_POST["birthDay"]), intval($_POST["birthYear"])))
	$birthDate = date_create($_POST["birthMonth"] ."/" .$_POST["birthDay"] ."/" .$_POST["birthYear"]);
	$birthDate = date_format($birthDate, "Y-m-d");
} else { 
	$birthYearError = "Kuupäev on vigane!";
}
//checkdate(päev, kuu, aasta)
//kui kõik korras siis salvestab kasutaja
if(empty($nameError) and empty($surnameError) and empty($birthMonthError) and empty($birthYearError) and empty($birthDayError) and empty($emailError) and empty($genderError) and empty($passwordError)) {
	$notice = signup ($name, $surname, $email, $gender, $birthDate, $_POST["password"]);
	echo $notice;
}
} //kui on nuppu vajutatud - lõppeb
//echo "Kuupäev tuli: " .$birthDate;

function name() {
$GLOBALS["fullName"] = $GLOBALS["name"] . " " .$GLOBALS["surname"];
	//echo $fullName;
}
 ?>
   
<!DOCTYPE html>
<html>
<head>
  <!-- charset on tähestik -->
  <meta charset="utf-8">
  <title>Katselise veebi uue kasutaja loomine</title>
</head>
<body>
  <!--<body bgcolor="#000000">
  <font color="green"> -->
  <h1>Loo endale kasutaja konto</h1>
  <p>Sellest võibolla saab kunagi korrektne lehekülg isegi</p>
  <p>See leht on valminud <a href="https://www.tlu.ee/" target="_blank"> TLU</a> õppetöö raames. </p>
  <hr>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Eesnimi:</label><br>
    <input name="firstName" type="text" value="<?php echo $name; ?>" ><span><?php echo $nameError;
	?></span><br>
	<label>email (kasutajatunnus):</label><br>
    <input name="email" type="email" ><span><?php echo $emailError;
	?></span><br>
    <label>Perekonnanimi:</label><br>
    <input name="surName" type="text" ><span><?php echo $surnameError;
	?></span><br><br>
	
	<input type="radio" name = "gender" value ="2"
	<?php
	  if($gender == "2") {
		  echo " checked";
	  }
	?><Label>Naine</label>
	
	<input type="radio" name = "gender" value ="1"
	<?php
	  if($gender == "1") {
		  echo " checked";
	  }
	?><label>Mees</label><br>
	<span><?php echo $genderError;?></span><br>
	
	<label>Sünnipäev: </label>
	  <?php
	    echo '<select name="birthDay">' ."\n";
		echo '<option value="" selected disabled>päev</option>' ."\n";
		for ($i = 1; $i < 32; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthDay){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	<label>Sünnikuupäev</label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	<label>Sünniaasta: </label>
	  <?php
	    echo '<select name="birthYear">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i =  date("Y") - 15; $i >= date("Y") - 100; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?><br>
	<label>Salasõna:</label><br>
	<input type="password" name="password" placeholder="password"><span><?php echo $passwordError;?></span><br>
	<input type="password" name="confirmPassword" placeholder="confirm password"><span><?php echo $confirmPasswordError;?></span><br>


    <br>
    <input name="submitUserData" type="submit" value="Loo kasutaja">
  </form>
  <hr>
  <p><a href="leht3.php">Tagasi</a> avalehele!</p>

</body>
</html>
