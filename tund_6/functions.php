<?php
require("../../../config.php");
//echo $GLOBALS["serverHost"];
//echo $GLOBALS["serverUsername"];
//echo $GLOBALS["serverPassword"];
$database = "if18_Henri_Ta_1";

 //alustan sessiooni
 session_start();
 
   function validatemessage () {
	   $notice = "";
	   $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	   $stmt = $mysqli->prepare("UPDATE vpamsg3 SET validator=?, valid=?, validated=now() WHERE id=?");
	   $stmt->bind_result($msg);
	   $stmt->close();
	   $mysqli->close();
	   return $notice;
   }
 
   function readmsgforvalidation($editId){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT message FROM vpamsg3 WHERE id = ?");
	$stmt->bind_param("i", $editId);
	$stmt->bind_result($msg);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = $msg;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
 
 function readallunvalidatedmessages(){
	$notice = "<ul> \n";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, message FROM vpamsg3 WHERE valid IS NULL ORDER BY id DESC");
	echo $mysqli->error;
	$stmt->bind_result($id, $msg);
	$stmt->execute();
	
	while($stmt->fetch()){
		$notice .= "<li>" .$msg .'<br><a href="validatemessage.php?id=' .$id .'">Valideeri</a>' ."</li> \n";
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }

 function signin($email, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, firstname, lastname, password FROM vpusers WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($idFromDb, $firstNameFromDb, $lastNameFromDb, $passwordFromDb);
	if($stmt->execute()){
		//kui päring õnnestus
	  if($stmt->fetch()){
		//kasutaja on olemas
		if(password_verify($password, $passwordFromDb)){
		  //kui salasõna klapib
		  $notice = "Logisite sisse!";
		  //määran sessiooni muutujad
		  $_SESSION["userId"] = $idFromDb;
		  $_SESSION["userFirstName"] = $firstNameFromDb;
		  $_SESSION["userLastName"] = $lastNameFromDb;
		  $_SESSION["useremail"] = $email;
		  //liigume kohe vaid sisselogitutele mõeldud pealehele
		  $stmt->close();
		  $mysqli->close();
		  header("Location: main.php");
		  exit();
		} else {
		  $notice = "Vale salasõna!";
		}
	  } else {
		$notice = "Sellist kasutajat (" .$email .") ei leitud!";  
	  }
	} else {
	  $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
	}
	
	$stmt->close();
	$mysqli->close();
	return $notice;
  }//sisselogimine lõppeb
  
  //kasutaja salvestamine
  function signup($name, $surname, $email, $gender, $birthDate, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//kontrollime, ega kasutajat juba olemas pole
	$stmt = $mysqli->prepare("SELECT id FROM vpusers WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s",$email);
	$stmt->execute();
	if($stmt->fetch()){
		//leiti selline, seega ei saa uut salvestada
		$notice = "Sellise kasutajatunnusega (" .$email .") kasutaja on juba olemas! Uut kasutajat ei salvestatud!";
	} else {
		$stmt->close();
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
    	echo $mysqli->error;
	    $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	    $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	    $stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email, $pwdhash);
	    if($stmt->execute()){
		  $notice = "ok";
	    } else {
	      $notice = "error" .$stmt->error;	
	    }
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