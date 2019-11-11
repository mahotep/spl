
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<title>Potwierdzanie grupowe</title>
</head>
<body>
<?php

session_start();
 $sesa=$_SESSION['sesa'];
 $_SESSION['name'];
 $_SESSION['surname'];

 $today = date("Y-m-d"); 

 echo "Dzisaiaj jest : ", $today, "<br>";

  echo '<a href="index.html"><<< powrót do strony głównej</a>',"<br>";

  echo '<br>', "numer szkolenia które się odbyło: ";
  echo '<input type="text"  name="txtTraining"  value="">';
  
  echo '<br>';
//   echo '<form action="group_confirmation.php" method="get">
//   Potwierdzam odbycie szkolenia : <button type="submit" name="a" value="'. $_GET['a'] .'">TAK </button><br><br>
//   Rezygnuje z potwierdzenia     : <button type="submit" name ="a" value="">NIE</button><br>
  
  
// </form> ';
 
  require "connection.php";
  connection();
  // mysqli_query($link,"INSERT INTO spl_base (id_sesa,no_spl,title_spl,spl_trainer_sesa,spl_training_date)
  // VALUES ('$sesa', '$a', 'title', 222, '$today')");
  
  // Print auto-generated id
 

  mysqli_close($link);
  //header( 'Location: spl.php' ) ;

?>
</body>
</html>
