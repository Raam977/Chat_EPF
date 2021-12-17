<?php
include ('ligar.php');


if ($_POST["Submit"] == "Submeter") {

    $file_tmp = $_FILES["myfile"]["tmp_name"];
    $file_nome = $_FILES["myfile"]["name"];
    $file_caminho = "php/anexos/".$file_nome;
    $target_file = $file_caminho . basename($file_nome);

    $myfile_nome = $_POST["myfile"];
    
  
    $result = mysqli_connect($server, $user, $password) or die("Erro de ligacao ao servidor: " . mysqli_error());
    mysqli_select_db($result, $dbname) or die ("Erro, nao ligou a base de dados: " . mysqli_error());
    mysqli_query($result, "INSERT INTO messages(myfile) VALUES('$myfile_nome','$file_caminho')") or die("Item nao inserido" . mysqli_error());

    move_uploaded_file($file_tmp, $file_caminho);




}

?>