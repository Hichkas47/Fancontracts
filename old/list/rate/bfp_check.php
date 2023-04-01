<?php
    include "../../assets/conn.php";
    $temp_bfp = $_POST['bfp'];
    $con = $_POST['con'];
    $sql = $conn->prepare("SELECT `id` from `rating` where `con_id` = ? and `fingerprint` = ?");
    $sql->bind_param('ss', $con, $temp_bfp);
    $sql->execute();
    $result = $sql->get_result();
    if($result->num_rows > 0){
        echo 'yes';
    }
    else{
        echo 'no';
    }
?>