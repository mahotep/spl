<?php
session_start();
$sesa = $_SESSION['sesa'];
$title = $_SESSION['title'];
$trainer = $_SESSION['trainer'];
$id = $_SESSION['id'];

echo "Witaj ";
echo $_SESSION['name'];
echo ' ';
echo $_SESSION['surname'];
echo '<br> ';
echo "Nazwa pliku do zapisu: ".$_FILES['plik']['name'];
echo '<br> ';
echo "Trener: ". $trainer ;
echo '<br> ';
echo "Tytuł: ". $title;
echo '<br> ';
echo "SPL ID:" . $id ;
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
   echo 'Błąd przy przesyłaniu danych!';
}echo "<br>";
echo $link1 = "Location: confirm_to_DB.php?a=".$id."&txtTrainer=".$trainer."&txtTitle=".$title."&filename=".$_FILES['plik']['name'];
header($link1) ;
?> 