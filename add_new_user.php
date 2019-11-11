<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<title>Strona główna logowania</title>
</head>
<body>
<?php
echo "Dodano:";
echo '<br>';
echo $sesa=$_POST["sesa"];
echo '<br>';
echo $name=$_POST["name"];
echo '<br>';
echo $surname=$_POST["surname"];
echo '<br>';
echo $password=$_POST["password"];
echo '<br>';
require "connection.php";
connection();
mysqli_query($link,"INSERT INTO spl_users (sesa,name,surname, password)
VALUES ('$sesa','$name','$surname','$password')");

// Print auto-generated id
echo "Nowy rekord ma id: " . mysqli_insert_id($link);

mysqli_close($link);
header( 'Location: users_interface.php' ) ; // normalne logowanie

?>
</body>
</html>
