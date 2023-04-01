<?php
setcookie("note_shown", "tr");
include "../assets/conn.php";
include "../assets/form_check_submit.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../assets/header.php" ?>
	<title>Submit Your Contract | Fancontracts</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="../script/script.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
	<div class="testbox">
		<?php include "../assets/submit_form.php" ?>
	</div>
</body>

</html>