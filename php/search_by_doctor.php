<?php
include("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID =  trim(filter_input(INPUT_POST, 'doctor_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $doctorName = end(explode(" ", trim(filter_input(INPUT_POST, 'doctor_name', FILTER_SANITIZE_SPECIAL_CHARS))));
    $_SESSION['tab'] = "search_by_doctor";

    if (empty($doctorID) && empty($doctorName)) {
        $_SESSION['doctor_error'] = "Please enter either the doctor's ID or name to search.";
        $connection->close();
        header("Location: index.php?page=patients");
        exit;
    }
    if (empty($doctorID)) $doctorID = $doctorName;
    // ----------------------------------------------------------------------------------------------------------
    // ----------------------------------------------- GENERAL --------------------------------------------------
    // ----------------------------------------------------------------------------------------------------------

    $fetch_doctor = "SELECT * FROM $tb_employee WHERE CODE = '$doctorID';";
    $doctor = mysqli_query($connection, $fetch_doctor);

    if ($doctor && mysqli_num_rows($doctor) == 0) {
        $_SESSION['doctor_error'] = "No doctor found.";
        $connection->close();
        header("Location: index.php?page=patients");
        exit;
    }

    // ----------------------------------------------------------------------------------------------------------
    // ---------------------------------------------- INPATIENTS ------------------------------------------------
    // ----------------------------------------------------------------------------------------------------------

    $fetch_inpatients = "
    SELECT IP.INPATIENT_CODE
		, CONCAT(P.FIRST_NAME, ' ', P.LAST_NAME) PATIENT_NAME
        , P.GENDER
        , P.PHONE_NUMBER
        , P.DATE_OF_BIRTH
        , P.ADDRESS
        , T.START_DATE
        , T.END_DATE
        , T.RESULT
        , M.NAME
        , T.RECOVERY
FROM EMPLOYEE E
	JOIN TREATMENT T ON T.DOCTOR_CODE = E.CODE
    JOIN INPATIENT IP ON IP.INPATIENT_CODE = T.INPATIENT_CODE
    JOIN PATIENT P ON P.CODE = IP.CODE
    LEFT JOIN TREATMENT_CONTAINS TC ON T.DOCTOR_CODE = TC.DOCTOR_CODE
								AND T.INPATIENT_CODE = TC.INPATIENT_CODE
								AND T.START_DATE = TC.START_DATE
								AND T.END_DATE = TC.END_DATE
	LEFT JOIN MEDICATION M ON TC.MEDICATION_CODE = M.CODE
WHERE T.DOCTOR_CODE = '$doctorID'
ORDER BY IP.INPATIENT_CODE, T.START_DATE, T.END_DATE, M.NAME;
    "; // considered as one query
    $inpatients = mysqli_query($connection, $fetch_inpatients);

    $patient_index = -1;
    $treatment_index = -1;
    $_SESSION['patients'][-1]['INPATIENT_CODE'] = -1; // for later comparison with non-null value

    while ($info = mysqli_fetch_assoc($inpatients)) {
        // --------------------------- For each new patient ---------------------------
        if ($info['INPATIENT_CODE'] != $_SESSION['patients'][$patient_index]['INPATIENT_CODE']) {
            $patient_index++;
            $treatment_index = -1;
            $_SESSION['patients'][$patient_index]['INPATIENT_CODE'] = $info['INPATIENT_CODE'];
            $_SESSION['patients'][$patient_index]['PATIENT_NAME'] = $info['PATIENT_NAME'];
            $_SESSION['patients'][$patient_index]['PHONE_NUMBER'] = $info['PHONE_NUMBER'];
            $_SESSION['patients'][$patient_index]['DATE_OF_BIRTH'] = $info['DATE_OF_BIRTH'];
            $_SESSION['patients'][$patient_index]['ADDRESS'] = $info['ADDRESS'];

            $_SESSION['patients'][$patient_index][-1]['START_DATE'] = null; // for later comparison with non-null value
        }
        // --------------------------- For each new treatment time ---------------------------
        if ($info['START_DATE'] != $_SESSION['patients'][$treatment_index]['START_DATE']) {
            $treatment_index++;
            $_SESSION['patients'][$patient_index][$treatment_index]['START_DATE'] = $info['START_DATE'];
            $_SESSION['patients'][$patient_index][$treatment_index]['END_DATE'] = $info['END_DATE'];
            $_SESSION['patients'][$patient_index][$treatment_index]['RESULT'] = $info['RESULT'];
            $_SESSION['patients'][$patient_index][$treatment_index]['RECOVERY'] = $info['RECOVERY'];

            $_SESSION['patients'][$patient_index][$treatment_index]['NAME'] = [];  // for later comparison with non-null value
        }

        // add into this treatment
        if (!in_array($info['NAME'], $_SESSION['patients'][$patient_index][$treatment_index]['NAME']))    // if this medication doesn't exist
            array_push($_SESSION['patients'][$patient_index][$treatment_index]['NAME'], $info['NAME']);   // add into this treatment
    }
}
$connection->close();
header("Location: index.php?page=patients");
exit;
