<?php
session_start();
if (!$_SESSION['logged_in']) {
    echo '<script>window.location.href="../../index.html";</script>';
}

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

$OpostiveD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='O-postive'"));
$OnegativeD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='O-negative'"));
$BpostiveD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='B-postive'"));
$BnegativeD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='B-negative'"));
$ApostiveD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='A-postive'"));
$AnegativeD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='A-negative'"));
$ABpostiveD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='AB-postive'"));
$ABnegativeD = mysqli_num_rows($mysqli->query("SELECT * FROM donors WHERE bloodgroup='AB-negative'"));

$OpostiveP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='O-postive'"));
$OnegativeP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='O-negative'"));
$BpostiveP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='B-postive'"));
$BnegativeP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='B-negative'"));
$ApostiveP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='A-postive'"));
$AnegativeP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='A-negative'"));
$ABpostiveP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='AB-postive'"));
$ABnegativeP = mysqli_num_rows($mysqli->query("SELECT * FROM patient WHERE bloodgroup='AB-negative'"));

echo "<div id='tablex'><table>";
echo "<tr style='background-color: black; color: white;'>";
echo "<th>Blood Group</th>";
echo "<th>Donors</th>";
echo "<th>Patients</th>";
echo "</tr>";
echo "<tr>";
echo "<td>O +ve</td>";
echo "<td>" . $OpostiveD . "</td>";
echo "<td>" . $OpostiveP . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>O -ve</td>";
echo "<td>" . $OnegativeD . "</td>";
echo "<td>" . $OnegativeP . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>B +ve</td>";
echo "<td>" . $BpostiveD . "</td>";
echo "<td>" . $BpostiveP . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>B -ve</td>";
echo "<td>" . $BnegativeD . "</td>";
echo "<td>" . $BnegativeP . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>A + ve</td>";
echo "<td>" . $ApostiveD . "</td>";
echo "<td>" . $ApostiveP . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>A -ve</td>";
echo "<td>" . $AnegativeD . "</td>";
echo "<td>" . $AnegativeP . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>AB +ve</td>";
echo "<td>" . $ABpostiveD . "</td>";
echo "<td>" . $ABpostiveP . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>AB -ve</td>";
echo "<td>" . $ABnegativeD . "</td>";
echo "<td>" . $ABnegativeP . "</td>";
echo "</tr>";
echo "</table></div>";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html,
        body {
            display: grid;
            height: 100%;
            width: 100%;
            place-items: center;
            /*background: linear-gradient(-150deg, #8ab6d6, #f8f5f1);*/
            background: linear-gradient(-150deg, #dddddd, #DC143C);
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
    </style>
</head>

<body>

</body>

</html>