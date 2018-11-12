<?php
require("../../../config.php");
//echo $GLOBALS["serverHost"];
//echo $GLOBALS["serverUsername"];
//echo $GLOBALS["serverPassword"];
$database =  "if18_Henri_Ta_1";

function saveAMsg($msg){
	//echo "Töötab!";
	$notice = ""; //see on teade, mis antakse salvestamise kohta 
	//loome ühenduse andmebaasiserveriga
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//valmistame ette SQL päringu
	$stmt = $mysqli->prepare("INSERT INTO vpamsg3 (message) VALUES(?)");
	echo $mysqli->error;
	$stmt->bind_param("s", $msg);//s - string, i - integer, d - decimal
	if ($stmt->execute()) {
		$notice = 'Sõnum: "' .$msg .'"on salvestatud!';
	} else {
		$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt->error;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
}
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