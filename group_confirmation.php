<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet" type="text/css" /> 
    <link href="style.css" rel="stylesheet" type="text/css" />
<title>Potwierdzanie grupowe</title>
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
        <span class="title"> Panel trenera -potwierdzenine grupowe szkolenia</span>
        <a class="a_help"  href="./pomoc.html">Pomoc</a>
    </header>

    <div id="hrline"></div>
    <br>
    <div class="panel_admin">

    <?php
    $today = date("Y-m-d"); 
    echo "Dziś jest: ", $today, "<br>";
    echo '<h3>Grupowe wprowadzanie szkoleń przez trenera</h3><br>';
    echo '<form action="group_confirmation_to_DB.php" method="get">';
    echo  "numer szkolenia które się odbyło: ",'<input type="text"  name="txtTraining"  value=""><br><br>';
    echo  "Data szkolenia: ",'<input type="text"  readonly="readonly" name="training_date"  value="'.$today.'"><br><br>';
    echo  "sesa Trenera: ",'<input type="text"  name="sesa_trenera"  value=""><br><br>';
    echo  "Sesa osoby szkolonej; ",'<input type="text"  name="sesa1"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa2"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa3"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa4"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa5"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa6"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa7"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa8"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa9"  value=""><br><br>';
    echo  "Sesa osoby szkolonej: ",'<input type="text"  name="sesa10"  value=""><br><br>';
    echo "Potwierdzam odbycie szkolenia :", ' <button type="submit" name="b" value="">Zatwierdź </button><br><br>';
    echo " Rezygnuje z potwierdzenia     :",' <button type="reset" name ="b" value="">Wyczyść</button><br>';
    echo '<br>';
    echo ' </form> ';
    echo '<br>';
    echo '<a href="index.html"><<< powrót do strony głównej</a>',"<br>";
    echo '<br>';
    ?>

</div>
    <footer>
        <span>Schneider Electric Industries Polska</span>
    </footer>
</body>
</html>
