<?php
include("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $patientID =  trim(filter_input(INPUT_POST, 'patient_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $patientName = end(explode(" ", trim(filter_input(INPUT_POST, 'patient_name', FILTER_SANITIZE_SPECIAL_CHARS))));
    $_SESSION['tab'] = "search_fee";

    if (empty($patientID) && empty($patientName)) {
        $_SESSION['fee_error'] = "Please enter either the patient's ID or name to search.";
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
        $_SESSION['fee_general'] = mysqli_fetch_all($general_information, MYSQLI_ASSOC);
    } else {
        $_SESSION['fee_error'] = "No patient found.";
        unset($_SESSION['fee']);
        $connection->close();
        header("Location: index.php?page=patients");
        exit;
    }

    // ----------------------------------------------------------------------------------------------------------
    // ----------------------------------------------- INPATIENT ------------------------------------------------
    // ----------------------------------------------------------------------------------------------------------
    $fetch_fees = "
    -- --------------------------- FOR INPATIENT ---------------------------

SELECT  'TREATMENT' TYPE
        , II.DATE_OF_ADMISSION DATE_BEGIN
        , II.DATE_OF_DISCHARGE DATE_END
 		, II.FEE
        , COALESCE(SUM(M.PRICE), 0) TOTAL_MEDICAL_PRICE
		, II.FEE + COALESCE(SUM(M.PRICE), 0) TOTAL_FEE
FROM PATIENT P
	JOIN INPATIENT IP ON P.CODE = IP.CODE
	JOIN INPATIENT_INFORMATION II ON IP.INPATIENT_CODE = II.INPATIENT_CODE
    JOIN TREATMENT T ON 1=1 
					AND IP.INPATIENT_CODE = T.INPATIENT_CODE
                    AND II.DATE_OF_ADMISSION <= T.START_DATE
                    AND II.DATE_OF_DISCHARGE >= T.END_DATE
	LEFT JOIN TREATMENT_CONTAINS TC ON 1=1 
		AND T.DOCTOR_CODE = TC.DOCTOR_CODE
		AND T.INPATIENT_CODE = TC.INPATIENT_CODE
		AND T.START_DATE = TC.START_DATE
		AND T.END_DATE = TC.END_DATE
	LEFT JOIN MEDICATION M ON TC.MEDICATION_CODE = M.CODE
WHERE P.CODE = 'GP000000001'
GROUP BY II.DATE_OF_ADMISSION
        , II.DATE_OF_DISCHARGE
		, II.FEE
        
        
        
UNION
-- --------------------------- FOR OUTPATIENT ---------------------------

SELECT 'EXAMINATION'
	, E.EXAMINATION_DATE
	, COALESCE(E.NEXT_EXAMINATION_DATE, 'None') NEXT_EXAMINATION_DATE
	, E.FEE
	, SUM(M.PRICE) TOTAL_MEDICAL_PRICE
	, E.FEE + SUM(M.PRICE) TOTAL_FEE
FROM PATIENT P
	JOIN OUTPATIENT OP ON P.CODE = OP.CODE
	JOIN EXAMINATION E ON OP.OUTPATIENT_CODE = E.OUTPATIENT_CODE
	JOIN EXAMINATION_CONTAINS EC ON 1=1 
		AND E.DOCTOR_CODE = EC.DOCTOR_CODE
		AND E.OUTPATIENT_CODE = EC.OUTPATIENT_CODE
		AND E.EXAMINATION_DATE = EC.EXAMINATION_DATE
	JOIN MEDICATION M ON EC.MEDICATION_CODE = M.CODE
WHERE P.CODE = 'GP000000001'
GROUP BY E.EXAMINATION_DATE
	, NEXT_EXAMINATION_DATE
	, E.FEE
ORDER BY TYPE, DATE_BEGIN, DATE_END, TOTAL_FEE;
    "; // considered as one query
    $fees = mysqli_query($connection, $fetch_fees);

    $type_index = -1;
    $detail_index = -1;
    $index = 0;
    while ($info = mysqli_fetch_assoc($fees)) {
        $_SESSION['fee'][$index]['TYPE'] = $info['TYPE'];
        $_SESSION['fee'][$index]['DATE_BEGIN'] = $info['DATE_BEGIN'];
        $_SESSION['fee'][$index]['DATE_END'] = $info['DATE_END'];
        $_SESSION['fee'][$index]['FEE'] = $info['FEE'];
        $_SESSION['fee'][$index]['TOTAL_MEDICAL_PRICE'] = $info['TOTAL_MEDICAL_PRICE'];
        $_SESSION['fee'][$index]['TOTAL_FEE'] = $info['TOTAL_FEE'];
        $index++;
    }
}
$connection->close();
header("Location: index.php?page=patients");
exit;
