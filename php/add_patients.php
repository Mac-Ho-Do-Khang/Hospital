<?php
include("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = trim(filter_input(INPUT_POST, 'patient_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientFirstName = trim(filter_input(INPUT_POST, 'toadd_first_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientLastName = trim(filter_input(INPUT_POST, 'toadd_last_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientPhone = trim(filter_input(INPUT_POST, 'toadd_phone', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientDOB = trim(filter_input(INPUT_POST, 'toadd_dob', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientGender = trim(filter_input(INPUT_POST, 'toadd_gender', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientCountry = trim(filter_input(INPUT_POST, 'toadd_country', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientState = trim(filter_input(INPUT_POST, 'toadd_state', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientCity = trim(filter_input(INPUT_POST, 'toadd_city', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientSreet = trim(filter_input(INPUT_POST, 'toadd_street', FILTER_SANITIZE_SPECIAL_CHARS));
    $_SESSION['tab'] = "add_patient";

    if ($_POST['action'] == "Add Patient") {
        if (empty($patientFirstName)) {
            $_SESSION['add_error'] = "Please enter patient's first name.";
            $connection->close();
            header("Location: index.php?page=patients");
            exit;
        }
        if (empty($patientLastName)) {
            $_SESSION['add_error'] = "Please enter patient's last name.";
            $connection->close();
            header("Location: index.php?page=patients");
            exit;
        }
        if (empty($patientDOB)) {
            $_SESSION['add_error'] = "Please enter patient's date of birth.";
            $connection->close();
            header("Location: index.php?page=patients");
            exit;
        }
        if (empty($patientGender)) {
            $_SESSION['add_error'] = "Please enter patient's gender.";
            $connection->close();
            header("Location: index.php?page=patients");
            exit;
        }
        if (empty($patientPhone)) {
            $_SESSION['add_error'] = "Please enter patient's phone number.";
            $connection->close();
            header("Location: index.php?page=patients");
            exit;
        }
        // if (empty($patientStreet)) {
        //     $_SESSION['add_error'] = "Please enter patient's address.";
        //     $connection->close();
        //     header("Location: index.php?page=patients");
        //     exit;
        // }
    }
    // ----------------------------------------------------------------------------------------------------------
    // ----------------------------------------------- GENERAL --------------------------------------------------
    // ----------------------------------------------------------------------------------------------------------

    $fetch_general_information = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) FULL_NAME, PHONE_NUMBER, DATE_OF_BIRTH, ADDRESS FROM $tb_patient WHERE CODE = '$patientID';";
    $general_information = mysqli_query($connection, $fetch_general_information);
    if ($general_information && mysqli_num_rows($general_information) > 0) {
        // Only one row
        $_SESSION['general'] = mysqli_fetch_all($general_information, MYSQLI_ASSOC);
        $_SESSION['patient_ID_get'] = $patientID;
        if ($_POST['action'] == "Add Patient") {
            $_SESSION['add_error'] = "Patient already exists.";
        }
    } else {
        // ----------------------------------------------------------------------------------------------------------
        // ----------------------------------------------- ADD PATIENT ----------------------------------------------
        // ----------------------------------------------------------------------------------------------------------
        if ($_POST['action'] == "Add Patient") {
            $gender = ($patientGender == "Male") ? "M" : "F";
            $address = $patientSreet . ", " . $patientCity . ", " . $patientState . ", " . $patientCountry;
            $insert_patient_query = "INSERT INTO $tb_patient (CODE, FIRST_NAME, LAST_NAME, GENDER, PHONE_NUMBER, DATE_OF_BIRTH, ADDRESS)
                                 VALUES ('$patientID', '$patientFirstName', '$patientLastName', '$gender', '$patientPhone', '$patientDOB', '$address')";
            if (mysqli_query($connection, $insert_patient_query)) {
                $_SESSION['add_success'] = "Add new patient successfully";
                echo $_SESSION['add_success'];
            } else {
                $_SESSION['add_error'] = "Error adding patient: " . mysqli_error($connection);
                echo $_SESSION['add_error'];
            }
        }
    }
}
$connection->close();
header("Location: index.php?page=patients");
exit;
