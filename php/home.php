<?php
include("database.php");
session_start();
?>
<!-- Change the value to view the page as different roles, as specified in line 41 -->

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
  <link rel="stylesheet" href="css/style.css" />
  <script
    defer
    src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
  <title>Hospital - Amazing good job 10 points!!!</title>
  <script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
  <section class="hero-section">
    <div class="dark">
      <header class="header">
        <a href="index.php?page=home" title="Return to home page"><img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" /></a>
        <nav class="header-nav">
          <ul class="header-nav-list">
            <li><a class="header-nav-link" href="index.php?page=home" title="Return to home page">Home</a></li>
            <?php if (!isset($_SESSION['role'])): ?> <!----- Header when not logged in------>
              <li><a class="header-nav-link" href="index.php?page=login" title="Go to login page">Login</a></li>
              <li>
                <a href="index.php?page=register" class="header-nav-link call-to-action" title="Go to register page">Sign up</a>
              </li>
            <?php elseif ($_SESSION['role'] == "Admin"): ?> <!----- Header when logged in as an admin ----->
              <li><a class="header-nav-link" href="index.php?page=patients">Patients</a></li>
              <li><a class="header-nav-link" href="#">Employees</a></li>
              <li><a class="header-nav-link" href="#">Departments</a></li>
              <div class="user-info">
                <ion-icon class="user-icon" name="person-circle"></ion-icon>
                <div class="info">
                  <p><?php echo $_SESSION['name']; ?></p>
                  <p><?php echo "(" . $_SESSION['user'] . ")"; ?></p>
                  <!-- Log out button -->
                  <form method="post" style="display: inline;">
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
            <?php else: ?> <!----- Header when logged in NOT as an admin ----->
              <li><a class="header-nav-link" href="index.php?page=patients">Patients</a></li>
              <li><a class="header-nav-link" href="#">Employees</a></li>
              <li><a class="header-nav-link" href="#">Departments</a></li>
              <div class="user-info">
                <ion-icon class="user-icon" name="person-circle"></ion-icon>
                <div class="info">
                  <p><?php echo $_SESSION['name']; ?></p>
                  <p><?php echo "(" . $_SESSION['user'] . ")"; ?></p>
                  <!-- Log out button -->
                  <form method="post" style="display: inline;">
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
            <?php endif; ?>
          </ul>
        </nav>
      </header>
    </div>
    <div class="header-container">
      <div class="header-container-inner">
        <h1 class="heading">Your Health, Our Priority</h1>
        <p class="hero-description">
          Dedicated to providing exceptional care with compassion. Explore our services, find specialists, and access
          resources tailored to your healthcare needs.
        </p>
      </div>
    </div>

    <div class="featured-in">
      <div class="container">
        <div class="logos">
          <img src="content/img/logos/business-insider.png" alt="Logo of Business Insider" />
          <img src="content/img/logos/forbes.png" alt="Logo of Forbes" />
          <img src="content/img/logos/techcrunch.png" alt="Logo of Techcrunch" />
          <img src="content/img/logos/the-new-york-times.png" alt="Logo of The New York Times" />
          <img src="content/img/logos/usa-today.png" alt="Logo of USA Today" />
        </div>
      </div>
    </div>
  </section>

  <section class="CVs" id="products">
    <div class="container">
      <span class="supheading">Our Services</span>
      <h2 class="subheading">
        Trusted by Thousands of Patients
      </h2>
    </div>
    <div
      class="container grid-container"
      style="
            --column: 3;
            --r-gap: 9.6rem;
            --c-gap: 5rem;
            --m-bottom: 2.4rem;
          ">
      <div class="CV-img">
        <img src="content/img/samples/sample1.jpg" alt="Doctor consulting a patient" />
      </div>
      <div class="categories">
        <h3 class="subsubheading">
          Comprehensive Care for Your Well-being
        </h3>
        <ul class="list">
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Expert medical specialists</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>State-of-the-art facilities</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>24/7 emergency services</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Advanced diagnostic tools</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Personalized treatment plans</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Telemedicine consultations</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Compassionate patient care</span>
          </li>
        </ul>
      </div>
      <div class="CV-img">
        <img src="content/img/samples/sample2.jpg" alt="Hospital ward with advanced equipment" />
      </div>
  </section>


  <section class="testimonial-container">
    <h3 class="supheading">Testimonial</h3>
    <h2 class="subheading">
      Hear from our patients
    </h2>
    <div
      class="testimonials grid-container"
      style="--column: 3; --row: 2; --r-gap: 1.6rem; --c-gap: 1.6rem">
      <div class="testimonial-first-img-wrapper">
        <img
          class="testimonial-first-img"
          src="content/img/customers/patient-alice.jpg" alt="Our first testimonial provider, Alice" />
      </div>
      <figure class="testimonial-first-text">
        <blockquote class="testimonial-text">
          "The care and attention I received here were extraordinary. From the friendly staff to the expert doctors, everyone went above and beyond to ensure my comfort and recovery. I can't thank them enough!"
        </blockquote>
        <p class="testimonial-author">Alice Palmer</p>
        <p class="testimonial-author-job">Patient</p>
      </figure>
      <figure class="testimonial-part">
        <blockquote class="testimonial-text">
          "The facilities are state-of-the-art, and the staff is compassionate and professional. I felt at ease knowing I was in great hands."
        </blockquote>
        <div class="testimonial-author-detail">
          <img
            class="testimonial-img"
            src="content/img/customers/patient-ben.jpg" alt="Our second testimonial provider, Ben" />
          <p class="testimonial-author">Ben Adams</p>
          <p class="testimonial-author-job">Patient</p>
        </div>
      </figure>
      <figure class="testimonial-part">
        <blockquote class="testimonial-text">
          "Thanks to the personalized care plan and the amazing team here, I was able to recover faster than I expected. Highly recommend this hospital!"
        </blockquote>
        <div class="testimonial-author-detail">
          <img
            class="testimonial-img"
            src="content/img/customers/patient-hannah.jpg" alt="Our third testimonial provider, Hannah" />
          <p class="testimonial-author">Hannah Wallace</p>
          <p class="testimonial-author-job">Patient</p>
        </div>
      </figure>
      <figure class="testimonial-part">
        <blockquote class="testimonial-text">
          "The 24/7 emergency services saved my life. I am so grateful for the dedication and expertise of the staff here."
        </blockquote>
        <div class="testimonial-author-detail">
          <img
            class="testimonial-img"
            src="content/img/customers/patient-steve.jpg" alt="Our fourth testimonial provider, Steve" />
          <p class="testimonial-author">Steve Solaris</p>
          <p class="testimonial-author-job">Patient</p>
        </div>
      </figure>
    </div>
  </section>


  <section class="accordion-section container">
    <h3 class="supheading">FAQs</h3>
    <h2 class="subheading">
      Frequently asked questions
    </h2>
    <div class="accordions">
      <div class="accordion-item">
        <p class="accordion-number">01</p>
        <p class="accordion-text">How do I book an appointment?</p>
        <ion-icon name="chevron-forward-outline" class="accordion-chevron-forward"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            Booking an appointment is simple and convenient. Follow these steps:
          </p>
          <ul>
            <li>Click on the "Book Appointment" button on the homepage.</li>
            <li>Select your preferred doctor or department.</li>
            <li>Choose a suitable date and time from the available slots.</li>
            <li>Provide your contact details and confirm your booking.</li>
          </ul>
        </div>
      </div>

      <div class="accordion-item open">
        <p class="accordion-number">02</p>
        <p class="accordion-text">Can I reschedule or cancel my appointment?</p>
        <ion-icon name="chevron-down-outline" class="accordion-chevron-down"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            Yes, you can reschedule or cancel your appointment easily. Here's how:
          </p>
          <ul>
            <li>Log in to your account and go to the "My Appointments" section.</li>
            <li>Select the appointment you wish to modify.</li>
            <li>Choose a new date and time or cancel the appointment.</li>
            <li>Confirm your changes to update the booking.</li>
          </ul>
        </div>
      </div>

      <div class="accordion-item">
        <p class="accordion-number">03</p>
        <p class="accordion-text">What are the visiting hours?</p>
        <ion-icon name="chevron-forward-outline" class="accordion-chevron-forward"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            Visiting hours vary by department but are generally:
          </p>
          <ul>
            <li>General Wards: 10:00 AM - 8:00 PM</li>
            <li>ICU: 4:00 PM - 6:00 PM (limited visitors)</li>
            <li>Maternity Ward: 12:00 PM - 7:00 PM</li>
          </ul>
        </div>
      </div>

      <div class="accordion-item">
        <p class="accordion-number">04</p>
        <p class="accordion-text">How do I access my medical records?</p>
        <ion-icon name="chevron-forward-outline" class="accordion-chevron-forward"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            Accessing your medical records is secure and easy:
          </p>
          <ul>
            <li>Log in to your account on our website.</li>
            <li>Go to the "My Records" section.</li>
            <li>View, download, or print your medical history and reports.</li>
            <li>For additional assistance, contact our support team.</li>
          </ul>
        </div>
      </div>
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

  <!-- To be seperated  -->
  <script>
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
      const icon = item.querySelector('ion-icon');
      icon.addEventListener('click', () => {
        // Toggle 'open' class on accordion item
        item.classList.toggle('open');

        // Toggle icon attributes
        if (item.classList.contains('open')) {
          icon.setAttribute('name', 'chevron-down-outline');
          icon.classList.remove('accordion-chevron-forward');
          icon.classList.add('accordion-chevron-down');
        } else {
          icon.setAttribute('name', 'chevron-forward-outline');
          icon.classList.remove('accordion-chevron-down');
          icon.classList.add('accordion-chevron-forward');
        }
      });
    });
  </script>
</body>

</html>