<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../assets/header.php";
    include "../assets/conn.php";
    ?>
    <title>Contracts List | Fancontracts</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
</head>

<body onload="sidenav_height()">
    <div id="head_box">
        <a href="../../" id="head_text_link">Fancontracts</a>
        <img onclick="openNav('filterside')" id="filter_img" style="cursor: pointer;" src="../style/images/filter.png">
    </div>
    <form data-filter-table-target="#myTable">
        <div id="filterside">
            <input type="text" id="in_1" placeholder="Rate" data-column="rate">
            <input type="text" id="in_2" placeholder="Title" data-column="title">
            <input type="text" id="in_3" placeholder="Game(1,2,3)" data-column="game">
            <input type="text" id="ini4" placeholder="ID" data-column="ID">
            <input type="text" id="in_5" placeholder="Platform" data-column="Platform">
            <input type="text" id="in_6" placeholder="Mission" data-column="Mission">
            <input type="text" id="in_7" placeholder="T-Count" data-column="TCount">
            <input type="text" id="in_8" placeholder="Type" data-column="Type">
            <input type="text" id="in_9" placeholder="Complication(s)" data-column="Complication">
            <input type="text" id="in_10" placeholder="Disguise(s)" data-column="Disguise">
            <input type="text" id="in_11" placeholder="Method(s)" data-column="Method">
            <input type="text" id="in_12" placeholder="Author" data-column="Author">
        </div>
    </form>
    <div class="content">
        <div class="decider">
            <div onclick="visible('table_mode', 'box_mode')">
                <p>Table View</p>
            </div>
            <div style="margin-left: 10px;" onclick="visible('box_mode', 'table_mode')">
                <p>
                    Box View
                </p>
            </div>
        </div>
        <div class="table_mode" id="table_mode">
            <p id="note_text">
                Scroll the table to left if you can't see 12 columns.
            </p>
            <div id="sort_div" style="margin-bottom: 7px;">
                <div onclick="sortTable('des', this.id, 'oldest', 'newest_2')" class="sort_btn" id="newest">Newest</div>
                <div onclick="sortTable('asc', this.id, 'newest', 'newest_2')" class="sort_btn" id="oldest">Oldest</div>
            </div>
            <div id="sort_div_2">
                <div onclick="sortTablee('des', this.id, 'newest', 'oldest')" class="sort_btn" id="newest_2">Best</div>
                <div hidden class="sort_btn" id="oldest_2">Best</div>
            </div>
            <div id="table_div">
                <table id="myTable" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th hidden>p_key</th>
                            <th style="width: 30px;"><i class="fas fa-star"></i></th>
                            <th style="width: 200px;">Title</th>
                            <th style="width: 91px;">ID</th>
                            <th style="width: 76px;">Platform</th>
                            <th style="width: 100px;">Mission</th>
                            <th style="width: 52px;">T-Count</th>
                            <th style="width: 120px;">Type</th>
                            <th style="width: 242px;">Complications</th>
                            <th style="width: 243px;">Disguises</th>
                            <th style="width: 217px;">Methods</th>
                            <th style="width: 80px;">Author</th>
                            <th style="width: 100px;">More Info</th>
                            <th hidden>game</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($conn->connect_error) {
                            die("Connection Failed" . $conn->connect_error);
                        }
                        $i = 1;
                        $sql = $conn->prepare("SELECT * from `contracts` WHERE ? ORDER BY `id` DESC");
                        $sql->bind_param('i', $i);
                        $sql->execute();
                        $result = $sql->get_result();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <?php
                                    $rowid = $row['contract_id'];
                                    $sqlt = $conn->prepare("SELECT AVG(`value`) AS `avgcol` FROM `rating` WHERE `con_id` = ?");
                                    $sqlt->bind_param('s', $rowid);
                                    $sqlt->execute();
                                    $resultt = $sqlt->get_result();
                                    $resultt = mysqli_fetch_assoc($resultt);
                                    $final = round($resultt['avgcol'], 1);
                                    if ($final == 0) {
                                        $final = '-';
                                    }
                                    ?>
                                    <td hidden><?= $row['id'] ?></td>
                                    <td data-column="rate"><?= $final ?></td>
                                    <td data-column='title'><?= $row['title'] ?></td>
                                    <td data-column='ID'><?= $row['contract_id'] ?></td>
                                    <td data-column='Platform'><?= $row['platform'] ?></td>
                                    <td data-column='Mission'><?= $row["mission"] ?></td>
                                    <td data-column='TCount'><?= $row["target_count"] ?></td>
                                    <td data-column='Type'><?= $row["type"] ?></td>
                                    <td data-column='Complication'><?= $row["complications"] ?></td>
                                    <td data-column='Disguise'><?= $row["disguises"] ?></td>
                                    <td data-column='Method'><?= $row["methods"] ?></td>
                                    <td data-column='Author'><?= $row["author"] ?></td>
                                    <td>
                                        <a href="rate/?con=<?= $row['contract_id'] ?>" class='more_info_text'>
                                            more info
                                        </a>
                                    </td>
                                    <td hidden data-column='game'><?= $row["game"] ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No results found";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box_mode" id="box_mode">
            <p id="note_text">
                Sorting/Filtering not available in box mode.
            </p>
            <?php
            $i = 1;
            $sql = $conn->prepare("SELECT * from `contracts` WHERE ? ORDER BY `id` DESC");
            $sql->bind_param('i', $i);
            $sql->execute();
            $result = $sql->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="con_container">
                        <?php
                        $rowid = $row['contract_id'];
                        $sqlt = $conn->prepare("SELECT AVG(`value`) AS `avgcol` FROM `rating` WHERE `con_id` = ?");
                        $sqlt->bind_param('s', $rowid);
                        $sqlt->execute();
                        $resultt = $sqlt->get_result();
                        $resultt = mysqli_fetch_assoc($resultt);
                        $final = round($resultt['avgcol'], 1);
                        if ($final == 0) {
                            $final = '-';
                        }
                        ?>
                        <div class="bar">
                            <div id="level_1_1">
                                <i class="fas fa-star"></i><span><?= $final ?></span>
                            </div>
                            <div id="level_1_2">
                                <span><?= $row["author"] ?></span>
                            </div>
                            <div id="level_1_3">
                                <span><?= $row['platform'] ?></span>
                            </div>
                        </div>
                        <div class="bar">
                            <div id="level_2">
                                <span><?= $row['title'] ?></span>
                            </div>
                        </div>
                        <div class="bar">
                            <div id="level_3">
                                <?= $row['contract_id'] ?>
                            </div>
                            <div id="level_3">
                                <?= $row["mission"] ?>
                            </div>
                        </div>
                        <div class="bar">
                            <div id="level_4_1">
                                <span><?= $row["target_count"] ?> targets</span>
                            </div>
                            <div id="level_4_2">
                                <span><?= $row["type"] ?></span>
                            </div>
                        </div>
                        <div class="bar">
                            <div id="level_5">
                                <span>Complications:<br /><?= $row["complications"] ?></span>
                            </div>
                        </div>
                        <div class="bar">
                            <div id="level_5">
                                <span>Disguises:<br /><?= $row["disguises"] ?></span>
                            </div>
                        </div>
                        <div class="bar">
                            <div id="level_5">
                                <span>Methods:<br /><?= $row["methods"] ?></span>
                            </div>
                        </div>
                        <div class="bar">
                            <div id="level_6">
                                <a href="rate/?con=<?= $row['contract_id'] ?>" class='more_info_text' style="color: white; cursor: pointer;">
                                    more info
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <?php include "../assets/void_div.php" ?>
    <script>
        function visible(x, y) {
            document.getElementById(y).style.display = "none";
            if (x == "table_mode") {
                document.getElementById(x).style.display = "block";
            } else {
                document.getElementById(x).style.display = "flex";
            }
        }
    </script>
</body>

</html>