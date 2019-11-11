<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<title>Strona dodawania nowego SPLa</title>
</head>
<body>
<?php
echo "Dodano:";
echo '<br>';
echo $category=$_POST["category"];
echo '<br>';
echo $title=$_POST["title"];
echo '<br>';
echo $desctription=$_POST["desctription"];
echo '<br>';
echo $author=$_POST["author"];
echo '<br>';
echo $creation_date=$_POST["creation_date"];
echo '<br>';
require "connection.php";
connection();
mysqli_query($link,"INSERT INTO spl_all_spls (category,title,desctription,author, creation_date)
VALUES ('$category','$title','$desctription','$author','$creation_date')");

// Print auto-generated id
echo "Nowy rekord ma id: " . mysqli_insert_id($link);

mysqli_close($link);
header( 'Location: spl_management.php' ) ; 

?>
</body>
</html>
