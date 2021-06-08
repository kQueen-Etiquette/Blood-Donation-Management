<?php
session_start();
if (!$_SESSION['logged_in']) {
    echo '<script>window.location.href="../../index.html";</script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>About us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .column {
            float: left;
            width: 33%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 8px;
        }

        .about-section {
            padding: 20px;
            text-align: center;
            background-color: #474e5d;
            color: white;
        }

        .container {
            padding: 0 16px;
        }

        .container::after,
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .title {
            color: grey;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            background-color: #555;
        }

        @media screen and (max-width: 650px) {
            .column {
                width: 100%;
                display: block;
            }
        }

        #social {
            display: flex;
            list-style: none;
            margin-left: -35px;
        }

        #social a {
            font-size: 24px;
            text-decoration: none;
            color: #0B0080;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center">Our Team</h2>
    <div class="row">
        <div class="column">
            <div class="card">
                <img src="../assets/Sneha.jpeg" alt="Sneha" style="width:100%" style="height:50%">
                <div class="container">
                    <h2>Sneha</h2>
                    <p class="title">Designer</p>
                    <ul id="social">
                        <li><a class="fa fa-envelope" href="mailto:snehatejasreereddy_thondapu@srmap.edu.in" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-facebook" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-twitter" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-github" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-linkedin" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-instagram" href="https://www.instagram.com/sneha_thondapu/" target="_blank">&nbsp;</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <img src="../assets/Phani.jpeg" alt="Phani" style="width:100%" style="height:50%">
                <div class="container">
                    <h2>Phani Bhushan</h2>
                    <p class="title">Back-end Developer</p>
                    <ul id="social">
                        <li><a class="fa fa-envelope" href="mailto:madaphani16@gmail.com" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-facebook" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-twitter" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-github" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-linkedin" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-instagram" href="https://www.instagram.com/phaniiiiiii._/" target="_blank">&nbsp;</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <img src="../assets/Lahari.jpeg" alt="Lahari" style="width:100%" style="height:50%">
                <div class="container">
                    <h2>Lahari</h2>
                    <p class="title">Front-end Developer</p>
                    <ul id="social">
                        <li><a class="fa fa-envelope" href="mailto:srilahari_nori@srmap.edu.in" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-facebook" href="https://www.facebook.com/sreelusivani07" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-twitter" href="#" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-github" href="https://github.com/kQueen-Etiquette" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-linkedin" href="https://www.linkedin.com/in/nori-srilahari-sivanvitha-16259a1b1/" target="_blank">&nbsp;</a></li>
                        <li><a class="fa fa-instagram" href="https://www.instagram.com/kqueen.etiquette/" target="_blank">&nbsp;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="about-section">
        <h1>About Us Page</h1>
        <p>Some text about who we are and what we do.</p>
        <p>Currently we are pursuing our Under Graduation at SRMAP. We did this website as a part of our course project. </p>
    </div>
</body>

</html>