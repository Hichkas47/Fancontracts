<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Result</title>
    <link rel="shortcut icon" href="../../style/images/logo.png" />
    <style>
        html {
            scroll-behavior: smooth;
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url(../../style/images/temp_bkg.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100%;
            transition: 1s;
            color: white;
        }

        #main_div {
            background-color: #191c23bf;
            margin: 0 auto;
            width: 300px;
            height: 400px;
            border-radius: 4px;
            text-align: center;
        }

        #void {
            height: 50px;
            width: 100%;
        }

        #toper {
            height: 5%;
        }

        #top {
            height: 35%;
        }

        #bottom {
            height: 60%;
        }

        #top_text {
            margin-top: 10px;
        }

        ul {
            list-style-type: none;
        }

        a {
            color: white;
        }
    </style>
</head>

<body>
    <div id="void">
    </div>
    <div id="main_div">
        <div id="toper"></div>
        <div id="top">
            <p id="top_text">Message:</p>
            <?php
            $msg_list = ['id' => 'ERR: ID is empty/invalid',
             'author' => 'ERR: Author is empty', 
             'platform' => 'ERR: platform is empty/invalid', 
             'tcount' => 'ERR: Target Count is empty/invalid', 
             'idplat' => "ERR: ID and Platform doesn't match", 
             'disguise' => 'ERR: Empty disguise box', 
             'complication' => 'ERR: Time limit is Empty/Invalid',
             'method' => 'ERR: Empty method box(es)',
             'methcount' => 'ERR: Methods/Disguises can not be more than target count',
             'err' => 'error while submitting',
             'exists' => 'ERR: This contract is already submitted', 
             'game' => "ERR: Game is empty/incorrect/doesn't match other elements",
             'successful' => 'Contract was successfully added',
             'success' => 'Edit Request was successfully added'];
            $msg = $msg_list[$_GET['web']];
            echo "<p>$msg</p>"
            ?>
        </div>
        <div id="bottom">
            <a href="../">Submit another contract</a>
            <br/>
            <p>or</p>
            <a href="../../list/">See the list</a>
        </div>
    </div>
</body>

</html>