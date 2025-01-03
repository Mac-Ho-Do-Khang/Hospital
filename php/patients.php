<?php
include("database.php");
session_start();
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
    <link rel="stylesheet" href="css/autocomplete.css" />
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <script
        type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script
        nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Hospital - Amazing 10 points!!!</title>
</head>

<body>
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
                    <?php else: ?> <!----- Header when logged in not as an admin ----->
                        <div class="user-info">
                            <ion-icon class="user-icon" name="person-circle"></ion-icon>
                            <div class="info">
                                <p><?php echo $_SESSION['name']; ?></p>
                                <p><?php echo "(" . $_SESSION['user'] . ")"; ?></p>
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
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
    </div>

    <div class="add-tabs">
        <button class="add-tablink" onclick="openPage('add-a-patient', this)"
            <?php if (isset($_SESSION['tab'])) {
                if ($_SESSION['tab'] == "add_patient") echo 'id="defaultOpen"';
            } else echo 'id="defaultOpen"'; ?>>Add</button>
        <button class="add-tablink" onclick="openPage('search-a-patient', this)"
            <?php if (isset($_SESSION['tab'])) if ($_SESSION['tab'] == "search_by_id") echo 'id="defaultOpen"'; ?>>Search</button>
        <button class="add-tablink" onclick="openPage('search-patients-by-doctor', this)"
            <?php if (isset($_SESSION['tab'])) if ($_SESSION['tab'] == "search_by_doctor") echo 'id="defaultOpen"'; ?>>Search by doctor</button>
        <button class="add-tablink" onclick="openPage('search-patient-fees', this)"
            <?php if (isset($_SESSION['tab'])) if ($_SESSION['tab'] == "search_fee") echo 'id="defaultOpen"'; ?>>Search patient fee</button>
    </div>

    <section id="add-a-patient" class="add-tabcontent">
        <div class="CV-form-container">
            <form class="CV-form" method="post" action="index.php?page=add_patients" autocomplete="off">
                <div class="CV-form-title">Primary information</div>
                <!-- ID -->
                <div class="CV-form-part ID">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>ID*</label>
                    </div>
                    <input type="text" name="patient_id" class="autocomplete_patient_ids" placeholder="GP000000001" required>
                </div>
                <div class="addID-button-wrapper">
                    <input type="submit" name="action" value="Check" class="btn btn-full">
                </div>

                <!-- GENERAL INFORMATION  -->
                <?php
                if (isset($_SESSION['general']) && count($_SESSION['general']) > 0) {
                    // Only one row is fetched
                ?>
                    <div class="CV-form-title">Patient information</div>
                    <div class="patient-information-general-wrapper">
                        <div class="patient-information-general">
                            <ion-icon name="information"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['patient_ID_get']); ?></p>
                            <ion-icon name="person-circle"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['FULL_NAME']); ?></p>
                            <ion-icon name="call"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['PHONE_NUMBER']); ?></p>
                            <ion-icon name="calendar"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['DATE_OF_BIRTH']); ?></p>
                            <ion-icon name="location"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['ADDRESS']); ?></p>
                        </div>
                    </div>
                <?php
                    unset($_SESSION['general']);
                } else { ?>
                    <!-- First name -->
                    <div class="CV-form-part Name">
                        <div class="CV-form-icon-label">
                            <ion-icon name="person"></ion-icon>
                            <label>First Name*</label>
                        </div>
                        <input type="text" name="toadd_first_name" placeholder="John M.">
                    </div>
                    <!-- Last name -->
                    <div class="CV-form-part Name">
                        <div class="CV-form-icon-label">
                            <ion-icon name="person"></ion-icon>
                            <label>Last Name*</label>
                        </div>
                        <input type="text" name="toadd_last_name" placeholder="Doe">
                    </div>
                    <!-- Date of Birth -->
                    <div class="CV-form-part DOB">
                        <div class="CV-form-icon-label">
                            <ion-icon name="calendar"></ion-icon>
                            <label>Date of Birth*</label>
                        </div>
                        <input type="date" name="toadd_dob" placeholder="14/03/2004">
                    </div>
                    <!-- Gender -->
                    <div class="CV-form-part Gender">
                        <div class="CV-form-icon-label">
                            <ion-icon name="transgender"></ion-icon>
                            <label>Gender*</label>
                        </div>
                        <select name="toadd_gender">
                            <option value="">---Choose one---</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <!-- Phone -->
                    <div class="CV-form-part Phone">
                        <div class="CV-form-icon-label">
                            <ion-icon name="call"></ion-icon>
                            <label>Phone Number*</label>
                        </div>
                        <input type="text" name="toadd_phone" placeholder="919-263-1770">
                    </div>
                    <!-- Address -->
                    <div class="CV-form-part Addresses">
                        <div class="CV-form-icon-label">
                            <ion-icon name="location"></ion-icon>
                            <label>Address*</label>
                        </div>
                        <!-- <div id="addresses-container">
                        <div class="with-trashbin"> -->
                        <div class="address-container">
                            <input type="text" name="toadd_street" placeholder="123 Any Street">
                            <select id="country" name="country" onchange="fetchStates()">
                                <option value="">---Country---</option>
                            </select>
                            <select id="state" name="state" onchange="fetchCities()">
                                <option value="">---State---</option>
                            </select>
                            <select id="city" name="city" onchange="fetchBelows()">
                                <option value="">---City---</option>
                            </select>
                            <input id="toadd_country" name="toadd_country" style="display: none;"></input>
                            <input id="toadd_state" name="toadd_state" style="display: none;"></input>
                            <input id="toadd_city" name="toadd_city" style="display: none;"></input>
                        </div>
                        <!-- </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-address-button">+</button>
                    </div> -->
                    </div>
                <?php }
                ?>

                <div class="CV-form-part Patient-type">
                    <div class="CV-form-icon-label">
                        <ion-icon name="people"></ion-icon>
                        <label>Patient type</label>
                    </div>
                    <div id="patient-selector">
                        <select>
                            <option value="">---Choose one---</option>
                            <option value="1">Outpatient</option>
                            <option value="2">Inpatient</option>
                        </select>
                    </div>
                </div>

                <!------------------------ OUTPATIENTS ------------------------>
                <!-- ID -->
                <div class="CV-form-part Outpatient-ID">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information"></ion-icon>
                        <label>Outpatient ID</label>
                    </div>
                    <input type="text" placeholder="OP000000001">
                </div>
                <!-- Examinations -->
                <div class="CV-form-part Examinations">
                    <div class="CV-form-icon-label">
                        <ion-icon name="medkit"></ion-icon>
                        <label>Examination</label>
                    </div>
                    <div id="examinations-container">
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-examination-button">+</button>
                    </div>
                </div>

                <!------------------------ INPATIENTS ------------------------>

                <!-- ID -->
                <div class="CV-form-part Inpatient-ID">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information"></ion-icon>
                        <label>Inpatient ID</label>
                    </div>
                    <input type="text" placeholder="OP000000001">
                </div>
                <!-- Date of Admission -->
                <div class="CV-form-part DOA">
                    <div class="CV-form-icon-label">
                        <ion-icon name="calendar"></ion-icon>
                        <label>Date of Admission</label>
                    </div>
                    <input type="text" placeholder="14/03/2004">
                </div>
                <!-- Caring Nurse -->
                <div class="CV-form-part Nurse">
                    <div class="CV-form-icon-label">
                        <ion-icon name="heart-circle"></ion-icon>
                        <label>Caring Nurse</label>
                    </div>
                    <input type="text" placeholder="John M.">
                </div>
                <!-- Sickroom -->
                <div class="CV-form-part Sickroom">
                    <div class="CV-form-icon-label">
                        <ion-icon name="home"></ion-icon>
                        <label>Sickroom</label>
                    </div>
                    <input type="text" placeholder="John M.">
                </div>
                <!-- Date of Discharge -->
                <div class="CV-form-part DOD">
                    <div class="CV-form-icon-label">
                        <ion-icon name="calendar"></ion-icon>
                        <label>Date of Discharge</label>
                    </div>
                    <input type="text" placeholder="14/03/2004">
                </div>
                <!-- Fee -->
                <div class="CV-form-part Fee">
                    <div class="CV-form-icon-label">
                        <ion-icon name="skull"></ion-icon>
                        <label>Fee</label>
                    </div>
                    <input type="text" placeholder="John M.">
                </div>

                <!-- Treatments -->
                <div class="CV-form-part Treatments">
                    <div class="CV-form-icon-label">
                        <ion-icon name="medkit"></ion-icon>
                        <label>Treatment</label>
                    </div>
                    <div id="treatments-container">
                        <!-- <div class="with-trashbin">
                            <div class="treatment-container">
                                <div class="Treatment-doctors">
                                    <div id="treatment-doctors-container">
                                        <div class="with-trashbin">
                                            <div class="treatment-doctor-container">
                                                <input type="text" placeholder="Doctor" required>
                                            </div>
                                            <ion-icon name="trash"></ion-icon>
                                        </div>
                                    </div>
                                    <div class="add-button-wrapper">
                                        <button type="button" class="add-button" id="add-treatment-doctor-button">+</button>
                                    </div>
                                </div>
                                <input type="text" name="result" placeholder="Result" required>
                                <div class="Treatment-medications">
                                    <div id="examination-medications-container">
                                        <div class="with-trashbin">
                                            <div class="examination-medication-container">
                                                <input type="text" placeholder="Medication" required>
                                            </div>
                                            <ion-icon name="trash"></ion-icon>
                                        </div>
                                    </div>
                                    <div class="add-button-wrapper">
                                        <button type="button" class="add-button" id="add-examination-medication-button">+</button>
                                    </div>
                                </div>
                                <div class="year-container">
                                    <input type="date" name="start-treat" title="Start Date" required>
                                    <input type="date" name="end-treat" title="End Date" required>
                                </div>
                                <select onchange="">
                                    <option value="">State</option>
                                    <option value="1">Recovered</option>
                                    <option value="2">Not recovered</option>
                                </select>
                            </div>
                            <ion-icon name="trash"></ion-icon>
                        </div> -->
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-treatment-button">+</button>
                    </div>
                </div>

                <!-- Error prompt -->
                <div class="CV-form-part form-error-notify">
                    <?php if (isset($_SESSION['add_error'])) {
                        echo "<p>" . $_SESSION['add_error'] . "</p>";
                        unset($_SESSION['add_error']);
                    } elseif (isset($_SESSION['add_success'])) {
                        echo "<p style=\"color:green;\">" . $_SESSION['add_success'] . "</p>";
                        unset($_SESSION['add_success']);
                    }
                    ?>
                </div>

                <div class="submit-button-wrapper">
                    <input type="submit" name="action" value="Add Patient" class="btn btn-full">
                </div>
            </form>
        </div>

    </section>

    <section id="search-a-patient" class="add-tabcontent">
        <div class="CV-upload-form-container">
            <form action="index.php?page=search_by_id" method="post" class="CV-upload-form CV-form" autocomplete="off">
                <div class="CV-form-title">Search a patient</div>
                <!-- ID  -->
                <div class="CV-form-part search-ID">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>Patient's ID</label>
                    </div>
                    <input type="text" class="autocomplete_patient_ids" name="patient_id" placeholder="GP00000001">
                </div>
                <!-- Name  -->
                <div class="CV-form-part search-name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="person-circle"></ion-icon>
                        <label>Patient's Name</label>
                    </div>
                    <input type="text" class="autocomplete_patient_name_ids" name="patient_name" placeholder="John M. Doe">
                </div>
                <div class="CV-upload-search-wrapper">
                    <input type="submit" class="btn btn-full CV-upload-search" value="Search">
                    <div class="search-message"><?php if (isset($_SESSION['error'])) {
                                                    echo $_SESSION['error'];
                                                    unset($_SESSION['error']);
                                                } ?></div>
                </div>

                <!-- GENERAL INFORMATION  -->
                <?php
                if (isset($_SESSION['general']) && count($_SESSION['general']) > 0) {
                    // Only one row is fetched
                ?>
                    <div class="CV-form-title">Patient information</div>
                    <div class="patient-information-general-wrapper">
                        <div class="patient-information-general">
                            <ion-icon name="person-circle"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['FULL_NAME']); ?></p>
                            <ion-icon name="call"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['PHONE_NUMBER']); ?></p>
                            <ion-icon name="calendar"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['DATE_OF_BIRTH']); ?></p>
                            <ion-icon name="location"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['general'][0]['ADDRESS']); ?></p>
                        </div>
                    </div>
                <?php
                    unset($_SESSION['general']);
                }
                ?>
                <!-- AS AN INPATIENT  -->
                <?php if (isset($_SESSION['inpatient']) && count($_SESSION['inpatient']) > 1) {
                ?>
                    <div class="CV-form-title patient-title">Inpatient</div>
                    <div class="inpatient-wrapper">
                        <div class="inpatient">
                            <?php
                            $count_inpatient = 1;
                            foreach ($_SESSION['inpatient'] as $k => $inpatient) {
                                if ($k >= 0) {
                                    $count_treatment = 1; ?>
                                    <div class="inpatient-one-time">
                                        <div class="inpatient-information-wrapper">
                                            <div class="inpatient-information">
                                                <div class="ordinal-number"><?= $count_inpatient ?></div>
                                                <div class="inpatient-content"><ion-icon name="calendar-number"></ion-icon>
                                                    <p class="date-in-out">
                                                        <span class="date-in"><?= htmlspecialchars($inpatient['DATE_OF_ADMISSION']); ?></span>
                                                        <span class="date-dash"> &mdash; </span>
                                                        <span class="date-out"><?= htmlspecialchars($inpatient['DATE_OF_DISCHARGE']); ?></span>
                                                    </p>
                                                    <ion-icon name="person"></ion-icon>
                                                    <p><?= htmlspecialchars($inpatient['NURSE_NAME']); ?></p>
                                                    <ion-icon name="diamond"></ion-icon>
                                                    <p><?= htmlspecialchars($inpatient['FEE']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="treatments-information">
                                            <?php
                                            foreach ($inpatient as $inpatient_key => $treatment) {
                                                if (is_int($inpatient_key) && $inpatient_key >= 0) { ?>
                                                    <div class="treatment-information">
                                                        <p class="title">&mdash;&mdash;&mdash;&mdash; Treatment <?= $count_treatment ?> &mdash;&mdash;&mdash;&mdash;</p>
                                                        <ion-icon name="people"></ion-icon>
                                                        <?php
                                                        foreach ($treatment['DOCTOR_NAME'] as $doctor) {
                                                            echo "<p>Dr." . $doctor . "</p>";
                                                        } ?>
                                                        <ion-icon name="information-circle"></ion-icon>
                                                        <p><?= htmlspecialchars($treatment['RESULT']); ?></p>
                                                        <ion-icon name="leaf"></ion-icon>
                                                        <div class="medications">
                                                            <?php for ($i = 0; $i < count($treatment['MEDICATION_NAME']); $i++) { ?>
                                                                <div class="name"><?= htmlspecialchars($treatment['MEDICATION_NAME'][$i]) ?></div>
                                                                <div class="price">$<?= htmlspecialchars($treatment['MEDICATION_PRICE'][$i]) ?></div>
                                                            <?php } ?>
                                                        </div>
                                                        <ion-icon name="heart-circle"></ion-icon>
                                                        <p><?php if ($treatment['RECOVERY'] == 1) echo "Recovered";
                                                            else echo "Not recovered"; ?></p>
                                                        <ion-icon name="calendar-number"></ion-icon>
                                                        <div class="date-start-end">
                                                            <div class="date-start"><?= htmlspecialchars((new DateTime($treatment['START_DATE']))->format('Y-m-d (H:i:s)')); ?></div>
                                                            <div class="date-end"><?= htmlspecialchars((new DateTime($treatment['END_DATE']))->format('Y-m-d (H:i:s)')); ?></div>
                                                        </div>
                                                    </div>
                                            <?php $count_treatment++;
                                                }
                                            } ?>
                                        </div>
                                    </div>
                            <?php $count_inpatient++;
                                }
                            } ?>
                        </div>
                    </div>
                <?php
                    unset($_SESSION['inpatient']);
                }
                ?>
                <!-- AS AN OUTPATIENT  -->
                <?php if (isset($_SESSION['outpatient']) && count($_SESSION['outpatient']) > 1) {
                ?>
                    <div class="CV-form-title patient-title">Outpatient</div>
                    <div class="outpatient-wrapper">
                        <div class="outpatient">
                            <div class="examinations-information">
                                <?php $count_examination = 1;
                                foreach ($_SESSION['outpatient'] as $k => $examination) {
                                    if (is_int($k) && $k >= 0) {
                                ?>
                                        <div class="examination-information">
                                            <p class="title">&mdash;&mdash;&mdash;&mdash; Examination <?= $count_examination ?> &mdash;&mdash;&mdash;&mdash;</p>
                                            <ion-icon name="people"></ion-icon>
                                            <?php foreach ($examination['DOCTOR_NAME'] as $doctor)
                                                echo "<p>Dr. " . $doctor . "</p>"; ?>
                                            <ion-icon name="information-circle"></ion-icon>
                                            <p><?= htmlspecialchars($examination['DIAGNOSIS']) ?></p>
                                            <ion-icon name="leaf"></ion-icon>
                                            <div class="medications">
                                                <?php for ($i = 0; $i < count($examination['NAME']); $i++) { ?>
                                                    <div class="name"><?= htmlspecialchars($examination['NAME'][$i]) ?></div>
                                                    <div class="price">$<?= htmlspecialchars($examination['PRICE'][$i]) ?></div>
                                                <?php } ?>
                                            </div>
                                            <ion-icon name="diamond"></ion-icon>
                                            <p><?= htmlspecialchars($examination['FEE']) ?></p>
                                            <ion-icon name="calendar-number"></ion-icon>
                                            <div class="date-start-end">
                                                <div class="date-start"><?= htmlspecialchars((new DateTime($examination['EXAMINATION_DATE']))->format('Y-m-d (H:i:s)')); ?></div>
                                                <div class="date-end"><?php if ($examination['NEXT_EXAMINATION_DATE'] != "None") echo htmlspecialchars((new DateTime($examination['NEXT_EXAMINATION_DATE']))->format('Y-m-d (H:i:s)')); ?></div>
                                            </div>
                                        </div>
                                <?php $count_examination++;
                                    }
                                } ?>
                            </div>

                        </div>
                    </div>
                <?php
                    unset($_SESSION['outpatient']);
                }
                ?>

            </form>
        </div>
    </section>

    <section id="search-patients-by-doctor" class="add-tabcontent">
        <div class="CV-upload-form-container">
            <form action="index.php?page=search_by_doctor" method="post" class="CV-upload-form CV-form" autocomplete="off">
                <div class="CV-form-title">Search patients</div>
                <!-- ID  -->
                <div class="CV-form-part search-ID">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>Doctor's ID</label>
                    </div>
                    <input type="text" name="doctor_id" class="autocomplete_doctor_ids" placeholder="EM00000001">
                </div>
                <!-- Name  -->
                <div class="CV-form-part search-name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="person-circle"></ion-icon>
                        <label>Doctor's Name</label>
                    </div>
                    <input type="text" name="doctor_name" class="autocomplete_doctor_name_ids" placeholder="John M. Doe">
                </div>
                <div class="CV-upload-search-wrapper">
                    <input type="submit" class="btn btn-full CV-upload-search" value="Search">
                    <div class="search-message"><?php if (isset($_SESSION['doctor_error'])) {
                                                    echo $_SESSION['doctor_error'];
                                                    unset($_SESSION['doctor_error']);
                                                } ?></div>
                </div>

                <?php if (isset($_SESSION['patients']) && count($_SESSION['patients']) > 1) {
                ?>
                    <div class="CV-form-title patient-title">Inpatient</div>
                    <div class="patients-informations-wrapper">
                        <div class="patients-informations">
                            <?php $count_patient = 1;
                            foreach ($_SESSION['patients'] as $k => $patient) {
                                if (is_int($k) && $k >= 0) {
                            ?>
                                    <div class="patients-information">
                                        <div class="ordinal-number">
                                            <p><?= $count_patient ?></p>
                                        </div>
                                        <div class="information">
                                            <ion-icon name="person-circle"></ion-icon>
                                            <p><?= htmlspecialchars($patient['PATIENT_NAME']) ?></p>
                                            <ion-icon name="information"></ion-icon>
                                            <p><?= htmlspecialchars($patient['INPATIENT_CODE']) ?></p>
                                            <ion-icon name="call"></ion-icon>
                                            <p><?= htmlspecialchars($patient['PHONE_NUMBER']) ?></p>
                                            <ion-icon name="calendar"></ion-icon>
                                            <p><?= htmlspecialchars($patient['DATE_OF_BIRTH']) ?></p>
                                            <ion-icon name="location"></ion-icon>
                                            <p><?= htmlspecialchars($patient['ADDRESS']) ?></p>
                                            <?php $count_treatment = 0;
                                            foreach ($patient as $i => $treatment) {
                                                if (is_int($i) && $i >= 0) {
                                            ?>
                                                    <p class="title">&mdash;&mdash;&mdash;&mdash; Treatment <?= $count_treatment ?> &mdash;&mdash;&mdash;&mdash;</p>
                                                    <ion-icon name="information-circle"></ion-icon>
                                                    <p><?= htmlspecialchars($treatment['RESULT']) ?></p>
                                                    <ion-icon name="leaf"></ion-icon>
                                                    <?php foreach ($treatment['NAME'] as $medication) { ?>
                                                        <p class="name"><?= htmlspecialchars($medication) ?></p>
                                                    <?php } ?>

                                                    <ion-icon name="heart-circle"></ion-icon>
                                                    <p><?php if ($treatment['RECOVERY'] == 1) echo "Recovered";
                                                        else echo "Not recovered"; ?></p>
                                                    <ion-icon name="calendar-number"></ion-icon>
                                                    <div class="date-start-end">
                                                        <div class="date-start"><?= htmlspecialchars((new DateTime($treatment['START_DATE']))->format('Y-m-d (H:i:s)')); ?></div>
                                                        <div class="date-end"><?= htmlspecialchars((new DateTime($treatment['END_DATE']))->format('Y-m-d (H:i:s)')); ?></div>
                                                    </div>

                                            <?php $count_treatment++;
                                                }
                                            } ?>
                                        </div>
                                    </div>

                            <?php $count_patient++;
                                }
                            } ?>
                        </div>
                    </div>

                <?php unset($_SESSION['patients']);
                } ?>
            </form>
        </div>
        </div>
    </section>

    <section id="search-patient-fees" class="add-tabcontent">
        <div class="CV-upload-form-container">
            <form action="index.php?page=search_fee" method="post" class="CV-upload-form CV-form" autocomplete="off">
                <div class="CV-form-title">Search a patient's fee</div>
                <!-- ID  -->
                <div class="CV-form-part search-ID">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>Patient's ID</label>
                    </div>
                    <input type="text" name="patient_id" class="autocomplete_patient_ids" placeholder="IP00000001">
                </div>
                <!-- Name  -->
                <div class="CV-form-part search-name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="person-circle"></ion-icon>
                        <label>Patient's Name</label>
                    </div>
                    <input type="text" name="patient_name" class="autocomplete_patient_name_ids" placeholder="John M. Doe">
                </div>
                <div class="CV-upload-search-wrapper">
                    <input type="submit" class="btn btn-full CV-upload-search" value="Search">
                    <div class="search-message"><?php if (isset($_SESSION['fee_error'])) {
                                                    echo $_SESSION['fee_error'];
                                                    unset($_SESSION['fee_error']);
                                                } ?></div>
                </div>

                <!-- GENERAL INFORMATION  -->
                <?php
                if (isset($_SESSION['fee_general']) && count($_SESSION['fee_general']) > 0) {
                    // Only one row is fetched
                ?>
                    <div class="CV-form-title">Patient information</div>
                    <div class="patient-information-general-wrapper">
                        <div class="patient-information-general">
                            <ion-icon name="person-circle"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['fee_general'][0]['FULL_NAME']); ?></p>
                            <ion-icon name="call"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['fee_general'][0]['PHONE_NUMBER']); ?></p>
                            <ion-icon name="calendar"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['fee_general'][0]['DATE_OF_BIRTH']); ?></p>
                            <ion-icon name="location"></ion-icon>
                            <p><?= htmlspecialchars($_SESSION['fee_general'][0]['ADDRESS']); ?></p>
                        </div>
                    </div>
                <?php
                    unset($_SESSION['fee_general']);
                }
                ?>

                <!-- FEE INFORMATION  -->
                <div class="CV-form-title">Patient's fee</div>
                <div class="fees-container-wrapper">
                    <div class="fees-container">
                        <?php if (isset($_SESSION['fee']) && count($_SESSION['fee']) > 1) {
                        ?>
                            <div class="titles">
                                <p>Type</p>
                                <p>Date</p>
                                <p>Fee</p>
                                <p>Medication price</p>
                                <p>Total fee</p>
                            </div>

                            <?php foreach ($_SESSION['fee'] as $record) { ?>
                                <div class="record">
                                    <p><?php if ($record['TYPE'] == "TREATMENT") echo 'Treatment';
                                        else echo 'Examination'; ?></p>
                                    <?php echo "<p>" . htmlspecialchars((new DateTime($record['DATE_BEGIN']))->format('Y-m-d (H:i:s)'));
                                    if ($record['TYPE'] == "TREATMENT") {
                                        echo "   &mdash;   ";
                                        echo '<br>' . htmlspecialchars((new DateTime($record['DATE_END']))->format('Y-m-d (H:i:s)')) . '</br>';
                                    } else {
                                        if ($record['DATE_END'] != "None") {
                                            echo " &rarr; ";
                                            echo htmlspecialchars((new DateTime($record['DATE_END']))->format('Y-m-d (H:i:s)')) . "</p>";
                                        }
                                    }
                                    ?>
                                    <p><?= $record['FEE'] ?></p>
                                    <p><?= $record['TOTAL_MEDICAL_PRICE'] ?></p>
                                    <p><?= $record['TOTAL_FEE'] ?></p>
                                </div>
                        <?php }
                            unset($_SESSION['fee']);
                        }
                        ?>
                    </div>
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
    <script
        src="javascript/patients.js" defer></script>

    <!-- Multilevel dependent dropdown  -->
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
            // Fetch the country into the value of a dummy input field for PHP fetching
            const select_country = document.getElementById('country');
            const selected_country = select_country.options[select_country.selectedIndex].text;
            document.getElementById('toadd_country').value = selected_country;


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
            // Fetch the state into the value of a dummy input field for PHP fetching
            const select_state = document.getElementById('state');
            const selected_state = select_state.options[select_state.selectedIndex].text;
            document.getElementById('toadd_state').value = selected_state;


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

        async function fetchBelows() {
            // Fetch the city into the value of a dummy input field for PHP fetching
            const select_city = document.getElementById('city');
            const selected_city = select_city.options[select_city.selectedIndex].text;
            document.getElementById('toadd_city').value = selected_city;
            console.log(document.getElementById('toadd_city').value);
        }

        // Initialize
        fetchCountries();
    </script>
    <!-- Autocomplete  -->
    <script>
        // -------------- Fetch patients -------------------
        let all_patients_name = [];
        let all_patients_code = [];
        let all_patients_name_code = [];
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "php/all_patients.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(xhr.responseText, "application/xml");
                const patients = xmlDoc.getElementsByTagName("patient");

                for (let i = 0; i < patients.length; i++) {
                    const code = patients[i].getElementsByTagName("code")[0].textContent;
                    all_patients_code.push(code);
                    const full_name = patients[i].getElementsByTagName("full_name")[0].textContent;
                    all_patients_name.push(full_name);
                    all_patients_name_code.push(full_name + "     " + code);
                }
            }
        };
        xhr.send();
        // console.log(all_patients_code);
        // console.log(all_patients_name);
        // console.log(all_patients_name_code);
        // -------------- Fetch doctors -------------------
        let all_doctors_name = [];
        let all_doctors_code = [];
        let all_doctors_name_code = [];
        const xhr1 = new XMLHttpRequest();
        xhr1.open("GET", "php/all_doctors.php", true);
        xhr1.onload = function() {
            if (xhr1.status === 200) {
                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(xhr1.responseText, "application/xml");
                const doctors = xmlDoc.getElementsByTagName("doctor");

                for (let i = 0; i < doctors.length; i++) {
                    const code = doctors[i].getElementsByTagName("code")[0].textContent;
                    all_doctors_code.push(code);
                    const full_name = doctors[i].getElementsByTagName("full_name")[0].textContent;
                    all_doctors_name.push(full_name);
                    all_doctors_name_code.push(full_name + "     " + code);
                }
            }
        };
        xhr1.send();
        console.log(all_doctors_code);
        console.log(all_doctors_name);
        console.log(all_doctors_name_code);
        // -------------- Apply autocomplete -------------------
        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
              the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("class", "autocomplete-items autocomplete-list");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert an input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                              (or any other open lists of autocompleted values):*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementsByClassName("autocomplete-list")[0];
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                        increase the currentFocus variable:*/
                    currentFocus++;
                    /*and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                        decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = x.length - 1;
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                  except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        Array.from(document.getElementsByClassName("autocomplete_patient_ids")).forEach(element => {
            autocomplete(element, all_patients_code);
        });
        Array.from(document.getElementsByClassName("autocomplete_patient_name_ids")).forEach(ele => {
            autocomplete(ele, all_patients_name_code);
        });
        Array.from(document.getElementsByClassName("autocomplete_doctor_ids")).forEach(element => {
            autocomplete(element, all_doctors_code);
        });
        Array.from(document.getElementsByClassName("autocomplete_doctor_name_ids")).forEach(ele => {
            autocomplete(ele, all_doctors_name_code);
        });
    </script>
</body>

</html>