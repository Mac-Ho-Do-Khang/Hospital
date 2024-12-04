<?php
include("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo $_POST['patient_id'];
    // echo filter_input(INPUT_POST, 'patient_id', FILTER_SANITIZE_SPECIAL_CHARS);
    $patientID = trim(filter_input(INPUT_POST, 'patient_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientName = end(explode(" ", trim(filter_input(INPUT_POST, 'patient_name', FILTER_SANITIZE_SPECIAL_CHARS))));
    $_SESSION['tab'] = "search_by_id";

    if (empty($patientID) && empty($patientName)) {
        $_SESSION['error'] = "Please enter either patient's ID or patient's name to search";
        $connection->close();
        header("Location: index.php?page=patients");
        exit;
    }
    if (empty($patientID)) $patientID = $patientName;
    // ----------------------------------------------------------------------------------------------------------
    // ----------------------------------------------- GENERAL --------------------------------------------------
    // ----------------------------------------------------------------------------------------------------------

    $fetch_general_information = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) FULL_NAME, PHONE_NUMBER, DATE_OF_BIRTH, ADDRESS FROM $tb_patient WHERE CODE = '$patientID';";
    $general_information = mysqli_query($connection, $fetch_general_information);

    if ($general_information && mysqli_num_rows($general_information) > 0) {
        // Only one row
        $_SESSION['general'] = mysqli_fetch_all($general_information, MYSQLI_ASSOC);
    } else {
        $_SESSION['error'] = "No patient found.";
    }

    // ----------------------------------------------------------------------------------------------------------
    // ----------------------------------------------- INPATIENT ------------------------------------------------
    // ----------------------------------------------------------------------------------------------------------
    $fetch_inpatient_information = "
    WITH T AS(
        SELECT 
                II.DATE_OF_ADMISSION
                , II.DATE_OF_DISCHARGE
                , CONCAT(E.FIRST_NAME, ' ', E.LAST_NAME) NURSE_NAME
                , II.FEE
                , T.START_DATE
                , T.END_DATE
                , T.DOCTOR_CODE
                , T.RESULT
                , M.NAME
                , M.PRICE
                , T.RECOVERY
        FROM PATIENT P
            JOIN INPATIENT IP ON P.CODE = IP.CODE
            RIGHT JOIN INPATIENT_INFORMATION II ON IP.INPATIENT_CODE = II.INPATIENT_CODE
            LEFT JOIN TREATMENT T ON II.INPATIENT_CODE = T.INPATIENT_CODE
            LEFT JOIN TREATMENT_CONTAINS TC ON T.DOCTOR_CODE = TC.DOCTOR_CODE
                                        AND T.INPATIENT_CODE = TC.INPATIENT_CODE
                                        AND T.START_DATE = TC.START_DATE
                                        AND T.END_DATE = TC.END_DATE
            LEFT JOIN MEDICATION M ON TC.MEDICATION_CODE = M.CODE
            LEFT JOIN EMPLOYEE E ON E.CODE = II.NURSEID
        WHERE 1=1
            AND P.CODE = '$patientID'
            AND II.DATE_OF_ADMISSION <= Date(T.START_DATE)
            AND II.DATE_OF_DISCHARGE >= date(T.END_DATE)
        ORDER BY II.DATE_OF_ADMISSION, II.DATE_OF_DISCHARGE, START_DATE, END_DATE
    )
    SELECT T.DATE_OF_ADMISSION
            , T.DATE_OF_DISCHARGE
            , T.NURSE_NAME
            , T.FEE, 0
            , T.START_DATE
            , T.END_DATE
            , CONCAT(E.FIRST_NAME, ' ', E.LAST_NAME) DOCTOR_NAME
            , T.RESULT
            , COALESCE(T.NAME, 'None') MEDICATION_NAME
            , COALESCE(T.PRICE, 0) MEDICATION_PRICE
            , IFNULL(T.RECOVERY, 0) RECOVERY
    FROM T JOIN EMPLOYEE E ON T.DOCTOR_CODE = E.CODE;
    "; // considered as one query
    $inpatient_information = mysqli_query($connection, $fetch_inpatient_information);
    $_SESSION['inpatient'][-1]['DATE_OF_ADMISSION'] = null; // for later comparison with non-null value

    $inpatient_index = -1;
    $treatment_index = -1;
    while ($info = mysqli_fetch_assoc($inpatient_information)) {
        // --------------------------- For each new inpatient time ---------------------------
        if ($info['DATE_OF_ADMISSION'] != $_SESSION['inpatient'][$inpatient_index]['DATE_OF_ADMISSION']) {
            $inpatient_index++;
            $treatment_index = -1;
            $_SESSION['inpatient'][$inpatient_index]['NURSE_NAME'] = $info['NURSE_NAME'];
            $_SESSION['inpatient'][$inpatient_index]['FEE'] = $info['FEE'];
            $_SESSION['inpatient'][$inpatient_index]['DATE_OF_ADMISSION'] = $info['DATE_OF_ADMISSION'];
            $_SESSION['inpatient'][$inpatient_index]['DATE_OF_DISCHARGE'] = $info['DATE_OF_DISCHARGE'];

            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['START_DATE'] = null; // for later comparison with non-null value
        }
        // --------------------------- For each new treatment time ---------------------------
        if ($info['START_DATE'] != $_SESSION['inpatient'][$inpatient_index][$treatment_index]['START_DATE']) {
            $treatment_index++;
            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['START_DATE'] = $info['START_DATE'];
            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['END_DATE'] = $info['END_DATE'];
            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['RESULT'] = $info['RESULT'];
            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['RECOVERY'] = $info['RECOVERY'];

            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['DOCTOR_NAME'] = [];      // for later comparison with non-null value
            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['MEDICATION_NAME'] = [];  // for later comparison with non-null value
            $_SESSION['inpatient'][$inpatient_index][$treatment_index]['MEDICATION_PRICE'] = []; // for later comparison with non-null value
        }

        if (!in_array($info['DOCTOR_NAME'], $_SESSION['inpatient'][$inpatient_index][$treatment_index]['DOCTOR_NAME']))            // if this doctor doesn't exist
            array_push($_SESSION['inpatient'][$inpatient_index][$treatment_index]['DOCTOR_NAME'], $info['DOCTOR_NAME']);           // add into this treatment
        if (!in_array($info['MEDICATION_NAME'], $_SESSION['inpatient'][$inpatient_index][$treatment_index]['MEDICATION_NAME']))    // if this medication doesn't exist
            array_push($_SESSION['inpatient'][$inpatient_index][$treatment_index]['MEDICATION_NAME'], $info['MEDICATION_NAME']);   // add into this treatment
        if (!in_array($info['MEDICATION_PRICE'], $_SESSION['inpatient'][$inpatient_index][$treatment_index]['MEDICATION_PRICE']))  // if this price doesn't exist
            array_push($_SESSION['inpatient'][$inpatient_index][$treatment_index]['MEDICATION_PRICE'], $info['MEDICATION_PRICE']); // add into this treatment
        // => medication and its price always in the same order
    }


    // ----------------------------------------------------------------------------------------------------------
    // ----------------------------------------------- OUTPATIENT -----------------------------------------------
    // ----------------------------------------------------------------------------------------------------------
    $fetch_outpatient_information = "
    SELECT 
    E.EXAMINATION_DATE
, IFNULL(E.NEXT_EXAMINATION_DATE, 'None') NEXT_EXAMINATION_DATE
, E.FEE
, CONCAT(EMP.FIRST_NAME, ' ', EMP.LAST_NAME) DOCTOR_NAME
, E.DIAGNOSIS
, M.NAME
, M.PRICE
FROM PATIENT P
JOIN OUTPATIENT OP ON P.CODE = OP.CODE
JOIN EXAMINATION E ON OP.OUTPATIENT_CODE = E.OUTPATIENT_CODE
LEFT JOIN EXAMINATION_CONTAINS EC ON E.DOCTOR_CODE = EC.DOCTOR_CODE
                        AND E.OUTPATIENT_CODE = EC.OUTPATIENT_CODE
                        AND E.EXAMINATION_DATE = EC.EXAMINATION_DATE
LEFT JOIN MEDICATION M ON EC.MEDICATION_CODE = M.CODE
JOIN EMPLOYEE EMP ON E.DOCTOR_CODE = EMP.CODE
WHERE P.CODE = '$patientID'
ORDER BY E.EXAMINATION_DATE;
    "; // considered as one query
    $outpatient_information = mysqli_query($connection, $fetch_outpatient_information);
    $_SESSION['outpatient'][-1]['EXAMINATION_DATE'] = null; // for later comparison with non-null value

    $examination_index = -1;
    while ($info = mysqli_fetch_assoc($outpatient_information)) {
        // --------------------------- For each new examination time ---------------------------
        if ($info['EXAMINATION_DATE'] != $_SESSION['outpatient'][$examination_index]['EXAMINATION_DATE']) {
            $examination_index++;
            $_SESSION['outpatient'][$examination_index]['EXAMINATION_DATE'] = $info['EXAMINATION_DATE'];
            $_SESSION['outpatient'][$examination_index]['NEXT_EXAMINATION_DATE'] = $info['NEXT_EXAMINATION_DATE'];
            $_SESSION['outpatient'][$examination_index]['FEE'] = $info['FEE'];
            $_SESSION['outpatient'][$examination_index]['DIAGNOSIS'] = $info['DIAGNOSIS'];

            $_SESSION['outpatient'][$examination_index]['DOCTOR_NAME'] = [];      // for later comparison with non-null value
            $_SESSION['outpatient'][$examination_index]['NAME'] = [];  // for later comparison with non-null value
            $_SESSION['outpatient'][$examination_index]['PRICE'] = []; // for later comparison with non-null value
        }

        if (!in_array($info['DOCTOR_NAME'], $_SESSION['outpatient'][$examination_index]['DOCTOR_NAME']))            // if this doctor doesn't exist
            array_push($_SESSION['outpatient'][$examination_index]['DOCTOR_NAME'], $info['DOCTOR_NAME']);           // add into this treatment
        if (!in_array($info['NAME'], $_SESSION['outpatient'][$examination_index]['NAME']))    // if this medication doesn't exist
            array_push($_SESSION['outpatient'][$examination_index]['NAME'], $info['NAME']);   // add into this treatment
        if (!in_array($info['PRICE'], $_SESSION['outpatient'][$examination_index]['PRICE']))  // if this price doesn't exist
            array_push($_SESSION['outpatient'][$examination_index]['PRICE'], $info['PRICE']); // add into this treatment
        // => medication and its price always in the same order
    }
}
$connection->close();

header("Location: index.php?page=patients");
exit;
