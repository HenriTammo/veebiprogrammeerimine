<?php
  require("functions.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>Minu Profiil</title>
  </head>
  <body>
    <h1><b> Minu profiil </b></br></h1>
	<p>Sisesta enda kirjeldus</p>
	<textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?>></textarea></br>
	<label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	<label>Minu valitud tekstivärv: </label><input name="textcolor" type="color" value="<?php echo $mytextcolor; ?>"><br>
	<form>
    <input type="submit" value="Kinnita" name="submitValidation">
    </form>
</html>