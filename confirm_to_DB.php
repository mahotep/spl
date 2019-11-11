
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<title>Dodanie zreralizowanego szkolenia do Bazy</title>
</head>
<body>
<?php

session_start();
 $sesa=$_SESSION['sesa'];
 $_SESSION['name'];
 $_SESSION['surname'];

 $today = date("Y-m-d");  

echo $a=$_GET["a"]."<br>";
echo "trener: ". $spl_trainer = $_GET["txtTrainer"]."<br>";
echo "tytuł: ". $title_spl = $_GET["txtTitle"];
echo "<br>";
echo "plik: ". $filename = $_GET["filename"];
echo "<br>";
// if (is_numeric($a)) { echo "Yes"; } else { echo "No"; }
if ($a==0){
  echo $today;
  echo " zrezygnowałeś z dodania szkolenia",'<br>';
  echo '<a href="index.html"><<< powrót do strony głównej</a>';
}



if ($a>0){
 
  require "connection.php";
  connection();
  mysqli_query($link,"INSERT INTO spl_base (id_sesa,no_spl,title_spl,spl_trainer_sesa,spl_training_date,link_to_confirmation)
  VALUES ('$sesa', '$a', '$title_spl', '$spl_trainer', '$today','$filename')");
  
  // Print auto-generated id
  echo "Nowy rekord ma id: " . mysqli_insert_id($link);
  echo '<br>';
  echo "Dodano: ",$a;

  mysqli_close($link);
  header( 'Location: spl.php' ) ;
}
?>
</body>
</html>
