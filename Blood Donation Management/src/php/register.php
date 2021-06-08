<?php
$mysqli = new mysqli('localhost', 'root', '', 'blood-bank') or die($mysqli->error);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $username = $mysqli->real_escape_string($_POST['username']);
        if ($username != "admin") {
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = $mysqli->escape_string(md5($_POST['password']));
            if ($_POST['password'] == $_POST['cpassword']) {
                $password = $mysqli->escape_string(md5($_POST['password']));
                $mysqli->query(
                    "CREATE TABLE IF NOT EXISTS `users`
                    (
                        `sno` int(11) NOT NULL AUTO_INCREMENT,
                        `username` varchar(20) NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `password` varchar(32) NOT NULL,
                        PRIMARY KEY (`sno`)
                    )DEFAULT CHARSET = utf8;"
                ) or die('MySQL Error: ' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')');

                $result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error);
                if ($result->num_rows > 0) {
                    echo '<script>alert("E-mail already exists!");
                    window.location.href="../../index.html";</script>';
                } else {
                    $result = $mysqli->query("SELECT * FROM users WHERE username='$username'") or die($mysqli->error);
                    if ($result->num_rows > 0) {
                        echo '<script>alert("User already exists!");
                    window.location.href="../../index.html";</script>';
                    } else {
                        $sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$password')";
                        if ($mysqli->query($sql) or die('MySQL Error: ' . mysqli_error($mysqli) . ' (' . mysqli_errno($mysqli) . ')')) {
                            echo '<script>alert("Successfully Registered! Please login to continue!");
                            window.location.href="../../index.html";</script>';
                        } else {
                            echo '<script>alert("Registration failed!");
                            window.location.href="../../index.html";</script>';
                        }
                    }
                }
            } else {
                echo '<script>alert("Passwords did not match!");
                window.location.href="../../index.html";</script>';
            }
        } else {
            echo '<script>alert("Invalid Username!");
            window.location.href="../../index.html";</script>';
        }
    }
}
?>