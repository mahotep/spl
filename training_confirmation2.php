<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Potwierdzenie szkolenia</title>
    <?php header('Content-Type: text/html; charset=utf-8'); ?>
    <script
      src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"
      type="text/javascript"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
      integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="./html2canvas.js"></script>
    <script type="text/javascript" src="./JsCode2.js"></script>
    <script>
    window.takeScreenShot = function() {
    html2canvas(document.getElementById("mypdf"), {
        onrendered: function (canvas) {
          img = canvas.toDataURL("image/png");
                var pdf = new jsPDF("p", "pt", "letter");
                pdf.addImage(img, "JPEG", -5, 0);
                pdf.save("test.pdf"); 
            document.body.appendChild(canvas);
        },
        width:1220,
        height:1920
    });
}

    </script>
</head>
<body onload="InitThis();">
  <div id="mypdf">  
  <div id="nowy"> </div> 
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
        <div>
          <iframe src="./spl/produkcja/<?php echo $val4; ?>" width="1200" height="700"></iframe>
        </div>  

        <div><br>	
        <object data="spl/produkcja/<?php echo $val4; ?>" width="100%" height="300"><br>
        <a href="spl/produkcja/<?php echo $val4; ?>">Pobierz plik</a>
</object>
        </div>
    <!-- </div>-->
    <!-- <a href="./spl/produkcja/<?php echo $val4; ?>">...</a> -->
    <!-- <embed style="display: block;" width="1200" height="700" src="./spl/produkcja/<?php echo $val4; ?>" />  -->

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
    <!-- <iframe src="./touch3.html" width="600px" height="400px"></iframe> -->
    <!-- </div> -->
    <div id="mypdf">
      <canvas
        id="myCanvas"
        width="540"
        height="260"
        style="border:2px solid black"
      ></canvas>
      
      <br />
      <button onclick="javascript:myclearArea1();return false;">
        Zapisz do PDF
      </button>
      <button onclick="takeScreenShot()">to image</button>
      <button onclick="setTimeout(myFunction, 3000)">Try it</button>
      <br />
      <button onclick="javascript:clearArea();return false;">Clear Area</button>
      Line width :
      <select id="selWidth">
        <option value="1">1</option>
        <option value="3" selected="selected">3</option>
        <option value="5">5</option>
        <option value="7">7</option>
        <option value="9" >9</option>
        <option value="11">11</option>
      </select>
      Color :
      <select id="selColor">
        <option value="black">black</option>
        <option value="blue" selected="selected">blue</option>
        <option value="red">red</option>
        <option value="green">green</option>
        <option value="yellow">yellow</option>
        <option value="gray">gray</option>
      </select>
    </div>
    <br>
  </div>
</body>
</html>