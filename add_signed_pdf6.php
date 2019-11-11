<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="./pdf/pdf.js"></script>
<script src="./pdf/pdf.worker.js"></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
      integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="./html2canvas.js"></script>
<script type="text/javascript" src="./JsCode7.js"></script>
</head>


<body onload="InitThis();">
<?php
    echo $_GET['a'];
    echo "<br>";
    // echo "<br>";
    // echo $_GET['sesa'];
    // echo "<br>";
    $title=$_GET['txtTitle'];
    $trainer=$_GET['txtTainer'];
    $id=$_GET['txtId'];
    echo 'Nazwa szkolenia: '. $title;
    echo "<br>";
    echo 'Nazwisko trenera: '. $trainer;
    echo "<br>";
    echo "Id szkolenia: " . $id;
    echo "<br>";
    session_start();
    $_SESSION['title']=$title;
    $_SESSION['trainer']=$trainer;
    $_SESSION['id']=$id;
    if ($_GET['a'] =='Nie'){
        header( 'Location: index.html' ) ;
    }
    echo "<form action='plik.php' method='POST' ENCTYPE='multipart/form-data'>";
    echo "<input type='file' name='plik'>".'<br/>';
    echo "<input type='submit' value='Wyślij plik'>";
    echo "</form>";
?>
</body>
</html>