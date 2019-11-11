<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet" type="text/css" /> 
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Baza SPLi</title>
    <?php header('Content-Type: text/html; charset=utf-8');$Kategoria="Produkcja"; ?>
    <script>
        var zm="Produkcja"
        function myFunction(zm) {
        document.getElementById("demo").innerHTML = zm;
        }
    </script>
</head>
<body>
    <?php
        session_start();
        $sesa = $_SESSION['sesa'];
        $kategoria=$_SESSION['type_select'];
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
            <span class="title"> Baza SPLi</span>
            <a class="a_help"  href="./pomoc.html">Pomoc</a>
        </header>

        <div id="hrline"></div>
    </div>

    
    <div class="panels">
        <div class="panel_top">
            <div>
                <P> Katalog SPLi: ( Wybierz SPL który chcesz zrealizować ) :</P>
                <?php
                    echo '<form class="form_type"action="" method="post">';
                    echo '<select name="my_select">';
                    echo '<option value="Produkcja" selected>Produkcja</option>';
                    echo '<option value="Logistyka">Logistyka</option>';
                    echo '<option value="Metody">Metody</option>';
                    echo '<option value="Ogólne">Ogólne</option>';
                    echo '</select>';
                    echo '<input class="btn_submit" type="submit" name="submit" value="Wybierz!" />';
                    echo '</form>';

                    if(isset($_POST['my_select'])){
                        $kategoria= $_POST['my_select'];
                    }
                ?>
            </div>
        </div>
        <div class="panel_right">
            <?php 
                // tabela wszystkich SPLi
                echo '<div style="width:auto; height:215px; overflow:auto;">';
                echo "<table id='table1' class='fixed_headers' style='width:100%; border-collapse: collapse;' border='1'>
                <thead>
                    <tr style='width:98%;'>
                        <th>Tytuł</th>
                        <th>Opis</th>
                        <th>Autor</th>
                        <th>Data utworzeina</th>
                        <th>Start</th>
                    </tr>
                </thead>";
                echo "<tbody>";
                    if($result = mysqli_query($link,"select DISTINCT * from spl_all_spls WHERE category='$kategoria'")){
                    while($row = mysqli_fetch_assoc($result)) {
                        $val1 = $row['id'];
                        $val6 = $row['category'];
                        $val2 = $row['title'];
                        $val3 = $row['desctription'];
                        $val4 = $row['author'];
                        $val5 = $row['creation_date'];
                        echo "<tr>";
                        echo "<td  style='width:25%;'>";
                        echo "$val2";
                        echo "</td>";
                        echo "<td  style='width:25%;'>";
                        echo "$val3";
                        echo "</td>";
                        echo "<td style='width:25%;'>";
                        echo "$val4";
                        echo "</td>";
                        echo "<td style='width:20%;'>";
                        echo "$val5";
                        echo "</td>";
                        echo "<td style='width:20%;'>";
                        echo '<a href="training.php?a='.$val1.'&sesa='.$sesa.'">Link'.$val1.'</a>';
                        echo "</td>";
                        echo "</tr>" ;
                        
                    }
                }
                echo "</tbody>
                    </table>";
                    echo '</div>';

            ?>
        
        </div>
        <p class="p_panel"> Twoje SPL, które już zrealizowałeś:</p>
        <div class="panel_left">
            <?php   
                echo '<div style="width:auto; height:200px; overflow:auto;">';
                // tabela z wykonanymi splami przez użytkownika
                echo "<table id='table1' class='fixed_headers' style='width:100%; border-collapse: collapse;' border='1'>
                <thead>
                    <tr style='width:98%;'>
                        <th>Nr.</th>
                        <th> Tytuł</th>
                        <th> Trener</th>
                        <th> Data szkolenia</th>
                        <th> Link do potwierdzenia (jeśli wysłano plik na FTP)</th>
                    </tr>
                </thead>";
                echo "<tbody>";
                    if($result = mysqli_query($link,"select DISTINCT * from spl_base WHERE id_sesa=$sesa ORDER BY id DESC")){
                    while($row = mysqli_fetch_assoc($result)) {
                        $val1 = $row['id'];
                        $val2 = $row['id_sesa'];
                        $val3 = $row['no_spl'];
                        $val4 = $row['title_spl'];
                        $val5 = $row['spl_trainer_sesa'];
                        $val6 = $row['spl_training_date'];

                        echo "<tr>";
                        echo "<td  style='width:1%;'>";
                        echo "$val3";
                        echo "</td>";
                        echo "<td style='width:20%;'>";
                        echo "$val4";
                        echo "</td>";
                        echo "<td style='width:10%;'>";
                        echo "$val5";
                        echo "</td>";
                        echo "<td style='width:10%;'>";
                        echo "$val6";
                        echo "</td>";
                        echo "<td style='width:20%;'>";
                        echo '<a href="view_training_confirmation.php?a='.$val1.'&sesa='.$sesa.'">Link'.$val1.'</a>';
                        echo "</tr>" ;
                    }
                }

                echo "</tbody>
                    </table>";
                echo '</div>';

            ?>        
        </div>
    </div>

    <?php  
    mysqli_free_result($result);
    mysqli_close($link);
    ?>
    <a href="index.html"><<< powrót do strony głównej</a>

    <footer>
        <span>Schneider Electric Industries Polska</span>
    </footer>
</body>
</html>