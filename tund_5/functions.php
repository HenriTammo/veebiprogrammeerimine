<?php
require("../../../config.php");
//echo $GLOBALS["serverHost"];
//echo $GLOBALS["serverUsername"];
//echo $GLOBALS["serverPassword"];
$database = "if18_Henri_Ta_1";

function signup ($name, $surname, $email, $gender, $birthDate, $password) {
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?, ?, ?, ?, ?, ?)");
	echo $mysqli->error;
	//krüpteerin parooli, kasutades juhsliku soolamisfraasi(saltingstring)
	$options = [
	"cost" => 12,
	"salt" => substr(sha1(rand()), 0, 22),
	];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	$stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email);
	if($stmt->execute()){
		$notice = "ok";
	} else {
	  $notice = "error" .$stmt->error;	
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }

function saveAMsg($msg){
  //echo "Töötab!";
  $notice = ""; //see on teade, mis antakse salvestamise kohta
  //loome ühenduse andmebaasiserveriga
  $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
  //Valmistame ette SQL päringu
  $stmt = $mysqli->prepare("INSERT INTO vpamsg3 (message) VALUES(?)");
  echo $mysqli->error;
  $stmt->bind_param("s", $msg);//s - string, i - integer, d - decimal
  if ($stmt->execute()){
	$notice = 'Sõnum: "' .$msg .'" on salvestatud!';  
  } else {
	$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt->error;
  }
  $stmt->close();
  $mysqli->close();
  return $notice;
}
  function readallmessages(){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT message FROM vpamsg3");
	echo $mysqli->error;
	$stmt->bind_result($msg);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p>" .$msg ."</p> \n";
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
?>
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
function addACat($catname, $catcolor, $cattaillength) {
    $notice = "";
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]); // connecting to DB
   
    // SQL query
    $myQuery = $mysqli->prepare("INSERT INTO kass (nimi, v2rvus, saba) VALUES (?, ?, ?)"); // insert 3 arg VALUES into TABLE kiisu
    echo $mysqli->error;
    $myQuery->bind_param("ssi", $catname, $catcolor, $cattaillength); // $catname, $catcolor = s(tring) & $cattaillength = i(nteger)
   
    if ($myQuery->execute()){
        $notice = 'Sisestatud: "' . $catname . '" "' . $catcolor . '" "' . $cattaillength . '" andmebaasi.';
    } else {
        $notice = "erur." . $myQuery->error;
    }
   
    $myQuery->close();
    $mysqli->close();
    return $notice;
}
 
function readCats(){
    $notice = ""; // defining empty notice
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]); // connecting to DB
   
    // SQL query
    $myQuery = $mysqli->prepare("SELECT nimi, v2rvus, saba FROM kass");
    echo $mysqli->error;
    $myQuery->bind_result($catname, $catcolor, $cattaillength);
    $myQuery->execute();
   
   
    while ($myQuery->fetch()){
        $notice .= '<li>' . $catname . ' ' . $catcolor . ' ' . $cattaillength . '</li>';
    }
   
    $myQuery->close();
    $mysqli->close();
    return $notice;
}
?>