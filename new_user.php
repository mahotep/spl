<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <span class="title"> Panel administracyjny -dodaj nowego użytkownika</span>
        <a class="a_help"  href="./pomoc.html">Pomoc</a>
    </header>

    <div id="hrline"></div>

    <div class="panel_admin panel_admin--width ">
            <br>
            <p> Dodaj nowego użytkownika</p><br>
            <form action="add_new_user.php" class ="login" method="post">
                SESA:<br>
                <input type="text" name="sesa" value="">
                <br>
                Imię:<br>
                <input type="text" name="name" value="">
                <br>
                Nazwisko:<br>
                <input type="text" name="surname" value="">
                <br>
                Hasło:<br>
                <input type="password" name="password" value="">
                <br><br>
                <input type="submit" value="Dodaj">
            </form>
        </div>
        <br>
        <a href="users_interface.php"><<< powrót panelu administracyjnego</a>
    <br>

    <footer>
        <span>Schneider Electric Industries Polska</span>
    </footer>
</body>
</html>