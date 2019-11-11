<!DOCTYPE html>
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
    <script type="text/javascript" src="./JsCode6.js"></script>
    <title>Zapis potwierdzenia do bazy danych i na FTP</title>
</head>

<body>

    <?php
        session_start();
        $zm = $_GET['a'];
        $sesa=$_GET['sesa'];
        $name=$_SESSION['name'];
        $title=$_GET['txtTitle'];
        $trainer=$_GET['txtTainer'];
        $id=$_GET['txtId'];
        $_SESSION['title']=$title;
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
            <span class="title">Zapisz szkolenia do bazy danych i na serwer FTP</span>
            <a class="a_help"  href="./pomoc.html">Pomoc</a>
        </header>

        <div id="hrline"></div>
    </div>
    <div class="text_confirmation">
        <br>
        <p><b><?php echo $_SESSION['name'];?> ,</b></p>
        <span>To już ostatni etap ale ze zwględów bezpieczeństwa równie ważny.</span>
        <p>Jeśl użyłeś podpisu elektronicznego i nacisnąłeś przycisk "zatwierdź" powinieneś w folderze "pobrane mieć pdf ze skanem SPL'a z podpisem</p>
        <p>Ze względów bezpieczeństwa rekomendujemy podpisany plik przesłać na serwer FTP i zatwierdzić szkolenie w bazie danych</p>
        <p>Jak to zrobić?</p>
        <p>Klikasz na przycisk <strong>"Wybierz plik " </strong>i wybierasz plik : <?php echo $title;?>, wraz z numerem twojej sesy oraz daty</p>
        <br>
        <?php
            if ($_GET['a'] =='Nie'){
                header( 'Location: index.html' ) ;
            }
            echo "<form action='plik.php' method='POST' ENCTYPE='multipart/form-data'>";
            echo "<input type='file' name='plik'>".'<br/>'.'<br/>';
            echo "Następnie naciskasz przycisk <b> Wyślij plik i zapisz do Bazy Danych </b> aby wysłac plik na serwer FTP oraz zapisać plik do Bazy Danych "; 
            echo "<br>"."<br>";
            echo "<input type='submit' value='Wyślij plik i zapisz do Bazy Danych'>";
            echo "</form>";
            echo "<br>"."<br>";
            echo " to wszystko, dzięki (zostaniesz automatycznie przekierowany na stronę szkoleń)";
        ?>
    </div>

    <br>
    
    <footer>
    <span>Schneider Electric Industries Polska</span>
    </footer>
    <br>
</body>
</html>