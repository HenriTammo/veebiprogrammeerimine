<?php

   $name = "Henri";
   $surname = "Tammo";
   $dirToRead = "../../pics/";
   //$allFiles = scandir($dirToRead);
   $allFiles = array_slice(scandir($dirToRead), 2) ;
   var_dump($allFiles);
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

  <?php
	for ($i = (0); $i < count($allFiles); $i ++) {
	echo '<img src="' .$dirToRead .$allFiles[array_rand($allFiles)] .'" alt="pilt"><br>';
	//echo '<img src="' .$dirToRead .$allFiles[$i] .'" alt="pilt"><br>';
	}
	?>
  
  
</body>
</html>
