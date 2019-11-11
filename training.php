<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet" type="text/css" /> 
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Szkolenie</title>
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
        $zm = $_GET['a'];
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
            <span class="title"> Szkolenie</span>
            <a class="a_help"  href="./pomoc.html">Pomoc</a>
        </header>

        <div id="hrline"></div>
    </div>

    <div class="main_wrapper">
        <p>Poniżej karta twojego szkolenia.</p>
        <span>Po wykonaniu szkolenia wprowadź numer sesa trenera lub osoby zlecającej szkolenie i naciśnij przycisk dalej</span>
        <form action="training_confirmation7.php" class="myform" method="get">
            Sesa trenera : <input type='text'  name ='txtTrainer'>
            <input type='text' hidden name='a' value="<?php echo $zm;?>">
            <button type="submit" >Dalej </button>
        </form>
        <br>
        <?php
            if($result = mysqli_query($link,"select DISTINCT * from spl_all_spls WHERE id='$zm'  ")){
                while($row = mysqli_fetch_assoc($result)) {
                    $val4 = $row['title'];
                    $_SESSION['title']=$val4;
                }
            }
        ?>

    <div>
    <iframe src="./spl/produkcja/<?php echo $val4; ?>" width="1200" height="700"></iframe>
    <footer>
        <span>Schneider Electric Industries Polska</span>
    </footer>
</body>
</html>