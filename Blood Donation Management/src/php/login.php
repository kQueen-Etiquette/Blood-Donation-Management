<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'blood-bank') or die($mysqli->error);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $username = $mysqli->escape_string($_POST['username']);
        if ($_POST['username'] == "admin" && md5($_POST['password']) == "98f38d4bbf62757f778422344636ec54") {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['logged_in'] = true;
            echo '<script>alert("Logged in!");
            window.location.href="admin.php";</script>';
        } else {
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
            $result = $mysqli->query("SELECT *FROM `users` WHERE `username` = '$username'");
            if ($result->num_rows == 0) {
                session_unset();
                session_destroy();
                echo '<script>alert("User does not exists!");
                window.location.href="../../index.html";</script>';
            } else {
                $user = $result->fetch_assoc();
                if (md5($_POST['password']) == $user['password']) {
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $username;
                    $_SESSION['logged_in'] = true;
                    echo '<script>alert("Logged in!");
                    window.location.href="home.php";</script>';
                } else {
                    session_unset();
                    session_destroy();
                    echo '<script>alert("You have entered wrong password, try again!");
                    window.location.href="../../index.html";</script>';
                }
            }
        }
    }
}

?>