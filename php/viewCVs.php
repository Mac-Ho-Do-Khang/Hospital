<?php $_SESSION['user'] = "viewer"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CVForge. Easily create, share, and manage professional CVs online. Jobseekers can build CVs using customizable templates or search PDFs. Secure your profile with privacy options and share it with a unique URL." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="content/img/fev-icon.png" />
    <link rel="stylesheet" href="css/viewCVs.css" />
    <link rel="stylesheet" href="css/add.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <script
        type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script
        nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
                <li><a class="header-nav-link" href="index.php?page=viewCVs" title="Go to view CVs">View CVs</a></li>
                <div class="user-info">
                    <ion-icon class="user-icon" name="person-circle"></ion-icon>
                    <div class="info">
                        <p><?php echo $_SESSION['user']; ?></p>
                        <p><?php echo "(user@gmail.com)" ?></p>
                        <!-- Log out button -->
                        <search action="index.php?page=login" method="post" style="display: inline;">
                            <input type="submit" value="Log out" class="logout-btn" />
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                session_unset();
                                session_destroy();
                                header('Location: index.php?page=login');
                                exit();
                            }
                            ?>
                        </search>
                    </div>
                </div>
            </ul>
        </nav>
    </header>

    <div class="CV-search-container">
        <form class="CV-search">
            <!-- Password -->
            <div class="CV-search-part Name">
                <div class="CV-search-icon-label">
                    <ion-icon name="lock-closed"></ion-icon>
                    <label>Password</label>
                </div>
                <input type="text" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
            </div>
            <!-- Submit button -->
            <div class="submit-button-wrapper">
                <input type="submit" value="Search" class="btn btn-full">
            </div>
            <!-- Error prompt -->
            <div class="CV-form-part form-error-notify">
                <p>Prompt error message here.</p>
            </div>
        </form>
    </div>
    <div class="CV-view-search">
        <div class="CV-view" style="--color: #000;">
            <div class=" CV-avatar">
                <img src="content/img/customers/customer-alice.jpg" />
            </div>
            <div class="CV-name-job">
                <div class="name">Isabel Schumacher</div>
                <div class="job">Graphic Designers</div>
            </div>

            <div class="CV-personal-information">
                <div class="objective">
                    <div class="CV-icon-title">
                        <ion-icon name="accessibility"></ion-icon>
                        <span class="title">Objective</span>
                    </div>
                    <div class="details">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia expedita, aut et illum quas atque impedit ad ex dolore voluptatem. Corrupti, iusto praesentium!
                    </div>
                </div>
                <div class="contact">
                    <div class="CV-icon-title">
                        <ion-icon name="bookmark"></ion-icon>
                        <span class="title">Contact</span>
                    </div>
                    <div class="details">
                        <ion-icon name="mail"></ion-icon>
                        <p>schumacher@example.com</p>
                        <ion-icon name="call"></ion-icon>
                        <p>+919-263-1770</p>
                        <ion-icon name="location"></ion-icon>
                        <p>123 Any Street</p>
                    </div>
                </div>
                <div class="skills">
                    <div class="CV-icon-title">
                        <ion-icon name="settings"></ion-icon>
                        <span class="title">Skills</span>
                    </div>
                    <div class="details">
                        <ul>
                            <li>Web design &mdash; 4 years</li>
                            <li>Branding &mdash; 2 years</li>
                            <li>Marketing &mdash; 2 years</li>
                            <li>SEO &mdash; 1 year</li>
                        </ul>
                    </div>
                </div>
                <div class="reference">
                    <div class="CV-icon-title">
                        <ion-icon name="attach"></ion-icon>
                        <span class="title">Reference</span>
                    </div>
                    <div class="details">
                        <ion-icon name="mail"></ion-icon>
                        <p>schumacher@example.com</p>
                        <ion-icon name="call"></ion-icon>
                        <p>+919-263-1770</p>
                    </div>
                </div>
                <div class="addition">
                    <div class="CV-icon-title">
                        <ion-icon name="information-circle"></ion-icon>
                        <span class="title">Additional information</span>
                    </div>
                    <div class="details">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam nemo ullam labore facere vero ipsa.
                    </div>
                </div>
            </div>

            <div class="CV-personal-progress">

                <div class="personal-educations">
                    <div class="CV-icon-title">
                        <ion-icon name="school"></ion-icon>
                        <span class="title">Education</span>
                    </div>
                    <div class="personal-education">
                        <div class="vertical-line">
                            <div class="line"></div>
                        </div>
                        <div class="years">(2011-2015)</div>
                        <div class="university">Wardiere University</div>
                        <div class="major">Computer Science</div>
                        <div class="degree">Bachelor of Design</div>
                        <div class="gpa">3.74</div>
                    </div>
                    <div class="personal-education">
                        <div class="vertical-line">
                            <div class="line"></div>
                        </div>
                        <div class="years">(2015-2019)</div>
                        <div class="university">Wardiere University</div>
                        <div class="major">Computer Science</div>
                        <div class="degree">Bachelor of Design</div>
                        <div class="gpa">3.65</div>
                    </div>
                </div>

                <div class="personal-experiences">
                    <div class="CV-icon-title">
                        <ion-icon name="briefcase"></ion-icon>
                        <span class="title">Experience</span>
                    </div>
                    <div class="personal-experience">
                        <div class="vertical-line">
                            <div class="line"></div>
                        </div>
                        <div class="years">(2017-2019)</div>
                        <div class="job">Junior graphic designer</div>
                        <div class="company">Iarana, inc</div>
                        <div class="employer">Dr. Robert J. Kelly</div>
                        <ul class="achievement">
                            <li>create more than 100 graphic designs for big companies</li>
                            <li>complete a lot of complicated work</li>
                        </ul>
                    </div>
                    <div class="personal-experience">
                        <div class="vertical-line">
                            <div class="line"></div>
                        </div>
                        <div class="years">(2020-2024)</div>
                        <div class="job">Senior graphic designer</div>
                        <div class="company">Fauget studio</div>
                        <div class="employer">Michael Andison</div>
                        <ul class="achievement">
                            <li>create more than 200 graphic designs for big companies</li>
                            <li>complete a lot of complicated work</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div
            class="grid-container"
            style="--column: 5; --c-gap: 6.4rem; --r-gap: 9.6rem">
            <!------------ Logo ------------>
            <div class="logo-section">
                <a href="#" title="Return to the beginning of home page"><img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" /></a>
                <ul class="social-networks">
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-facebook"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-tiktok"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-skype"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-discord"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-twitter"></ion-icon></a>
                    </li>
                </ul>
                <p class="copyright">
                    Copyright &copy; by Group 1, Inc. All rights reserved.
                </p>
            </div>
            <!------------ Contacts ------------>
            <div class="contacts">
                <p class="footer-heading">Contact us</p>
                <ul class="footer-nav">
                    <li class="address">
                        268 Ly Thuong Kiet Street, Ward 14, District 10, HCMC
                    </li>
                    <li><a href="tel:919-263-1770">2252297</a></li>
                    <li>
                        <a href="mailto:XiTrumbumbum@cvforge.com">khang.mackhang@hcmut.edu.vn</a>
                    </li>
                </ul>
            </div>
            <!------------ Company ------------>
            <nav>
                <p class="footer-heading">Company</p>
                <ul class="footer-nav">
                    <li><a href="#" title="Return to the beginning of home page">About CVForge</a></li>
                    <li><a href="#" title="Return to the beginning of home page">For Businesses</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Celestial Partners</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Careers</a></li>
                </ul>
            </nav>
            <!------------ Account ------------>
            <nav>
                <p class="footer-heading">Account</p>
                <ul class="footer-nav">
                    <li><a href="#" title="Return to the beginning of home page">Create account</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Sign in</a></li>
                    <li><a href="#" title="Return to the beginning of home page">iOS app</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Android app</a></li>
                </ul>
            </nav>
            <!------------ Resources ------------>
            <nav>
                <p class="footer-heading">Resources</p>
                <ul class="footer-nav">
                    <li><a href="#" title="Return to the beginning of home page">CV Directory</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Help Center</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Privacy & Terms</a></li>
                </ul>
            </nav>
        </div>
    </footer>
</body>

</html>