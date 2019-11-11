<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet" type="text/css" /> 
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Edycja SPL</title>
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
        <span class="title"> Panel administracyjny -skasowanie pliku z FTP</span>
        <a class="a_help"  href="./pomoc.html">Pomoc</a>
    </header>

    <div id="hrline"></div>

    <div class="panel_admin panel_admin--width "> 
        <P> Edytowanie SPLa:</P>
        <br>
        <?php

        $a = trim($_REQUEST['a']);
        $id = trim($_GET['id']);

        if($a == 'edit' and !empty($id)) {
            /* zapytanie do tabeli */
            $wynik = mysqli_query($link, "SELECT * FROM spl_all_spls WHERE id='$id'");
            
            /* 
            wyświetlamy wyniki, sprawdzamy,
            czy zapytanie zwróciło wartość większą od 0
            */
            if(mysqli_num_rows($wynik) > 0) {
                /* odczytujemy zawartość wiersza z tabeli */
                $r = mysqli_fetch_assoc($wynik);
                /* wczytujemy dane do formularza */
                /* 
                w formularz znajdują się ukryte pola "a"
                z wartością "save" i pole "id" z wartością
                zmiennej id
                */
                echo '<form action="" method="post">
                <input type="hidden" name="a" value="save" />
                <input type="hidden" name="id" value="'.$id.'" />
                kategoria:<br />
                <input type="text" name="category"
                value="'.$r['category'].'" /><br />
                Tytuł:<br />
                <input type="text" name="title"
                value="'.$r['title'].'" /><br />
                Opis:<br />
                <input type="text" name="desctription"
                value="'.$r['desctription'].'" /><br />
                Autor:<br />
                <input type="text" name="author"
                value="'.$r['author'].'" /><br />
                Data utworzenia:<br />
                <input type="text" name="creation_date"
                value="'.$r['creation_date'].'" /><br />
                <input type="submit" value="popraw" />
                </form>';
            }
        }
        elseif($a == 'save') {
            /* odbieramy zmienne z formularza */
            echo $id = $_POST['id'],'<br>';
            echo $category = $_POST['category'],'<br>';
            echo $title = trim($_POST['title']),'<br>';
            echo $desctription = trim($_POST['desctription']),'<br>';
            echo $author = trim($_POST['author']),'<br>';
            echo $creation_date = trim($_POST['creation_date']),'<br>';

            // Attempt update query execution
            $sql = "UPDATE spl_all_spls SET category= '$category',title='$title', desctription='$desctription' , author='$author' , creation_date='$creation_date' WHERE id='$id'";
            if(mysqli_query($link, $sql)){
                echo "Records were updated successfully.";
            } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        
            // Close connection
            mysqli_close($link);
            header( 'Location: spl_management.php' ) ; 
        }
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