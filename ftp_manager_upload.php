
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet" type="text/css" /> 
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Ftp manafer</title>
    <?php header('Content-Type: text/html; charset=utf-8') ?>
</head>
<body>
<?php
        session_start();
        $sesa = $_SESSION['sesa'];
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
        <span class="title"> Panel administracyjny -wgranie pliku na FTP</span>
        <a class="a_help"  href="./pomoc.html">Pomoc</a>
    </header>

    <div id="hrline"></div>

    <div class="panel_admin panel_admin--width ">  

        <h3> Wgranie pliku na serwer FTP <h3>

        <br>
        <p>Wybierz pliki do wysłania</p>
        <?PHP
        echo "<form action='' method='POST' ENCTYPE='multipart/form-data'>";
        echo "<input type='file' name='plik'>".'<br/>'.'<br>';
        echo "<input type='submit' value='Wyślij plik'>";
        echo "</form>";
        if (isset($_FILES['plik']['type'])) {
                echo '<br> ';
                echo "Nazwa pliku do zapisu: ".$_FILES['plik']['name'];
                echo '<br> ';

                $max_rozmiar = 10485760000;
                if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
                    echo "Rozmiar pliku to:";
                    echo $_FILES['plik']['size'];
                    echo "<br>";
                    echo "Maksymalny rozmiar pliku to:";
                    echo $max_rozmiar;
                    echo "<br>";
                    if ($_FILES['plik']['size'] > $max_rozmiar) {
                        echo 'Błąd! Plik jest za duży!';
                    } else {
                        echo 'Odebrano plik. Początkowa nazwa: '.$_FILES['plik']['name'];
                        echo '<br/>';
                        if (isset($_FILES['plik']['type'])) {
                            $file_size =$_FILES['plik']['size'];
                            echo 'File size : '.$file_size.'<br/>';

                            $file_type = $_FILES['plik']['tmp_name'];
                            echo 'File typ : '.$file_type.'<br/>';

                            $file_name = $_FILES['plik']['name'];
                            echo 'File name : '.$file_name.'<br/>';
                        
                            $file_destination = $_SERVER['DOCUMENT_ROOT'].'/spl/Signed/'.$file_name;
                            echo 'File Destination : '. $file_destination;
                        echo '<br>'.$_SERVER['DOCUMENT_ROOT'].'<br>';
                            
                        }
                        if(is_uploaded_file($file_type)) {
                            move_uploaded_file($file_type, $file_destination);
                        echo "Plik: <strong>$file_name</strong> o rozmiarze 
                        <strong>$file_size bajtów</strong> został przesłany na serwer!";
                    }
                    else{
                        echo " Upload się nie powiódł";
                    }
                
                    }
                } else {
                echo 'Brak danych do przesyłania lub błąd przy przesyłaniu danych!';
                }echo "<br>";
        }    
        //echo "koniec";
        ?>
    </div>
    <br> 
    <a href="users_interface.php"><<< powrót panelu administracyjnego</a>
    <br> 

    <footer>
        <span>Schneider Electric Industries Polska</span>
    </footer>
</body>
</html>