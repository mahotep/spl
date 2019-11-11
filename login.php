<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<title>Strona główna logowania</title>
</head>
<body>
<?php
$sesa=$_POST["sesa"];
$password=$_POST["password"];
echo $nazwa=$_POST["nazwa"];

require "connection.php";
connection();

if(!empty($_POST["sesa"]) && !empty($_POST["password"])){
	if($result = mysqli_query($link,"select * from spl_users where sesa = '".htmlspecialchars($sesa)."' AND password = '".htmlspecialchars($password)."'")){
       $row_cnt = mysqli_num_rows($result);
        echo "Row = ", $row_cnt;
        if ($row_cnt >0) {   
            echo $row_cnt;
            echo '<br>';  
            echo "Zalogowano poprawnie";
            $row = mysqli_fetch_assoc($result);
            echo '<br>'; 
            printf ("%s %s %s\n" ,$row ['sesa'],$row['name'],$row['surname']);
            session_start();
            $_SESSION['sesa']=$row ['sesa'];
            $_SESSION['name']=$row['name'];
            $_SESSION['surname']=$row['surname'];
            $_SESSION['type_select']="Produkcja";
            if ($row['sesa']=="1"){
                header( 'Location: users_interface.php' ) ;
            } else{
                if( $nazwa=="Trener"){
                    header( 'Location: group_confirmation.php' ) ;
                }else{
                    header( 'Location: spl.php' ) ; 
                }

                // header( 'Location: spl.php' ) ; // normalne logowanie
            } 
        } else{
            echo "Bład logowania:";
            header( 'Location: blad_logowania.html' ) ; // normalne logowanie

        }
    }
    echo "nie zgodne hasło i user";
}
mysqli_close($link); 
echo "brak dantch";
?>
</body>
</html>