<?php
  //echo "Siin on minu esimene PHP!";
   $name = "Henri";
   $surname = "Tammo";
   $todayDate = date("d.m.Y"); 
   $hourNow = date("H");
   //echo $hourNow; 
   $partOfDay = "";
   if ($hourNow < 8) {
	   $partOfDay = "Varajane hommik";
   }
   if ($hourNow >= 8 and $hourNow < 16) {
	   $partOfDay = "Koolipäev";
   }
   if ($hourNow >= 16) {
	   $partOfDay = "Vaba aeg";
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
  <p>See leht on valminud <a href="https://www.tlu.ee/" target="_blank"> TLU</a> õppetöö raames.
  <!-- <a href=""> </a> on lehekülje lingi lisamine. a on ankur. -->
  <h2>Kodutöö</h2>
  <p>Olin kunagi bioloog, aga nüüd õpin informaatikat.</p>
  <?php
   echo "<p> Tänane kuupäev on: " .$todayDate ."</p> \n" ;
   echo "<p> Lehe avamise hetkel oli kell " . date("H:i:s") .", käes on " .$partOfDay .".</p> \n";
  ?>
  <!--<img src="http://greeny.cs.tlu.ee/~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_1.jpg" alt="TLÜ Terra õppehoone">-->
  <!--../~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_1.jpg" sobib ka pildi panekuks-->
  <img src="https://upload.wikimedia.org/wikipedia/et/3/34/Vironia_vapp.png" height=800 width=640 alt="TLÜ Terra õppehoone">
  <!-- kui avada ../ järgi siis on vaja oma greeny lehekülg võtta mitte scp fail(kui ei funka siis ../../) -->
  <p> Link minu kaasüliõpilase lehele <a href="../../~kristre/"  target="_blank"> Kristjan Treimann</a>
</body>
</html>