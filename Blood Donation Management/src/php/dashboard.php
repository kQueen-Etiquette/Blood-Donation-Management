<?php
session_start();
if (!$_SESSION['logged_in']) {
    echo '<script>window.location.href="../../index.html";</script>';
}

$username = $_SESSION['username'];

$mysqli = new mysqli('localhost', 'root', '', 'blood-bank') or die($mysqli->error);

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
    <title>Dashboard</title>

    <style>
        html,
        body {
            height: 99.2%;
            width: 99.7%;
            /* background: linear-gradient(#09f75c, #eef276) */
            /* background: rgb(238,174,202);
            background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(238,242,118,1) 100%); */
            background: linear-gradient(-150deg, #dddddd, #DC143C);

            /* background-image: radial-gradient(circle, #ffffff, #efe7ff, #e4cdfd, #dfb2f6, #de94eb); */
        }

        .selector {
            width: 49%;
            height: 50px;
            font-size: 35px;
            text-align: center;
            display: inline-block;
            cursor: pointer;
        }

        .green {
            background-color: #aad8d3;
        }

        .blue {
            background-color: #f6e6e4;
        }

        #tablex {
            width: 50%;
            height: 50%;
            position: fixed;
            top: 30%;
            left: 28%;
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
    </style>
    <script>
        function change(val) {
            if (val == "donation") {
                document.getElementById("donation").classList.add("green");
                document.getElementById("donation").classList.remove("blue");
                document.getElementById("request").classList.remove("green");
                document.getElementById("request").classList.add("blue");
                document.getElementById("donortable").style.display = "block";
                document.getElementById("requesttable").style.display = "none";
            }
            if (val == "request") {
                document.getElementById("request").classList.add("green");
                document.getElementById("donation").classList.add("blue");
                document.getElementById("donation").classList.remove("green");
                document.getElementById("request").classList.remove("blue");
                document.getElementById("donortable").style.display = "none";
                document.getElementById("requesttable").style.display = "block";
            }
        }
    </script>


</head>

<body>
    <h2 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">You can verify your donation/request status here</h2>
    <h2 style="width: 95%; text-align: right;"><?php echo 'Hello, ' . $_SESSION['username']; ?></h2>
    <div style="width: 100%;">
        <p><span id="donation" onclick="change(this.id)" class="selector green">Donation Details</span>&nbsp;<span id="request" onclick="change(this.id)" class="selector blue">Request Details</span></p>
    </div>
    <div id="donortable">
        <?php
        if ($result = $mysqli->query("SELECT * FROM donors WHERE username='$username'") or die($mysqli->error)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<div id='tablex'><table>";
                echo "<tr style='background-color: black; color: white;'>";
                echo "<th>S.No</th>";
                echo "<th>Date & Time</th>";
                echo "<th>Patient</th>";
                echo "</tr>";
                $sno = 1;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $sno . ".</td>";
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
                echo "<th>Date & Time</th>";
                echo "<th>Patient</th>";
                echo "</tr>";
                echo "<tr><td colspan = '3'> No records matching your query were found.</td></tr>";
                echo "</table></div>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
        }
        ?>
    </div>
    <div id="requesttable" style="display: none;">
        <?php
        if ($result = $mysqli->query("SELECT * FROM patient WHERE username='$username'") or die($mysqli->error)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<div id='tablex'><table>";
                echo "<tr style='background-color: black; color: white;'>";
                echo "<th>S.No</th>";
                echo "<th>Date & Time</th>";
                echo "<th>Donor</th>";
                echo "</tr>";
                $sno = 1;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $sno . ".</td>";
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
                echo "<th>Date & Time</th>";
                echo "<th>Donor</th>";
                echo "</tr>";
                echo "<tr><td colspan = '3'> No records matching your query were found.</td></tr>";
                echo "</table></div>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
        }
        ?>
    </div>
</body>

</html>