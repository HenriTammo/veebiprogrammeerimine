<?php
   
    require ("functions.php");
   
    $giveFeedback = "";
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submitMessage"])){
            if ((empty($_POST["catname"])) || (empty($_POST["catcolor"])) || (empty($_POST["cattaillength"]))){
                $giveFeedback = '<br> Kassi "' . $_POST["catname"] . ':' . $_POST["catcolor"] . ':' . $_POST["cattaillength"] . '" ei sisestatud. (Tühi)';
                } else {
                $notice = addACat($_POST["catname"], $_POST["catcolor"], $_POST["cattaillength"]);
                $giveFeedback = '<br>' . $notice;
               
            }
        }
    }
   
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;  
        }
   
?>
 
<html lang="et">
<head>
 
<title>Kassi lisamine</title>
 
</head>
<body>
<h1>Kassi lisamine</h1>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="text" name="catname" placeholder="cat name">
<input type="text" name="catcolor" placeholder="cat color">
<input type="text" name="cattaillength" placeholder="cat tail length">
<input type="submit" name="submitMessage" value="Salvesta sönum">
<input type="reset">
 
<?php echo $giveFeedback; ?>
 
</body>
</html>