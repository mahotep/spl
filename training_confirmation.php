<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Potwierdzenie szkolenia</title>
    <?php header('Content-Type: text/html; charset=utf-8'); ?>
</head>
<body>
  <div id="mypdf">  
    <!-- <div> -->
      <?php
          echo "<h2> Potwierdzenie szkolenia</h2>";
          $zm = $_GET['a'];
          require "connection.php";
          connection();
          if($result = mysqli_query($link,"select DISTINCT * from spl_all_spls WHERE id='$zm'  ")){
            while($row = mysqli_fetch_assoc($result)) {
                $val4 = $row['title'];
                
            }
          }
    
      ?>
          <!-- <iframe src="./spl/produkcja/P001_Karta animacji.pdf" width="1200" height="700"></iframe> -->
        <iframe src="./spl/produkcja/<?php echo $val4; ?>" width="1200" height="700"></iframe>
    <!-- </div> -->

    <?php
      echo '<br>', "numer szkolenia które się odbyło: ";
      echo '<input type="text"  name="txtTraining" readonly="readonly" value="'. $_GET['a'] .'">';
      // echo $_GET['a'];
      echo '<br>';
      // echo " nazwa szkolenia: " .$val4;
      echo '<form action="confirm_to_DB.php" method="get">
      Numer SESA trenera: <input type="text"  name="txtTainer"  value=""> <br>
      Nazwa szkolenia: <input type="text"  readonly="readonly" name="txtTitle"  value="'.$val4.'"> <br>
      Potwierdzam odbycie szkolenia : <button type="submit" name="a" value="'. $_GET['a'] .'">TAK </button><br><br>
      Rezygnuje z potwierdzenia     : <button type="submit" name ="a" value="">NIE</button><br>
      </form> ';
    ?>
    <h2> Podpis elektroniczny</h2>
    <!-- <div id="target"> -->
      <iframe src="./touch3.html" width="600px" height="400px"></iframe>
    <!-- </div> -->
    <br>
  </div>
</body>
</html>