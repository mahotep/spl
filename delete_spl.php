<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Usunięcie SPLa</title>
</head>
<body>
<P> Usuwanie SPLa:</P>
<br>
<?php
require "connection.php";
connection();
$a = trim($_GET['a']);
$id = trim($_GET['id']);

if($a == 'del' and !empty($id)) {
    
    /* usuwamy rekord */
    mysqli_query($link,"DELETE FROM spl_all_spls WHERE id='$id'");
    echo "Usunięcie rekordu nr. " .$id ;
    mysqli_close($link);
    header( 'Location: spl_management.php' ) ; 
}
?> 
</body>
</html>