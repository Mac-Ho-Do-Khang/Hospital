<?php
// Set 'home' as the default page if no 'page' parameter is provided
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        include 'php/home.php';
        break;

    case 'myCVs':
        include 'php/myCVs.php';
        break;

    case 'viewCVs':
        include 'php/viewCVs.php';
        break;

    case 'patients':
        include 'php/patients.php';
        break;

    case 'add_patients':
        include 'php/add_patients.php';
        break;

    case 'search_by_id':
        include 'php/search_by_id.php';
        break;

    case 'search_by_doctor':
        include 'php/search_by_doctor.php';
        break;

    case 'search_fee':
        include 'php/search_fee.php';
        break;

    case 'login':
        include 'php/login.php';
        break;

    case 'logout':
        include 'php/logout.php';
        break;

    case 'register':
        include 'php/register.php';
        break;

    default:
        include 'php/404.php';  // 404 error page if no valid page is found
        break;
}
