<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet" type="text/css" /> 
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Zarządzanie SPLami</title>
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
        <span class="title"> Panel administracyjny -zarządzanie SPLami</span>
        <a class="a_help"  href="./pomoc.html">Pomoc</a>
    </header>

    <div id="hrline"></div>
    <div class="panel_admin">
            <P> Dodawanie, usuwanie edycja SPLi:</P>
        <?php


            echo '<div style="width:auto; height:200px; overflow:auto;">';
            echo "<table id='table1' class='fixed_headers' style='width:100%; border-collapse: collapse;' border='1'>
            <thead>
                <tr style='width:98%;'>
                    <th>id </th>
                    <th>Kategoria</th>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Autor</th>
                    <th>Data utworzenia</th>
                    <th> Usuń </th>
                    <th> Edytuj</th>

                </tr>
            </thead>";
            
            echo "<tbody>";
            if($result = mysqli_query($link,"select DISTINCT * from spl_all_spls WHERE 1 ORDER BY id DESC")){
            while($row = mysqli_fetch_assoc($result)) {
                $val1 = $row['id'];
                $val6 = $row['category'];
                $val2 = $row['title'];
                $val3 = $row['desctription'];
                $val4 = $row['author'];
                $val5 = $row['creation_date'];
                

                echo "<tr><td  style='width:5%;'>";
                echo $val1;
                echo "</td>";
                echo "<td  style='width:20%;'>";
                echo "$val6";
                echo "</td>";
                echo "<td  style='width:20%;'>";
                echo "$val2";
                echo "</td>";
                echo "<td  style='width:20%;'>";
                echo "$val3";
                echo "</td>";
                echo "<td style='width:20%;'>";
                echo "$val4";
                echo "</td>";
                echo "<td style='width:20%;'>";
                echo "$val5";
                echo "</td>";
                echo "<td>
                    <a href=\"delete_spl.php?a=del&amp;id={$row['id']}\">DEL</a>
                    </td>";
                    echo "<td>
                    <a href=\"edit_spl.php?a=edit&amp;id={$row['id']}\">EDIT</a>
                    </td>";
                echo "</tr>" ;
            }
        }

        echo "</tbody>
            </table>";
            echo '</div>';
            mysqli_free_result($result);
            mysqli_close($link);
            ?>
        
            <div class="">
            <p> Dodaj nowy SPL:</p>
            <form action="add_new_spl.php" class ="spl_add" method="post">
                Kategoria:<br>
                <input type="text" name="category" value="">
                <br>
                Tytuł:<br>
                <input type="text" name="title" value="">
                <br>
                Opis:<br>
                <input type="text" name="desctription" value="">
                <br>
                Autor:<br>
                <input type="text" name="author" value="">
                <br>
                Data utworzenia:<br>
                <input type="text" name="creation_date" value="">
                <br><br>
                <input type="submit" value="Dodaj">
            </form>
            </div>
            <br>
            <a href="users_interface.php"><<< powrót panelu administracyjnego</a>
            </div>
    </div>    
    <footer>
        <span>Schneider Electric Industries Polska</span>
    </footer>
</body>
</html>