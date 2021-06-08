<?php
session_start();
if (!$_SESSION['logged_in']) {
    echo '<script>window.location.href="../../index.html";</script>';
}

$mysqli = new mysqli('localhost', 'root', '', 'blood-bank') or die($mysqli->error);

$bloodgroup = '';

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

if (isset($_GET['bloodgroup'])) {
    $bloodgroup = $_GET['bloodgroup'];
}

$donors = $mysqli->query("SELECT * FROM donors WHERE bloodgroup='$bloodgroup' AND status='pending'") or die($mysqli->error);

$patients = $mysqli->query("SELECT * FROM patient WHERE bloodgroup='$bloodgroup' AND status='pending'") or die($mysqli->error);

if (mysqli_num_rows($donors) > 0 && mysqli_num_rows($patients) > 0) {
    if (mysqli_num_rows($donors) < mysqli_num_rows($patients)) {
        while ($donor = mysqli_fetch_array($donors)) {
            $patient = mysqli_fetch_array($patients);
            $donorSNO = $donor['sno'];
            $donorID = $donor['username'];
            $patientSNO = $patient['sno']; 
            $patientID = $patient['username'];
            // $send = 'DS'.(string)$donorSNO.'DI'.$donorID.'PS'.(string)$patientSNO.'PI'.$patientID;
            $sql = "UPDATE `donors` SET status='$patientID' WHERE sno='$donorSNO'";
            $mysqli->query($sql) or die('MySQL Error: D' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')');
            $sql = "UPDATE `patient` SET status='$donorID' WHERE sno='$patientSNO'";
            $mysqli->query($sql) or die('MySQL Error: P' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')');
        }
    } else {
        while ($patient = mysqli_fetch_array($patients)) {
            $donor = mysqli_fetch_array($donors);
            $donorSNO = $donor['sno'];
            $donorID = $donor['username'];
            $patientSNO = $patient['sno']; 
            $patientID = $patient['username'];
            // $send = 'DS'.(string)$donorSNO.'DI'.$donorID.'PS'.(string)$patientSNO.'PI'.$patientID;
            $sql = "UPDATE `donors` SET status='$patientID' WHERE sno='$donorSNO'";
            $mysqli->query($sql) or die('MySQL Error: D' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')');
            $sql = "UPDATE `patient` SET status='$donorID' WHERE sno='$patientSNO'";
            $mysqli->query($sql) or die('MySQL Error: P' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')');
        }
    }
}
echo '<script>alert("Successfully Approved possible requests!");
    window.location.href="admin.php";</script>';
?>