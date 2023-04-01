<?php
    header('Content-Type: application/json');
    include "../old/assets/conn.php";
    $cont = "";
    if ($final == 0) $final = '-';
    if($_GET['method']=='id'){
        $statement = $conn->prepare("SELECT `title`, `contract_id`, `platform`, `mission`, `target_count`, `type`, `complications`, `disguises`, `methods`, `author`, `more_info` FROM `contracts` WHERE `contract_id` = ?");
        $statement->bind_param('s', $cont);
    }
    else{
        $statement = $conn->prepare("SELECT `title`, `contract_id`, `platform`, `mission`, `target_count`, `type`, `complications`, `disguises`, `methods`, `author`, `more_info` FROM `contracts` WHERE `title` = ?");
        $statement->bind_param('s', $cont); 
    
    }
    $cont = $_GET['query'];
    $statement->execute();
    $result = $statement->get_result();
    if($result -> num_rows == 0){
        $con_arr = array('error' => 'Nothing Found');
        echo json_encode($con_arr);
    }
    else{
        $row = $result->fetch_assoc();
        $sql = "SELECT AVG(`value`) AS avgcol FROM rating WHERE `title` = '$cont'";
        $resultt = $conn->query($sql);
        $resultt = mysqli_fetch_assoc($resultt);
        $final = round($resultt['avgcol'], 1);
        if($final == 0){
            $final = 'no votes';
        }
        $more = $row['more_info'];
        if($more == "") $more = 'Not Specified';
        $con_arr = array("title" => $row['title'], 'id' => $row['contract_id'], 'rating'=> $final, 'platform' => $row['platform'], 'mission' => $row['mission'], 'tcount' => $row['target_count'], 'type' => $row['type'], 'complications' => $row['complications'], 'disguises' => $row['disguises'], 'methods' => $row['methods'], 'author' => $row['author'], 'more' => $more);
        echo json_encode($con_arr);
    }
?>