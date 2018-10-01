<?php
  require("functions.php");

  $notice = null;
  
  if (isset($_POST["submitMessage"])){
	if ($_POST["message"] != "Kirjuta siia oma sõnum ..."
	and !empty($_POST["message"])) {
		$notice = "Sõnum olemas!";
	$notice = saveAMsg($_POST["message"]);
	} else {
		$notice = "Palun kirjutage sõnum!";
	}
  }
 ?>

<!DOCTYPE html>
<html>
<head>
  <!-- charset on tähestik -->
  <meta charset="utf-8">
  <title>Sõnumi lisamine</title>
</head>
<body>
  <!--<body bgcolor="#000000">
  <font color="green"> -->
  <h1>Sõnumi lisamine
  </h1>
  <p>Sellest võibolla saab kunagi korrektne lehekülg isegi</p>
  <p>See leht on valminud <a href="https://www.tlu.ee/" target="_blank"> TLU</a> õppetöö raames. </p>
  <hr>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label>Sõnum (max 256 märki):</label>
	<br>
	<textarea rows="4" cols="64" name="message">Kirjuta siia oma sõnum ...
	</textarea>
	<br>
    <input name="submitMessage" type="submit" value="Salvesta sõnum">
  </form>
  <br>
  <P>
  <?php
   echo $notice;
  ?>
  </p>
</body>
</html>
