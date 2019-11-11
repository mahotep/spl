<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Podgląd potwierdzonego SPLa</title>
    <?php header('Content-Type: text/html; charset=utf-8');$Kategoria="Produkcja"; ?>
</head>
<body>
<a href="spl.php"><<< powrót bazy SPL</a>

<?php

echo "<h3> To jest podgląd potwierdzonego szkolenia</h3>";
 $zm = $_GET['a'];
 $sesa=$_GET['sesa'];
require "connection.php";
connection();
$mylink;
if($result = mysqli_query($link,"select DISTINCT * from spl_base WHERE id='$zm'  ")){
  while($row = mysqli_fetch_assoc($result)) {
    echo "id szkolenia: ".$row['id'];
    echo "<br>";
    echo "tytuł szkolenia: ".$row['title_spl'];
    echo "<br>";
    echo "link: ".$row['link_to_confirmation'];
    echo "<br>";
    $mylink=$row['link_to_confirmation'];
    echo "<br>";

  }

  $mylink2 ="ftp://elunch:Klucze2019!@www.mkwk019.cba.pl/spl.cba.pl/spl/Signed/".$mylink;
  header("Location:" .$mylink2);
}
?>
</body>
</html>