<?php 
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $enc_pass = $row['password'];
            if(password_verify($password, $enc_pass)){
                $status = "Online agora";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                }else{
                    echo "Algo deu errado tente de novo!";
                }
            }else{
                echo "Email ou Password incorreto!";
            }
        }else{
            echo "$email - Este email não existe!";
        }
    }else{
        echo "Preencha todos os campos!";
    }
?>