<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        
        
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $message_to_dencrypt = $row['msg'] ;
                    $key = 'arrozdepato';
                    $c = base64_decode($message_to_dencrypt);
                    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                    $iv = substr($c, 0, $ivlen);
                    $hmac = substr($c, $ivlen, $sha2len=32);
                    $ciphertext_raw = substr($c, $ivlen+$sha2len);
                    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                    if (hash_equals($hmac, $calcmac)){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'.$original_plaintext  .'</p>
                                </div>
                                </div>';
                    }
                }else{
                    $message_to_dencrypt = $row['msg'] ;
                    $key = 'arrozdepato';
                    $c = base64_decode($message_to_dencrypt);
                    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                    $iv = substr($c, 0, $ivlen);
                    $hmac = substr($c, $ivlen, $sha2len=32);
                    $ciphertext_raw = substr($c, $ivlen+$sha2len);
                    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                    if (hash_equals($hmac, $calcmac)){
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'.$original_plaintext.'</p>
                                </div>
                                </div>';
                    }
                }
            }
        }else{
            $output .= '<div class="text">Nenhuma mensagem disponivel. Envie uma agora :)</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>

