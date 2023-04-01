<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../assets/header.php";
    include "../assets/conn.php";
    ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Stats | Fancontracts</title>
</head>

<body>
    <div class="header">
        <h1>
            Stats - Fancontracts
        </h1>
    </div>
    <div class="container">
        <div class="all_container">
            <div class="num_container">
                <div class="num">
                    <h3>
                        General
                    </h3>
                    <?php
                    $cond = 1;
                    $sql = $conn->prepare("SELECT DISTINCT `id` from `contracts` WHERE ?");
                    $sql->bind_param('i', $cond);
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span><?= $result->num_rows ?> contracts submitted so far.</span><br/>
                    <?php
                    $sql = $conn->prepare("SELECT DISTINCT `author` from `contracts` WHERE ?");
                    $sql->bind_param('i', $cond);
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span><?= $result->num_rows ?> unique players submitted so far.</span><br/>
                    <?php
                    $sql = $conn->prepare("SELECT DISTINCT `mission` from `contracts` WHERE ?");
                    $sql->bind_param('i', $cond);
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span><?= $result->num_rows ?> locations used so far.</span><br/>
                    <?php
                    $sql = $conn->prepare("SELECT DISTINCT `id` from `videos` WHERE ?");
                    $sql->bind_param('i', $cond);
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span><?= $result->num_rows ?> videos so far.</span><br/>
                    <?php
                    $sql = $conn->prepare("SELECT DISTINCT `id` from `comments` WHERE ?");
                    $sql->bind_param('i', $cond);
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span><?= $result->num_rows ?> comments so far.</span>
                </div>
            </div>
            <?php
            $list_loc = $list_count = $list_final = array();
            $counter = 0;
            $sql = $conn->prepare("SELECT DISTINCT `author` from `contracts` WHERE ?");
            $sql->bind_param('i', $cond);
            $sql->execute();
            $result = $sql->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($list_loc, $row['author']);
            }
            $sql = $conn->prepare("SELECT `author` from `contracts` WHERE `author` = ?");
            $sql->bind_param('s', $loc);
            foreach ($list_loc as $loc) {
                $sql->execute();
                $result = $sql->get_result();
                $list_count[$loc] = $result->num_rows;
            }
            ksort($list_count);
            arsort($list_count);
            foreach ($list_count as $x => $x_value) {
                $counter += 1;
                if ($counter < 6) {
                    $list_final[$x] = $x_value;
                }
            }
            ?>
            <div class="num_container">
                <div class="num">
                    <h3>
                        Top Players
                    </h3>
                    <?php
                    foreach ($list_final as $k => $v) {
                    ?>
                        <span><?= $k . ": " . $v ?></span>
                        <br/>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="num_container">
                <div class="num">
                    <h3>
                        By Platform
                    </h3>
                    <?php
                    $sql = $conn->prepare("SELECT `platform` from `contracts` WHERE platform = ?");
                    $sql->bind_param('s', $cond);
                    $cond = "PC";
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span>PC: <?= $result->num_rows ?></span><br/>
                    <?php
                    $cond = "PS";
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span>PS: <?= $result->num_rows ?></span><br/>
                    <?php
                    $cond = "Xbox";
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span>Xbox: <?= $result->num_rows ?></span><br/>
                    <?php
                    $cond = "Stadia";
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <span>Stadia: <?= $result->num_rows ?></span><br/>
                </div>
            </div>
            <?php
            $list_loc = $list_count = $list_final = array();
            $counter = 0;
            $cond = 1;
            $sql = $conn->prepare("SELECT DISTINCT `mission` from `contracts` WHERE ?");
            $sql->bind_param('i', $cond);
            $sql->execute();
            $result = $sql->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($list_loc, $row['mission']);
            }
            $sql = $conn->prepare("SELECT `mission` from `contracts` WHERE `mission` = ?");
            $sql->bind_param('s', $loc);
            foreach ($list_loc as $loc) {
                $sql->execute();
                $result = $sql->get_result();
                $list_count[$loc] = $result->num_rows;
            }
            ksort($list_count);
            arsort($list_count);
            foreach ($list_count as $x => $x_value) {
                $counter += 1;
                if ($counter < 6) {
                    $list_final[$x] = $x_value;
                }
            }
            ?>
            <div class="num_container">
                <div class="num">
                    <h3>
                        Most used Missions
                    </h3>
                    <?php
                    foreach ($list_final as $k => $v) {
                    ?>
                        <span><?= $k . ": " . $v ?></span>
                        <br/>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        include "../assets/void_div.php";
    ?>
</body>

</html>