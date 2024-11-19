<?php $_SESSION['user'] = "username"
?>
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
    <div class="dark">
        <header class="header">
            <a href="index.php?page=home" title="Return to home page">
                <img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" />
            </a>
            <nav class="header-nav">
                <ul class="header-nav-list">
                    <li><a class="header-nav-link" href="index.php?page=home" title="Return to home page">Home</a></li>
                    <li><a class="header-nav-link" href="index.php?page=myCVs" title="Go to view CVs">My CVs</a></li>
                    <li><a class="header-nav-link" href="index.php?page=add" title="Go to add CVs">Add CV</a></li>
                    <div class="user-info">
                        <ion-icon class="user-icon" name="person-circle"></ion-icon>
                        <div class="info">
                            <p><?php echo $_SESSION['user']; ?></p>
                            <p><?php echo "(user@gmail.com)" ?></p>
                            <!-- Log out button -->
                            <form action="index.php?page=login" method="post" style="display: inline;">
                                <input type="submit" value="Log out" class="logout-btn" />
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    session_unset();
                                    session_destroy();
                                    header('Location: index.php?page=login');
                                    exit();
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </ul>
            </nav>
        </header>
    </div>

    <!-- <div class="add-tabs">
        <button class="add-tablink" onclick="openPage('CV-create', this)" id="defaultOpen">Create a CV</button>
        <button class="add-tablink" onclick="openPage('CV-upload', this)">Upload a CV</button>
    </div> -->

    <section id="CV-create" class="add-tabcontent">

        <div class="CV-form-container">
            <form class="CV-form">
                <div class="CV-form-title">Primary information</div>
                <!-- Objective -->
                <div class="CV-form-part Objective">
                    <div class="CV-form-icon-label">
                        <ion-icon name="accessibility"></ion-icon>
                        <label>Objective</label>
                    </div>
                    <textarea type="text" placeholder="Lorem ipsum dolor sit amet..." required></textarea>
                </div>
                <!-- Name -->
                <div class="CV-form-part Name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="person"></ion-icon>
                        <label>Full Name</label>
                    </div>
                    <input type="text" placeholder="John M. Doe" required>
                </div>
                <!-- Job -->
                <div class="CV-form-part Job">
                    <div class="CV-form-icon-label">
                        <ion-icon name="briefcase"></ion-icon>
                        <label>Current Job</label>
                    </div>
                    <input type="text" placeholder="Graphic Designer" required>
                </div>
                <!-- Email -->
                <div class="CV-form-part Email">
                    <div class="CV-form-icon-label">
                        <ion-icon name="mail"></ion-icon>
                        <label>Email</label>
                    </div>
                    <input type="text" placeholder="john@example.com" required>
                </div>
                <!-- Phone -->
                <div class="CV-form-part Phone">
                    <div class="CV-form-icon-label">
                        <ion-icon name="call"></ion-icon>
                        <label>Phone Number</label>
                    </div>
                    <div id="phones-container">
                        <div class="with-trashbin">
                            <div class="phone-container">
                                <input type="text" placeholder="919-263-1770" required>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-phone-button">+</button>
                    </div>
                </div>
                <!-- Address -->
                <div class="CV-form-part Addresses">
                    <div class="CV-form-icon-label">
                        <ion-icon name="location"></ion-icon>
                        <label>Address</label>
                    </div>
                    <div id="addresses-container">
                        <div class="with-trashbin">
                            <div class="address-container">
                                <input type="text" placeholder="123 Any Street" required>
                                <select id="country" name="country" onchange="fetchStates()">
                                    <option value="">---Country---</option>
                                </select>
                                <select id="state" name="state" onchange="fetchCities()">
                                    <option value="">---State---</option>
                                </select>
                                <select id="city" name="city" onchange="showMap()">
                                    <option value="">---City---</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-address-button">+</button>
                    </div>
                </div>
                <!-- Skills -->
                <div class="CV-form-part Skills">
                    <div class="CV-form-icon-label">
                        <ion-icon name="settings"></ion-icon>
                        <label>Skills</label>
                    </div>
                    <div id="skills-container">
                        <div class="with-trashbin">
                            <div class="skill-container">
                                <input type="text" name="field" placeholder="Your skill">
                                <input type="number" name="start" placeholder="Years of experience" min=1 required>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-skill-button">+</button>
                    </div>
                </div>
                <!-- Educations -->
                <div class="CV-form-part Educations">
                    <div class="CV-form-icon-label">
                        <ion-icon name="school"></ion-icon>
                        <label>Education</label>
                    </div>
                    <div id="educations-container">
                        <div class="with-trashbin">
                            <div class="education-container">
                                <input type="text" name="university" placeholder="University" required>
                                <input type="text" name="major" placeholder="Major" required>
                                <input type="text" name="degree" placeholder="Degree" required>
                                <input type="text" name="gpa" placeholder="GPA" required>
                                <div class="year-container">
                                    <input type="number" name="start" placeholder="Start Year" min=1980 max=2024 required>
                                    <input type="number" name="end" placeholder="End Year" min=1980 max=2024 required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-education-button">+</button>
                    </div>
                </div>
                <!-- Experiences -->
                <div class="CV-form-part Experiences">
                    <div class="CV-form-icon-label">
                        <ion-icon name="briefcase"></ion-icon>
                        <label>Experience</label>
                    </div>
                    <div id="experiences-container">
                        <div class="with-trashbin">
                            <div class="experience-container">
                                <input type="text" name="job" placeholder="Job Title" required>
                                <input type="text" name="company" placeholder="Company" required>
                                <input type="text" name="employer" placeholder="Employer" required>
                                <div class="year-container">
                                    <input type="number" name="start" min=1980 max=2024 placeholder="Start Year" required>
                                    <input type="number" name="end" min=1980 max=2024 placeholder="End Year" required>
                                </div>
                                <textarea name="description" placeholder="Description of responsibilities" required></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-experience-button">+</button>
                    </div>
                </div>

                <div class="CV-form-title">Additional setting</div>
                <!-- Form name -->
                <div class="CV-form-part Form-name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>Form Name (Optional)</label>
                    </div>
                    <input type="text" placeholder="Untitled">
                </div>
                <!-- Password -->
                <div class="CV-form-part Name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="lock-closed"></ion-icon>
                        <label>Password (Optional)</label>
                    </div>
                    <input type="text" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>
                <!-- Allowed email -->
                <div class="CV-form-part Allowers">
                    <div class="CV-form-icon-label">
                        <ion-icon name="people"></ion-icon>
                        <label>Who can view your CV? (Optional)</label>
                    </div>
                    <div id="allowers-selector">
                        <select onchange="">
                            <option value="">---Choose one---</option>
                            <option value="1">Only me</option>
                            <option value="1">Everyone</option>
                            <option value="1">Specified</option>
                        </select>
                    </div>
                    <div id="allowers-container">
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-allower-button">+</button>
                    </div>
                </div>

                <!-- Error prompt -->
                <div class="CV-form-part form-error-notify">
                    <p>Prompt error message here.</p>
                </div>

                <div class="submit-button-wrapper">
                    <input type="submit" value="Prepare CV" class="btn btn-full">
                </div>
            </form>
        </div>

        <div class="CV-view-container">
            <!-- https://www.w3schools.com/howto/howto_js_slideshow.asp  -->
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
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
                <div class="mySlides fade">
                    <div class="CV-view" style="--color: #283618;">
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
                <div class="mySlides fade">
                    <div class="CV-view" style="--color: #9b2226;">
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
                <div class="mySlides fade">
                    <div class="CV-view" style="--color: #774936;">
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
                <div class="mySlides fade">
                    <div class="CV-view" style="--color: #343a40;">
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
                <div class="mySlides fade">
                    <div class="CV-view" style="--color: #003566;">
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

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>

            <!-- The dots/circles -->
            <div class="dots" style="text-align:center">
                <span class="dot" onclick="currentSlide(1)" style="--dot-color: #000;"></span>
                <span class="dot" onclick="currentSlide(2)" style="--dot-color: #283618;"></span>
                <span class="dot" onclick="currentSlide(3)" style="--dot-color: #9b2226;"></span>
                <span class="dot" onclick="currentSlide(3)" style="--dot-color: #774936;"></span>
                <span class="dot" onclick="currentSlide(3)" style="--dot-color: #343a40;"></span>
                <span class="dot" onclick="currentSlide(3)" style="--dot-color: #003566;"></span>
            </div>
        </div>

        <div class="create-CV-btn-wrapper">
            <button class="btn btn-full create-CV-btn">Create CV</button>
        </div>

    </section>

    <section id="CV-upload" class="add-tabcontent" style="display:none;">
        <div class="CV-upload-form-container">
            <form action="index.php?page=login" class="CV-upload-form CV-form">
                <div class="CV-form-title">Upload file</div>
                <input type="file" id="myFile" name="filename" class="CV-upload-upload">

                <div class="CV-form-title">Additional setting</div>
                <!-- Form name -->
                <div class="CV-form-part Form-name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>Form Name (Optional)</label>
                    </div>
                    <input type="text" placeholder="Untitled">
                </div>
                <!-- Password -->
                <div class="CV-form-part Name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="lock-closed"></ion-icon>
                        <label>Password (Optional)</label>
                    </div>
                    <input type="text" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>
                <!-- Allowed email -->
                <div class="CV-form-part Allowers">
                    <div class="CV-form-icon-label">
                        <ion-icon name="people"></ion-icon>
                        <label>Who can view your CV? (Optional)</label>
                    </div>
                    <div id="allowers-container">
                        <div class="allower-container">
                            <input type="text" name="field" placeholder="Email...">
                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-allower-button">+</button>
                    </div>
                </div>
                <div class="CV-upload-submit-wrapper">
                    <input type="submit" class="btn btn-full CV-upload-submit" value="Upload">
                </div>
            </form>
        </div>
    </section>

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

    <!--------------- To be seperated --------------->
    <!-- Handle the tabs  -->
    <script>
        // https://www.w3schools.com/howto/howto_js_full_page_tabs.asp
        function openPage(pageName, elmnt) {
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("add-tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the background color of all tablinks/buttons
            tablinks = document.getElementsByClassName("add-tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
                tablinks[i].style.color = "#eaeae8";
                tablinks[i].style.fontWeight = "500";
            }

            // Show the specific tab content
            document.getElementById(pageName).style.display = "block";

            // Add the specific color to the button used to open the tab content
            elmnt.style.backgroundColor = "#eaeae8";
            elmnt.style.color = "#0D1B2A";
            elmnt.style.fontWeight = "600";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>

    <!-- Dynamically add phones  -->
    <script>
        const add_phone_button = document.getElementById('add-phone-button');
        const phones_container = document.getElementById('phones-container');

        add_phone_button.addEventListener('click', () => {
            const newInputWrapper = document.createElement('div');
            newInputWrapper.classList.add('with-trashbin');
            const phoneContainer = document.createElement('div');
            phoneContainer.classList.add('phone-container');

            const phoneInput = document.createElement('input');
            phoneInput.type = 'text';
            phoneInput.placeholder = '919-263-1770';
            phoneInput.required = true;

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                phones_container.removeChild(newInputWrapper);
            });

            // Append input and trash icon to their respective containers
            phoneContainer.appendChild(phoneInput);
            newInputWrapper.appendChild(phoneContainer);
            newInputWrapper.appendChild(trashIcon);
            // Append the new input wrapper to the phones container
            phones_container.appendChild(newInputWrapper);
        });
    </script>
    <!-- Dynamically add addresses  -->
    <script>
        const add_address_button = document.getElementById('add-address-button');
        const addresses_container = document.getElementById('addresses-container');

        add_address_button.addEventListener('click', () => {
            const newAddressWrapper = document.createElement('div');
            newAddressWrapper.classList.add('with-trashbin');
            const addressContainer = document.createElement('div');
            addressContainer.classList.add('address-container');

            const addressInput = document.createElement('input');
            addressInput.type = 'text';
            addressInput.placeholder = '123 Any Street';
            addressInput.required = true;

            const countrySelect = document.createElement('select');
            countrySelect.name = 'country';
            // countrySelect.onchange = fetchStates;
            countrySelect.innerHTML = `<option value="">---Country---</option>`;

            const stateSelect = document.createElement('select');
            stateSelect.name = 'state';
            // stateSelect.onchange = fetchCities;
            stateSelect.innerHTML = `<option value="">---State---</option>`;

            const citySelect = document.createElement('select');
            citySelect.name = 'city';
            // citySelect.onchange = showMap;
            citySelect.innerHTML = `<option value="">---City---</option>`;

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                addresses_container.removeChild(newAddressWrapper);
            });

            // Append all elements to their respective containers
            addressContainer.appendChild(addressInput);
            addressContainer.appendChild(countrySelect);
            addressContainer.appendChild(stateSelect);
            addressContainer.appendChild(citySelect);
            newAddressWrapper.appendChild(addressContainer);
            newAddressWrapper.appendChild(trashIcon);
            // Append the new address wrapper to the addresses container
            addresses_container.appendChild(newAddressWrapper);
        });
    </script>
    <!-- Dynamically add skills  -->
    <script>
        const add_skill_button = document.getElementById('add-skill-button');
        const skills_container = document.getElementById('skills-container');

        add_skill_button.addEventListener('click', () => {
            const newSkillWrapper = document.createElement('div');
            newSkillWrapper.classList.add('with-trashbin');
            const skillContainer = document.createElement('div');
            skillContainer.classList.add('skill-container');

            const skillInput = document.createElement('input');
            skillInput.type = 'text';
            skillInput.name = 'field';
            skillInput.placeholder = 'Your skill';

            const experienceInput = document.createElement('input');
            experienceInput.type = 'number';
            experienceInput.min = 1;
            experienceInput.name = 'start';
            experienceInput.placeholder = 'Years of experience';
            experienceInput.required = true;

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                skills_container.removeChild(newSkillWrapper);
            });

            skillContainer.appendChild(skillInput);
            skillContainer.appendChild(experienceInput);
            newSkillWrapper.appendChild(skillContainer);
            newSkillWrapper.appendChild(trashIcon);
            skills_container.appendChild(newSkillWrapper);
        });
    </script>
    <!-- Dynamically add educations  -->
    <script>
        const add_education_button = document.getElementById('add-education-button');
        const educations_container = document.getElementById('educations-container');

        add_education_button.addEventListener('click', () => {
            const newEducationWrapper = document.createElement('div');
            newEducationWrapper.classList.add('with-trashbin');
            const educationContainer = document.createElement('div');
            educationContainer.classList.add('education-container');

            const universityInput = document.createElement('input');
            universityInput.type = 'text';
            universityInput.name = 'university';
            universityInput.placeholder = 'University Name';
            universityInput.required = true;

            const degreeInput = document.createElement('input');
            degreeInput.type = 'text';
            degreeInput.name = 'degree';
            degreeInput.placeholder = 'Degree';
            degreeInput.required = true;

            const majorInput = document.createElement('input');
            majorInput.type = 'text';
            majorInput.name = 'major';
            majorInput.placeholder = 'Major';
            majorInput.required = true;

            const gpaInput = document.createElement('input');
            gpaInput.type = 'text';
            gpaInput.name = 'gpa';
            gpaInput.placeholder = 'GPA';
            gpaInput.required = true;

            const yearContainer = document.createElement('div');
            yearContainer.classList.add('year-container');

            const startYearInput = document.createElement('input');
            startYearInput.type = 'number';
            startYearInput.name = 'start';
            startYearInput.min = 1980;
            startYearInput.max = 2024;
            startYearInput.placeholder = 'Start Year';
            startYearInput.required = true;

            const endYearInput = document.createElement('input');
            endYearInput.type = 'number';
            endYearInput.name = 'end';
            endYearInput.min = 1980;
            endYearInput.max = 2024;
            endYearInput.placeholder = 'End Year';
            endYearInput.required = true;

            yearContainer.appendChild(startYearInput);
            yearContainer.appendChild(endYearInput);

            educationContainer.appendChild(universityInput);
            educationContainer.appendChild(majorInput);
            educationContainer.appendChild(degreeInput);
            educationContainer.appendChild(gpaInput);
            educationContainer.appendChild(yearContainer);

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                educations_container.removeChild(newEducationWrapper);
            });

            newEducationWrapper.appendChild(educationContainer);
            newEducationWrapper.appendChild(trashIcon);
            educations_container.appendChild(newEducationWrapper);
        });
    </script>
    <!-- Dynamically add experiences  -->
    <script>
        const add_experience_button = document.getElementById('add-experience-button');
        const experiences_container = document.getElementById('experiences-container');

        add_experience_button.addEventListener('click', () => {
            const newExperienceWrapper = document.createElement('div');
            newExperienceWrapper.classList.add('with-trashbin');
            const experienceContainer = document.createElement('div');
            experienceContainer.classList.add('experience-container');

            const jobInput = document.createElement('input');
            jobInput.type = 'text';
            jobInput.name = 'job';
            jobInput.placeholder = 'Job Title';
            jobInput.required = true;

            const companyInput = document.createElement('input');
            companyInput.type = 'text';
            companyInput.name = 'company';
            companyInput.placeholder = 'Company';
            companyInput.required = true;

            const employerInput = document.createElement('input');
            employerInput.type = 'text';
            employerInput.name = 'employer';
            employerInput.placeholder = 'Employer';
            employerInput.required = true;

            const yearContainer = document.createElement('div');
            yearContainer.classList.add('year-container');

            const startYearInput = document.createElement('input');
            startYearInput.type = 'number';
            startYearInput.name = 'start';
            startYearInput.placeholder = 'Start Year';
            startYearInput.min = 1980;
            startYearInput.max = 2024;
            startYearInput.required = true;

            const endYearInput = document.createElement('input');
            endYearInput.type = 'number';
            endYearInput.name = 'end';
            endYearInput.placeholder = 'End Year';
            endYearInput.min = 1980;
            endYearInput.max = 2024;
            endYearInput.required = true;

            yearContainer.appendChild(startYearInput);
            yearContainer.appendChild(endYearInput);

            const descriptionTextarea = document.createElement('textarea');
            descriptionTextarea.name = 'description';
            descriptionTextarea.placeholder = 'Description of responsibilities';
            descriptionTextarea.rows = 3;
            descriptionTextarea.required = true;

            experienceContainer.appendChild(jobInput);
            experienceContainer.appendChild(companyInput);
            experienceContainer.appendChild(employerInput);
            experienceContainer.appendChild(yearContainer);
            experienceContainer.appendChild(descriptionTextarea);

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                experiences_container.removeChild(newExperienceWrapper);
            });

            newExperienceWrapper.appendChild(experienceContainer);
            newExperienceWrapper.appendChild(trashIcon);
            experiences_container.appendChild(newExperienceWrapper);
        });
    </script>
    <!-- Dynamically add allowers  -->
    <script>
        const add_allower_button = document.getElementById('add-allower-button');
        const allowers_container = document.getElementById('allowers-container');

        add_allower_button.addEventListener('click', () => {
            const newAllowerWrapper = document.createElement('div');
            newAllowerWrapper.classList.add('with-trashbin');
            const allowerContainer = document.createElement('div');
            allowerContainer.classList.add('allower-container');

            const emailInput = document.createElement('input');
            emailInput.type = 'text';
            emailInput.name = 'field';
            emailInput.placeholder = 'Email...';

            allowerContainer.appendChild(emailInput);

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                allowers_container.removeChild(newAllowerWrapper);
            });

            newAllowerWrapper.appendChild(allowerContainer);
            newAllowerWrapper.appendChild(trashIcon);
            allowers_container.appendChild(newAllowerWrapper);
        });
    </script>

    <!-- Slideshow  -->
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
    <!-- Multilevel dependent dropdown menu  -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const geonamesUsername = "xitrumbumbum"; // Replace with your free GeoNames username

        let mapInitialized = false; // Flag to check if the map has been initialized

        async function fetchCountries() {
            try {
                const response = await fetch(`http://api.geonames.org/countryInfoJSON?username=${geonamesUsername}`);
                const data = await response.json();
                const countrySelect = document.getElementById("country");
                countrySelect.innerHTML = '<option value="">---Country---</option>';
                data.geonames.forEach(country => {
                    countrySelect.innerHTML += `<option value="${country.geonameId}">${country.countryName}</option>`;
                });
            } catch (error) {
                console.error("Error fetching countries:", error);
            }
        }

        async function fetchStates() {
            const countryId = document.getElementById("country").value;
            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");
            stateSelect.innerHTML = '<option value="">---State---</option>';
            citySelect.innerHTML = '<option value="">---City---</option>';
            if (!countryId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${countryId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.geonameId}">${state.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching states:", error);
            }
        }

        async function fetchCities() {
            const stateId = document.getElementById("state").value;
            const citySelect = document.getElementById("city");
            citySelect.innerHTML = '<option value="">---City---</option>';
            if (!stateId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${stateId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.lat},${city.lng}">${city.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching cities:", error);
            }
        }

        // Initialize
        fetchCountries();
    </script>
    <!-- Visibility -->
    <script>
        const selector = document.querySelector("#allowers-selector select");
        const allowersContainer = document.getElementById("allowers-container");
        const addButtonWrapper = document.querySelector(".Allowers .add-button-wrapper");

        // Initially hide the elements
        allowersContainer.style.display = "none";
        addButtonWrapper.style.display = "none";

        // Add an event listener for the change event
        selector.addEventListener("change", function() {
            if (selector.value === "1" && selector.options[selector.selectedIndex].text === "Specified") {
                // Show the elements when "Specified" is selected
                allowersContainer.style.display = "block";
                addButtonWrapper.style.display = "flex";
            } else {
                // Hide the elements otherwise
                allowersContainer.style.display = "none";
                addButtonWrapper.style.display = "none";
            }
        });
    </script>
    <!----------------------------------------------->
</body>

</html>