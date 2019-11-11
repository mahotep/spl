<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width">
<link href="normalize.css" rel="stylesheet" type="text/css" /> 
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
    <script type="text/javascript" src="./JsCode6.js"></script>
    <title>Potwierdzenie szkolenia</title>
</head>
<body onload="InitThis();">
<div id="mypdf"> 
    <?php
      session_start();
      $zm = $_GET['a'];
      $sesa=$_SESSION['sesa'];
      $name=$_SESSION['name'];
      $trainer=$_GET['txtTrainer'];
      $id=$zm;
      $_SESSION['title'];
      $_SESSION['trainer']=$trainer;
      $_SESSION['id']=$id;
      require "connection.php";
      connection();
    ?>
  <div class="full_header">
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
        <span class="title">Potwierdzenie szkolenia</span>
        <a class="a_help"  href="./pomoc.html">Pomoc</a>
      </header>

    <div id="hrline"></div>
  </div>
      <?php
        if($result = mysqli_query($link,"select DISTINCT * from spl_all_spls WHERE id='$zm'  ")){
          while($row = mysqli_fetch_assoc($result)) {
            $val4 = $row['title'];
          }
        }
      ?>
    <div class="main_wrapper">
      <div class="wrapper">
        <p id="sesa" hidden ><?php echo $sesa?></p>
        <p>Witaj <strong> <?php echo " ".$name?>, </strong></p><br>
        <span>Dziękujemy za wykonanie szkolenia </span>
        <span id="spl_file_name" ><?php echo  $val4 ; ?></span>
        <p>Proszę o zatwierdzenie wykonania szkolenia naciskając przycisk "Zatwierdzam szkolenie" lub podpisująć się  z wykorzystaniem graficznego podpisu cyfrowego po zaznaczeniu okienka "Graficzny podpis cyfrowy" </p>
        </div> 
      <div class="wrapper">
      <br>
      <div id='signature_digital' >         
        <input type="checkbox" id="signature_digital_ch" name="signature_digital"  value="1" >Graficzny podpis cyfrowy<br>
        <div id='signature_digital_box' hidden >   
          <div class="signature" >
          <br>
            <h3> Graficzny podpis cyfrowy</h3> <br>
            <p>Aby użyć graficzy podpis cyfrowy powinieneś naciskająć lewy klawisz myszki w okienku "Graficzny podpis cyfrowy", przesuwać kursor wykonując podpis lub podpisywać się palcem na ekranie dotykowym urządzenia mobilnego a następnie nacisnąć przycisk "Zatwierdź podpis"</p>
            <br>
              <canvas
                id="myCanvas"
                width="400"
                height="110"
              ></canvas>
              <br />
              <button onclick="javascript:clearArea();return false;">Wyczyść</button>
                    
              Linia :
              <select id="selWidth">
                <option value="1">1</option>
                <option value="3" selected="selected">3</option>
                <option value="5">5</option>
                <option value="7">7</option>
                <option value="9" >9</option>
                <option value="11">11</option>
              </select>
              Kolor :
              <select id="selColor">
                <option value="black">black</option>
                <option value="blue" selected="selected">blue</option>
                <option value="red">red</option>
                <option value="green">green</option>
                <option value="yellow">yellow</option>
                <option value="gray">gray</option>
              </select>
            </div>

            <p hidden id=epochdate></p>
            <p hidden id=link_to_confirmation></p>
            <br><button onclick="javascript:takeScreenShot()">Zatwierdź podpis elektroniczny! </button> <br><br>
            <p hidden id=sign_button_display></p><br>
            <?php        
              echo "<p> Ze wględów bezpieczeństwa rekomendujemy wysłanie zapisanego pliku na serwer FTP </p>";
              echo "<p> W tym celu wybierz plik: <b> $val4 </b> z twoim numerem sesa i dzisiejszą datą zapisu </p>";
              echo "<br>";
              echo "<form action='plik.php' method='POST' ENCTYPE='multipart/form-data'>";
              echo "<input type='file' name='plik'>".'<br/>'.'<br/>';
              echo '</div>'."<br>";      
              echo "<input type='submit' value='Zatwierdzam szkolenie'>";
              echo "</form>";
              echo "<br>"."<br>";
            ?>
        </div>
      <div id="pdf-main-container">
        <div id="pdf-loader">Loading document ...</div>
        <div id="pdf-contents">
          <canvas id="pdf-canvas" width="400" height="150"></canvas>
          <div id="page-loader">Loading page ...</div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer>
  <span>Schneider Electric Industries Polska</span>
</footer>
<script>
document.getElementById("signature_digital_ch").addEventListener('click', function (event) {
    if ( event.target && event.target.matches("input[type='checkbox']") ) {
        if (document.getElementById('signature_digital_box').hidden == true){
          document.getElementById('signature_digital_box').hidden = false;
        } else {
          document.getElementById('signature_digital_box').hidden = true;
        }
        
    }
});
</script>
</body>
</html>