<?php
session_start();
if (!$_SESSION['logged_in']) {
    echo '<script>window.location.href="../../index.html";</script>';
}

$mysqli = new mysqli('localhost', 'root', '', 'blood-bank') or die($mysqli->error);

$bloodgroup = '';
$type = '';

$mysqli->query(
    "CREATE TABLE IF NOT EXISTS `donors`
    (
        `sno` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(32) NOT NULL,
        `name` varchar(30) NOT NULL,
        `phonenumber` varchar(10) NOT NULL,
        `dateofbirth` varchar(32) NOT NULL,
        `age` int(11) NOT NULL,
        `address` varchar(10000) NOT NULL,
        `gender` varchar(32) NOT NULL,
        `bloodgroup` varchar(32) NOT NULL,
        `timestamp` varchar(32) NOT NULL,
        `status` varchar(15) NOT NULL,
        PRIMARY KEY (`sno`)
    )DEFAULT CHARSET = utf8;"
) or die('MySQL Error: ' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')');

$mysqli->query(
    "CREATE TABLE IF NOT EXISTS `patient`
    (
        `sno` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(32) NOT NULL,
        `name` varchar(30) NOT NULL,
        `phonenumber` varchar(10) NOT NULL,
        `dateofbirth` varchar(32) NOT NULL,
        `age` int(11) NOT NULL,
        `address` varchar(10000) NOT NULL,
        `purpose` varchar(10000) NOT NULL,
        `gender` varchar(32) NOT NULL,
        `bloodgroup` varchar(32) NOT NULL,
        `timestamp` varchar(32) NOT NULL,
        `status` varchar(15) NOT NULL,
        PRIMARY KEY (`sno`)
    )DEFAULT CHARSET = utf8;"
) or die('MySQL Error: ' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')');

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html,
        body {
            display: grid;
            height: 100%;
            width: 100%;
            place-items: center;
            /*background: linear-gradient(-150deg, #8ab6d6, #f8f5f1);*/
            background: linear-gradient(-150deg, #dddddd, #DC143C)
        }

        ::selection {
            background: #4158d0;
            color: #fff;
        }

        .wrapper {
            width: 380px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
            transition: transform .2s;
        }

        .wrapper .title {
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            line-height: 100px;
            color: #4b778d;
            user-select: none;
            border-radius: 15px 15px 0 0;
            background: linear-gradient(-150deg, #b0efeb, #fdbaf8);
        }

        .wrapper form {
            padding: 10px 30px 50px 30px;
        }

        .wrapper form .field {
            height: 50px;
            width: 100%;
            margin-top: 20px;
            position: relative;
        }

        .wrapper form .field input,
        .wrapper form .field select {
            height: 100%;
            width: 100%;
            outline: none;
            font-size: 17px;
            padding-left: 20px;
            border: 1px solid lightgrey;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .wrapper form .field input:focus,
        form .field input:valid,
        .wrapper form .field select:focus,
        form .field select:valid {
            border-color: #4158d0;
        }

        .wrapper form .field label {
            position: absolute;
            top: 50%;
            left: 20px;
            color: #999999;
            font-weight: 400;
            font-size: 17px;
            pointer-events: none;
            transform: translateY(-50%);
            transition: all 0.3s ease;
        }

        form .field input:focus~label,
        form .field input:valid~label {
            top: 0%;
            font-size: 16px;
            color: #4158d0;
            background: #fff;
            transform: translateY(-50%);
        }

        form .content {
            display: flex;
            width: 100%;
            height: 50px;
            font-size: 16px;
            align-items: center;
            justify-content: space-around;
        }

        form .content {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form .content input,
        form .content select {
            width: 15px;
            height: 15px;
            background: red;
        }

        form .content label {
            color: #262626;
            user-select: none;
            padding-left: 5px;
        }

        form .content .pass-link {
            color: "";
        }

        form .field button[type="submit"] {
            color: #fff;
            border: none;
            padding-left: 0;
            margin-top: -10px;
            border-radius: 4px;
            margin-left: 130px;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
            background: linear-gradient(-135deg, #b0efeb, #fdbaf8);
            transition: all 0.3s ease;
        }

        button a {
            width: 50px;
        }

        form .field input[type="submit"]:active {
            transform: scale(0.95);
        }

        .wrapper:hover {
            transform: scale(1.1);
        }

        form .signup-link {
            text-align: center;
        }

        form .signup-link a {
            color: #3498db;
            text-decoration: none;
        }

        form .signup-link a:hover {
            text-decoration: underline;
        }

        #tablex {
            width: 50%;
            height: 50%;
            position: fixed;
            top: 20%;
            left: 25%;
            overflow-y: scroll;
            scrollbar-width: none;
        }

        #tablex::-webkit-scrollbar {
            display: none;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        #exchange {
            display: none;
            position: fixed;
            top: 80%;
            left: 40%;
            width: 160px;
            height: 50px;
            padding: 8px;
            font-size: 17px;
            color: black;
            outline: none;
            background-color: #ec8c1c;
            border-radius: 70px;
            box-shadow: 0 6px 4px rgb(000, 000, 000);
            text-align: center;
            margin: 8px 8px 8px 58px;
        }

        #exchange:hover {
            color: white;
            cursor: pointer;
            background-color: #fcb452;
        }

        #logout {
            font-size: 24px;
            text-decoration: none;
            color: #0B0080;
            cursor: pointer;
            margin-right: 50px;
        }
    </style>
    <script>
        window.onload = function() {
            var url_string = window.location.href;
            var url = new URL(url_string);
            var bloodgroup = url.searchParams.get("form");
            if (bloodgroup == "false") {
                document.getElementById("search").style.display = "none";
                document.getElementById("exchange").style.display = "block";
            }
        };
    </script>
</head>

<body>
    <h2 style="width: 100%; text-align: right;"><a id="logout" href="logout.php">Logout</a></h2>
    <div class="wrapper" id="search">
        <div class="title">Application Search</div>
        <form action="/src/php/admin.php?form=false" method="POST">
            <div class="field">
                <select name="bloodgroup" required>
                    <option value="Blood Group" selected disabled hidden>Blood Group</option>
                    <option value="O-postive">O +ve</option>
                    <option value="O-negative">O -ve</option>
                    <option value="B-postive">B +ve</option>
                    <option value="B-negative">B -ve</option>
                    <option value="A-postive">A +ve</option>
                    <option value="A-negative">A -ve</option>
                    <option value="AB-postive">AB +ve</option>
                    <option value="AB-negative">AB -ve</option>
                </select>
            </div>
            <div class="field">
                <select name="type" required>
                    <option value="donor-patient" selected disabled hidden>Donor / Patient</option>
                    <option value="donors">Donor</option>
                    <option value="patient">Patient</option>
                </select>
            </div>
            <br>
            <div class="content">
                <div class="field">
                    <button type="submit" name="search">Search</button>
                </div>
            </div>
            <br>
            <div class="signup-link">
                Want to donate? <a href="donor.php">Donate now</a>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['search'])) {
        $type = $mysqli->escape_string($_POST['type']);
        $bloodgroup = $mysqli->escape_string($_POST['bloodgroup']);
        if ($result = $mysqli->query("SELECT * FROM $type WHERE bloodgroup='$bloodgroup'") or die($mysqli->error)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<div id='tablex'><table>";
                echo "<tr style='background-color: black; color: white;'>";
                echo "<th>S.No</th>";
                echo "<th>Username</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Date & Time</th>";
                echo "<th>Patient</th>";
                echo "</tr>";
                $sno = 1;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $sno . ".</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['phonenumber'] . "</td>";
                    echo "<td>" . $row['timestamp'] . "</td>";
                    $st = $row['status'];
                    if ($row['status'] == 'pending') {
                        echo "<td style='background-color: #FF0000'>Pending</td>";
                    } else {
                        echo "<td style='background-color: #00cc00'>$st</td>";
                    }
                    echo "</tr>";
                    $sno++;
                }
                echo "</table></div>";
                mysqli_free_result($result);
            } else {
                echo "<div id='tablex'><table>";
                echo "<tr style='background-color: black; color: white;'>";
                echo "<th>S.No</th>";
                echo "<th>Username</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Date & Time</th>";
                echo "<th>Patient</th>";
                echo "</tr>";
                echo "<tr><td colspan = '5'> No records matching your query were found.</td></tr>";
                echo "</table></div>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
        }
    } ?>
    <form action=<?php echo "/src/php/approve.php?bloodgroup=$bloodgroup" ?> method="POST">
        <button id="exchange" type="submit" name="exchange">Approve</button>
    </form>

</body>

</html>