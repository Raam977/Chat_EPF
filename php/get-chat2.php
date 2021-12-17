<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_idfile = $_SESSION['unique_id'];
        $incoming_idfile = mysqli_real_escape_string($conn, $_POST['incoming_idfile']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_idfile
                WHERE (outgoing_msg_idfile = {$outgoing_idfile} AND incoming_msg_idfile = {$incoming_idfile})
                OR (outgoing_msg_idfile = {$incoming_idfile} AND incoming_msg_idfile = {$outgoing_idfile}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_idfile'] === $outgoing_idfile){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['myfile'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['myfile'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>