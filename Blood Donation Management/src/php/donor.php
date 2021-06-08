<?php
session_start();
if (!$_SESSION['logged_in']) {
    echo '<script>window.location.href="../../index.html";</script>';
}

$mysqli = new mysqli('localhost', 'root', '', 'blood-bank') or die($mysqli->error);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['donate'])) {

        $name = $mysqli->real_escape_string($_POST['name']);
        $phonenumber = $mysqli->real_escape_string($_POST['phonenumber']);
        $dateofbirth = $mysqli->real_escape_string($_POST['dateofbirth']);
        $age = $mysqli->real_escape_string($_POST['age']);
        $address = $mysqli->real_escape_string($_POST['address']);
        $gender = $mysqli->real_escape_string($_POST['gender']);
        $bloodgroup = $mysqli->real_escape_string($_POST['bloodgroup']);

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
        $username = $_SESSION['username'];
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = date("Y-m-d h:i:sa");
        $sql = "SELECT * FROM donors WHERE username='$username'";
        $result = $mysqli->query($sql) or die($mysqli->error);
        if ($result->num_rows > 0) {
            $check = '';
            while ($row = mysqli_fetch_array($result)) {
                $check = $row['status'];
            }
            if ($check != 'pending') {
                $sql = "INSERT INTO `donors` (username, name, phonenumber, dateofbirth, age, address, gender, bloodgroup, timestamp, status) VALUES ('$username', '$name', '$phonenumber', '$dateofbirth', '$age', '$address', '$gender', '$bloodgroup',  '$timestamp', 'pending')";
                if ($mysqli->query($sql) or die('MySQL Error: ' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')')) {
                    echo '<script>alert("Successfully Registered!");
                    window.location.href="home.php";</script>';
                } else {
                    echo '<script>alert("Registration failed!");
                    window.location.href="home.php";</script>';
                }
            } else {
                echo '<script>alert("Your donation is still pending!");
                window.location.href="home.php";</script>';
            }
        } else {
            $sql = "INSERT INTO `donors` (username, name, phonenumber, dateofbirth, age, address, gender, bloodgroup, timestamp, status) VALUES ('$username', '$name', '$phonenumber', '$dateofbirth', '$age', '$address', '$gender', '$bloodgroup',  '$timestamp', 'pending')";
            if ($mysqli->query($sql) or die('MySQL Error: ' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')')) {
                echo '<script>alert("Successfully Registered!");
                window.location.href="home.php";</script>';
            } else {
                echo '<script>alert("Registration failed!");
                window.location.href="home.php";</script>';
            }
        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Donor form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
        html,
        body {
            min-height: 100%;
            background-image: url(https://png.pngtree.com/png-clipart/20190611/original/pngtree-cute-simple-love-blood-donation-vector-png-image_2859522.jpg);
            background-size: 200px;

        }

        body,
        div,
        form,
        input,
        select,
        p {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 16px;
            color: #eee;
        }

        body {
            background: url("/uploads/media/default/0001/01/b5edc1bad4dc8c20291c8394527cb2c5b43ee13c.jpeg") no-repeat center;
            background-size: cover;
        }

        h1,
        h2 {
            text-transform: uppercase;
            font-weight: 400;
        }

        h2 {
            margin: 0 0 0 8px;
        }

        .main-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 25px;
            background: rgba(0, 0, 0, 0.5);
        }

        .left-part,
        form {
            padding: 25px;
        }

        .left-part {
            text-align: center;
        }

        .fa-graduation-cap {
            font-size: 72px;
        }

        form {
            background: rgba(0, 0, 0, 0.7);
        }

        /* .left-part p h1 {
      } */
        .title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .info {
            display: flex;
            flex-direction: column;
        }

        input,
        select {
            padding: 5px;
            margin-bottom: 30px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #eee;
        }

        input::placeholder {
            color: #eee;
        }

        option:focus {
            border: none;
        }

        option {
            background: black;
            border: none;
        }

        .checkbox input {
            margin: 0 10px 0 0;
            vertical-align: middle;
        }

        .checkbox a {
            color: #26a9e0;
        }

        .checkbox a:hover {
            color: #8B0000;
        }

        .btn-item,
        button {
            padding: 10px 5px;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            background: #26a9e0;
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            color: #fff;
        }

        .btn-item {
            display: inline-block;
            margin: 20px 5px 0;
        }

        button {
            width: 100%;
        }

        button:hover,
        .btn-item:hover {
            background: #8B0000;
        }

        @media (min-width: 568px) {

            html,
            body {
                height: 100%;
            }

            .main-block {
                flex-direction: row;
                height: calc(100% - 50px);
            }

            .left-part,
            form {
                flex: 1;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="main-block">
        <div class="left-part">
            <i class="fas fa-graduation-cap"></i>
            <h1>Register to Donate Blood</h1>
            <p>Donate your blood for a reason, let the reason be life</p>
        </div>
        <form action="donor.php" method="POST">
            <div class="title">
                <i class="fas fa-pencil-alt"></i>
                <h2>Register here</h2>
            </div>
            <div class="info">
                <input class="fname" required type="text" name="name" placeholder="Full name">
                <input type="tel" required name="phonenumber" placeholder="Phone number">
                <input type="text" required name="dateofbirth" onblur="(this.type='text')" onfocus="(this.type='date')" placeholder="Date of Birth">
                <input type="number" required min="18" name="age" placeholder="Age">
                <input type="text" required name="address" placeholder="Address">
                <select name="gender" required>
                    <option value="" selected disabled hidden>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
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
            <div class="checkbox">
                <input type="checkbox" required name="checkbox"><span>I here by declare that I agreed to all terms and conditions and willing to donate blood.</a></span>
            </div>
            <button type="submit" name="donate">Donate</button>
        </form>
    </div>
</body>

</html>