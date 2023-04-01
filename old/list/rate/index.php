<?php
session_start();
include "../../assets/conn.php";
$id_root = $_GET['con'];
$sql = $conn->prepare("SELECT `title` FROM `contracts` WHERE `contract_id` = ?");
$sql->bind_param('s', $id_root);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows < 1) {
    header('location: ../');
} else {
    while ($row = $result->fetch_assoc()) {
        $name = $row['title'];
    }
}
?>
<?php
if (isset($_POST['submit_vote'])) {
    $con_id = $id_root;
    if (isset($_POST['vote_num']) && !empty($_POST['vote_num']) && $_POST['vote_num'] < 6 && $_POST['vote_num'] > 0) {
        $rate = $_POST['vote_num'];
    } else {
        header("location: ../../assets/submit_check.php?con=$id_root");
    }
    if (isset($_POST['fingerprint']) && !empty($_POST['fingerprint'])) {
        $fingerprint = $_POST['fingerprint'];
    } else {
        header("location: ../../assets/submit_check.php?con=$id_root");
    }
    if (isset($_POST['recommand']) && !empty($_POST['recommand'])) {
        $rec = $_POST['recommand'];
    } else {
        $rec = "no";
    }
    $sql = $conn->prepare("SELECT `id` from `rating` where `con_id` = ? and `fingerprint` = ?");
    $sql->bind_param('ss', $con_id, $fingerprint);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows > 0) {
        setcookie($id_root, 'yes', time() + (86400 * 365), "/");
        $_SESSION[$id_root] = "yes";
        header("location: ../../assets/submit_check.php?con=$id_root");
    } else {
        $sql = $conn->prepare("INSERT INTO `rating`(`id`, `con_id`, `value`, `fingerprint`, `rec`) VALUES (null,?,?,?,?)");
        $sql->bind_param('siss', $con_id, $rate, $fingerprint, $rec);
        $sql->execute();
        $result = $sql->get_result();
        setcookie($id_root, 'yes', time() + (86400 * 365), "/");
        $_SESSION[$id_root] = "yes";
        header("location: ../../assets/submit_check.php?con=$id_root");
    }
}
?>
<?php
if (isset($_POST['submit_comment'])) {
    $con_id = $id_root;
    if (isset($_POST['name_name_comment']) && !empty($_POST['name_name_comment']) && strlen($_POST['name_name_comment']) > 2) {
        $name = $_POST['name_name_comment'];
    } else {
        header("location: ../../assets/submit_check.php?con=$id_root");
    }
    if (isset($_POST['comment_context']) && !empty($_POST['comment_context']) && strlen($_POST['comment_context']) < 501) {
        $comment = $_POST['comment_context'];
    } else {
        header("location: ../../assets/submit_check.php?con=$id_root");
    }
    if (isset($_POST['fingerprint_2']) && !empty($_POST['fingerprint_2'])) {
        $fingerprint = $_POST['fingerprint_2'];
    } else {
        header("location: ../../assets/submit_check.php?con=$id_root");
    }
    $time = time();
    $sql = "SELECT `id` FROM `comments` WHERE `con_id` = '$con_id' and `fingerprint` = '$fingerprint'";
    $result = $conn->query($sql);
    if ($result->num_rows < 1) {
        $sql = "INSERT INTO `comments` (`id`, `con_id`, `name`, `comment`, `time`, `fingerprint`) VALUES (null,'$con_id','$name','$comment','$time', '$fingerprint')";
        $conn->query($sql);
        header("location: ../../assets/submit_check.php?con=$id_root");
    } else {
        $sql = "SELECT `id`, `time` FROM `comments` WHERE `con_id` = '$con_id' and `fingerprint` = '$fingerprint' ORDER BY `id` DESC";
        $result = $conn->query($sql);
        $result = $result->fetch_assoc();
        if (time() - $result['time'] < 120) {
            header("location: ../../assets/submit_check.php?con=$id_root");
        } else {
            $sql = "INSERT INTO `comments` (`id`, `con_id`, `name`, `comment`, `time`, `fingerprint`) VALUES (null,'$con_id','$name','$comment','$time', '$fingerprint')";
            $conn->query($sql);
            header("location: ../../assets/submit_check.php?con=$id_root");
        }
    }
}
?>
<?php
if (isset($_POST['yt_submit'])) {
    if (isset($_POST['yt_link']) && !empty($_POST['yt_link']) && strlen($_POST['yt_link']) > 10) {
        $link = $_POST['yt_link'];
        $con = $id_root;
        $sql = $conn->prepare("SELECT `id` FROM `videos` WHERE `link` = ?");
        $sql->bind_param('s', $link);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows < 1) {
            $sql = $conn->prepare("INSERT INTO `videos` (`id`, `link`, `con_id`) VALUES (null, ?, ?)");
            $sql->bind_param('ss', $link, $con);
            $sql->execute();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../../assets/header.php" ?>
    <title>Rate/Comment <?= $name ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="temp" hidden><?= $id_root ?></div>
    <div class="content">
        <div class="head">
            <a id="head_text_link" href="../">
                <-- back to previous page </a>
        </div>
        <div id="table_div">
            <table id="myTable" style="margin-top: 5px;">
                <thead>
                    <tr>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT title, contract_id, platform, mission, target_count, `type`, complications, disguises, methods, author, more_info from contracts WHERE `contract_id` = '$id_root' ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
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
                            </tr>
                    <?php
                            $more = $row['more_info'];
                            if (strlen($row['more_info']) < 1) {
                                $more = "Not Specified";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="rate_main_box">
            <div id="more_info_box">
                <p id="p1">More info</p>
                <br/>
                <p id="p2"><?= $more ?></p>
                <br/>
            </div>
            <div id="rate_form_box">
                <div class="main_topbot">
                    <div class="sub_topbot_left" id="num_box">
                        <?php
                        $sql = "SELECT AVG(`value`) AS avgcol FROM rating WHERE `con_id` = '$id_root'";
                        $result = $conn->query($sql);
                        $result = mysqli_fetch_assoc($result);
                        ?>
                        <p class="vottt">
                            <?= round($result['avgcol'], 1) ?>/5
                        </p>
                    </div>
                    <div class="sub_topbot_right">
                        <div class="sub_3">
                            <?php
                            $sql = "SELECT `id` FROM rating WHERE `con_id` = '$id_root'";
                            $result = $conn->query($sql);
                            $count = $result->num_rows;
                            ?>
                            <p class="info">
                                <?= $count ?> people voted
                            </p>
                        </div>
                        <div class="sub_3">
                            <?php
                            $sql = "SELECT `id` FROM rating WHERE `con_id` = '$id_root' AND `rec` = 'yes'";
                            $result = $conn->query($sql);
                            $count = $result->num_rows;
                            ?>
                            <p class="info">
                                <?= $count ?> people recommend
                            </p>
                        </div>
                    </div>
                </div>
                <div class="main_topbot">
                    <div class="sub_topbot_left">
                        <p class="vottt">
                            Vote
                        </p>
                    </div>
                    <div class="sub_topbot_right" id="borderr">
                        <p id="temp_p" hidden>you've already voted</p>
                        <?php
                        // $bfp = $_POST['val'];
                        // $insert = "SELECT `fingerprint` from `rating` WHERE `fingerprint` = '$bfp')";
                        // $result = $conn->query($insert);
                        // echo $result->num_rows;
                        if (isset($_COOKIE[$id_root]) || isset($_SESSION[$id_root])) {
                        ?>
                            you've already voted
                        <?php
                        } else {
                        ?>
                            <form method="POST" id="form_1">
                                <input type="text" hidden readonly name="fingerprint" id="fingerprint">
                                <div class="sub_3">
                                    <div id="label_div">
                                        <label for="">
                                            <input type="checkbox" value="yes" id="recommand" name="recommand" value="yes">
                                            I recommend this
                                        </label>
                                    </div>
                                </div>
                                <div class="sub_3" id="bottom_sub_3">
                                    <label for="vote_num" id="label_1">
                                        <input type="number" id="vote_num" name="vote_num" placeholder="choose 1-5" min="1" max="5" minlength="1" maxlength="1" required>
                                    </label>
                                    <label for="submit" id="label_2">
                                        <input type="submit" id="submit_vote" name="submit_vote">
                                    </label>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment_main_box">
            <div class="comment_title">
                <p>
                    Comments
                </p>
            </div>
            <div class="sort_div">
                <div class="sort_btn" id="newest" onclick="com_coms('comments', 'submit_comment_box', 'runs', 'newest', 'oldest', 'runs_b')">Comments</div>
                <div class="sort_btn" id="oldest" onclick="com_coms('submit_comment_box', 'comments', 'runs', 'oldest', 'newest', 'runs_b')">Comment</div>
                <div class="sort_btn" id="runs_b" onclick="com_coms('runs', 'comments', 'submit_comment_box', 'runs_b', 'newest', 'oldest')">Videos</div>
            </div>
            <script>
                function ytfunc() {
                    var url = $('#yt_in_1').val();
                    if (url != undefined || url != '') {
                        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                        var match = url.match(regExp);
                        console.log(match);
                        if (match && match[2].length == 11) {
                            if (match[0].indexOf('youtu') >= 0 || match[0].indexOf('embed') >= 0) {
                                $('#yt_in_3').attr('disabled', false);
                                document.getElementById("yt_in_1").style.border = "1px solid lime";
                                $('#yt_in_2').attr('value', match[2]);
                            }
                        } else {
                            $('#yt_in_3').attr('disabled', true);
                            document.getElementById("yt_in_1").style.border = "1px solid red";
                        }
                    }
                }
            </script>
            <div id="runs">
                <div id="submit_run">
                    <div>
                        <p>Submit Your Run</p>
                        <form method="POST">
                            <input type="text" onkeyup="ytfunc()" id="yt_in_1" placeholder="Link to YouTube Video">
                            <input type="text" id="yt_in_2" hidden name="yt_link">
                            <input type="submit" id="yt_in_3" name="yt_submit" disabled>
                        </form>
                    </div>
                </div>
                <div id="iframe_main">
                    <?php
                    $sql = "SELECT `link` FROM `videos` WHERE `con_id` = '$id_root' ORDER BY `id` DESC";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="ifram">
                            <iframe src="https://www.youtube.com/embed/<?= $row['link'] ?>">
                            </iframe>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="submit_comment_box" id="submit_comment_box">
                <form method="POST">
                    <div>
                        <p style="font-size: 14px; letter-spacing: 0; margin: 0;">Note: There must be a 2 minutes interval between your comments on<br/>each contract. Otherwise the comment won't be submitted.</p>
                        <input type="text" hidden readonly name="fingerprint_2" id="fingerprint2">
                        <input type="text" placeholder="Your Name" required name="name_name_comment">
                    </div>
                    <div>
                        <textarea name="comment_context" id="comment_context" required maxlength="500" placeholder="Your Comment (max 500)"></textarea>
                    </div>
                    <div>
                        <input type="submit" name="submit_comment" id="submit_comment">
                    </div>
                </form>
            </div>
            <div id="comments">
                <?php
                $sql = $conn->prepare("SELECT * FROM `comments` WHERE `con_id` = ? ORDER BY `id` desc");
                $sql->bind_param('s', $id_root);
                $sql->execute();
                $result = $sql->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <table id="Table_Com">
                            <tr>
                                <td hidden><?= $row['id'] ?></td>
                                <td>
                            <tr>
                                <td><span><?= $row['name'] ?>:</span></td>
                            </tr>
                            <tr>
                                <td><span><?= $row['comment'] ?></span></td>
                            </tr>
                            </td>
                            </tr>
                        </table>
                    <?php
                    }
                } else {
                    ?>
                    <table id="Table_Com">
                        <tr>
                            <td>
                        <tr>
                            <td><span>Notice:</span></td>
                        </tr>
                        <tr>
                            <td><span>No Comments yet</span></td>
                        </tr>
                        </td>
                        </tr>
                    </table>
                <?php
                }
                ?>
            </div>
            <?php include "../../assets/void_div.php" ?>
        </div>
        <script>
            // Initialize the agent at application startup.
            const fpPromise = new Promise((resolve, reject) => {
                    const script = document.createElement('script')
                    script.onload = resolve
                    script.onerror = reject
                    script.async = true
                    script.src = 'https://cdn.jsdelivr.net/npm/' +
                        '@fingerprintjs/fingerprintjs@3/dist/fp.min.js'
                    document.head.appendChild(script)
                })
                .then(() => FingerprintJS.load())

            // Get the visitor identifier when you need it.
            fpPromise
                .then(fp => fp.get())
                .then(result => {
                    // This is the visitor identifier:
                    const visitorId = result.visitorId;
                    if (document.getElementById("fingerprint") != null) {
                        document.getElementById("fingerprint").value = visitorId;
                    }
                    document.getElementById("fingerprint2").value = visitorId;
                    var con = document.getElementById('temp').innerHTML;
                    $.ajax({
                        method: 'POST',
                        data: {
                            bfp: visitorId,
                            con: con
                        },
                        url: 'bfp_check.php',
                        datatype: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data == "yes") {
                                document.getElementById('form_1').style.display = 'none';
                                document.getElementById('temp_p').hidden = false;
                            }
                        }
                    });
                })
        </script>
        <script>
            function com_coms(x1, x2, x3, x4, x5, x6) {
                document.getElementById(x1).style.display = 'block';
                document.getElementById(x2).style.display = 'none';
                document.getElementById(x3).style.display = 'none';
                document.getElementById(x4).style.color = "#ffffff";
                document.getElementById(x4).style.backgroundColor = "red";
                document.getElementById(x5).style.color = "#000000";
                document.getElementById(x5).style.backgroundColor = "#ffffff";
                document.getElementById(x6).style.color = "#000000";
                document.getElementById(x6).style.backgroundColor = "#ffffff";
            }
        </script>
</body>

</html>