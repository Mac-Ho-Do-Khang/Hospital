<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CVForge. Easily create, share, and manage professional CVs online. Jobseekers can build CVs using customizable templates or upload PDFs. Secure your profile with privacy options and share it with a unique URL." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="content/img/fev-icon.png" />
    <link rel="stylesheet" href="css/login.css" />
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <title>CVForge - Login</title>
</head>

<body>
    <header class="header">
        <a href="index.php?page=home" title="Return to home page">
            <img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" />
        </a>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <li><a class="header-nav-link" href="index.php?page=home" title="Return to home page">Home</a></li>
                <li>
                    <a href="index.php?page=register" class="header-nav-link call-to-action" title="Go to register page">Sign up</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="login-section">
        <div class="login-img-box">
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <div class="tile"></div>
            <!-- <div class="shadow"></div> -->
        </div>

        <form action="php/login_processing.php" method="post">
            <div class="container login">
                <label for="uname"><b>Username</b></label>
                <input class="email" id="email" type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input class="password" id="password" type="password" placeholder="Enter Password" name="password" required>
                <div class="login-btn-container">
                    <button class="btn btn-full login-btn" type="submit">Login</button>
                </div>
                <div class="below-login-btn">
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                    <div class="login-notify">
                        <?php
                        if (isset($_SESSION['login_message'])) {
                            echo $_SESSION['login_message'];
                            unset($_SESSION['login_message']);  // Clear the message after displaying it
                        }
                        ?>
                    </div>
                </div>
        </form>
        </div>
    </section>
</body>

</html>