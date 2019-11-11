<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Ftp manafer</title>
    <?php header('Content-Type: text/html; charset=utf-8') ?>
</head>
<body>
 <h3> FTP Manager <h3>
 <br>
 <a href="index.html"><<< powrót do strony głównej</a>
 <button id =open> open </button>
 <?PHP

$mylink2 ="ftp://elunch:Klucze2019!@www.mkwk019.cba.pl/spl.cba.pl/spl/Signed/";
  header("Location:" .$mylink2);
?>
</body>
</html>