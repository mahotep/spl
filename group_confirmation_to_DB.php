<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet" type="text/css" /> 
    <link href="style.css" rel="stylesheet" type="text/css" />
<title>Dodanie grupowego zatwierdzenia  szkolenia do Bazy</title>
</head>
<body>
    <?php
      session_start();
      $sesa=$_SESSION['sesa'];
      $_SESSION['name'];
      $_SESSION['surname'];
      $kategoria=$_SESSION['type_select'];
      require "connection.php";
      connection();
    ?>

<div class="eyebrow">
        <img src="./fonts/C25-SE-Earth Europe Africa-black.png" alt="" height ="25px">
        <span> Polska</span>
        <img src="./fonts/user.png" alt="" height ="25px">
        <?php
            echo'<p class="p_name">';
            echo " Witaj ";
            echo $_SESSION['name'];
            echo ' ';
            echo $_SESSION['surname'];
            echo '  ';
            echo  '</p>';
        ?>
    </div>   

    <header class="header">
        <img src="./fonts/schneider_LIO_White_RGB.png" alt="logo" height="64px">
        <span class="title"> Panel trenera -potwierdzenine grupowe szkolenia</span>
        <a class="a_help"  href="./pomoc.html">Pomoc</a>
    </header>

    <div id="hrline"></div>
    <br>
    <div class="panel_admin">
    <?php
    $today = date("Y-m-d");  
    $txtTraining=$_GET['txtTraining'];
    // if (is_numeric($a)) { echo "Yes"; } else { echo "No"; }
    if (empty($txtTraining)){
      echo $today;
      echo " brak numeru szkolenia",'<br>';
      echo '<a href="index.html"><<< powrót do strony głównej</a>';
    }

    if (!empty($txtTraining)){
          if($result = mysqli_query($link,"select DISTINCT * from spl_all_spls WHERE id='$txtTraining'  ")){
            while($row = mysqli_fetch_assoc($result)) {
              $_SESSION['title'] = $row['title'];
            }
          }

      $x=1;

      for ($x = 1; $x <= 10; $x++) {
      // echo "The number is: $x <br>";
        $zm="";
        $zm="sesa".$x;
        $table_row =$_GET[$zm];

        if (!empty($table_row)){
          echo "Potwierdzenie danych: ", '<br>';;
          echo "sesa: ";
          echo $table_row, '<br>';
          echo "nr szkolenia: ";
          echo $txtTraining , '<br>';
          echo "nr trenera: ";
          echo $sesa_trenera=$_GET['sesa_trenera'], '<br>';
          echo "data: ";
          echo $today ,'<br>';
          echo "tytuł szkolenia: ";
          echo $val4=$_SESSION['title'] ,'<br>';
          mysqli_query($link,"INSERT INTO spl_base (id_sesa,no_spl,title_spl,spl_trainer_sesa,spl_training_date)
          VALUES ('$table_row', '$txtTraining', '$val4', '$sesa_trenera', '$today')");
          echo "Nowy rekord ma id: " . mysqli_insert_id($link);
          echo "<br>";
        }
    }
      mysqli_free_result($result);
      mysqli_close($link);
    
    }
    ?>
    <br>
    <a href="index.html"><<< powrót do strony głównej</a>

</div>
    <footer>
        <span>Schneider Electric Industries Polska</span>
    </footer>
</body>
</html>
