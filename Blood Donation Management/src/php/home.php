<?php
session_start();
if (!$_SESSION['logged_in']) {
    echo '<script>window.location.href="../../index.html";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/css/utilities.css">
    <link rel="stylesheet" href="/src/css/style.css">
    <title>Home Page</title>
</head>

<body>
    <header class="hero">
        <div class="navbar" id="navbar top">
            <h1 class="logo">
                <span class="text-primary"><i class="fas fa-book-open"></i> Blood</span>Donation
            </h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="about-us.php">About us</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>

        <div class="content">
            <h1>Every drop counts. Donate Your blood today!</h1>
            <a href="#donor" class="btn btn-primary" style="margin-top: 15px;">Get Started</a>
        </div>
    </header>

    <main>
        <section class="solutions flex-columns">
            <div class="row">
                <div class="column">
                    <div class="column1">
                        <img src="https://media.istockphoto.com/vectors/donate-blood-concept-with-blood-bag-and-heart-blood-donation-vector-vector-id1033906526?k=6&m=1033906526&s=612x612&w=0&h=9lAnC-__u0NM2Ua2J1PSsHE4JjXKE7sYECfed8QeYMY=" alt="Picture comes here">
                    </div>
                </div>
                <div class="column">
                    <div id="donor" class="column2 bg-primary">
                        <h2>Be a Blood Donor Now</h2>
                        <p>Blood is one of the essential fluid in our body, which helps the body to function smoothly.
                            Blood Donation is an act of donating healthy blood to needy people. Due to excessive loss of
                            blood, a person may die. Therefore, we can say that blood donation is an act of saving
                            lives.</p>
                        <a href="donor.php" class="btn btn-outline">
                            <i class="fas fa-chevron"></i>
                            Donate Now
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="solutions flex-columns">
            <div class="row">
                <div class="column">
                    <div class="column1">
                        <img src="https://cdn-b.medlife.com/2018/06/blood-donor-day.png" alt="">
                    </div>
                </div>
                <div class="column">
                    <div class="column2 bg-primary">
                        <h2>You can request blood here</h2>
                        <p>Simply fill out the form to request the blood group you need. The donor information for each
                            blood group will be shown.</p>
                        <a href="patient.php" class="btn btn-outline">
                            <i class="fas fa-chevron"></i>
                            Request now
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="solutions flex-columns">
            <div class="row">
                <div class="column">
                    <div class="column1">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRruysqWob6-SesIvvAbLdivy84Ho2wRGr4GwTZwG73cUCMXHTuG0_1KPJJdKWzDg2JtxQ&usqp=CAU" alt="">
                    </div>
                </div>
                <div class="column">
                    <div class="column2 bg-primary">
                        <h2>Blood Bank</h2>
                        <p>On this blood bank page, you can see how many donors in each blood type are present, as well
                            as their contact information.</p>
                        <a href="bloodbank.php" class="btn btn-outline">
                            <i class="fas fa-chevron"></i>
                            Here it goes.
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>