<?php
include("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_message'] = "Invalid email format.";
        header("Location: ../index.php?page=login");
        exit();
    }

    $sql = "SELECT * FROM $tb_users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password_hash'];
        $name = $row['full_name'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $row['role'];
            $_SESSION['tab'] = "add_patient";
            header("Location: ../index.php?page=home");
            exit();
        } else {
            $_SESSION['login_message'] = "Invalid login credentials.";
            header("Location: ../index.php?page=login");
            exit();
        }
    } else {
        $_SESSION['login_message'] = "Email not found.";
        header("Location: ../index.php?page=login");
        exit();
    }

    mysqli_close($connection);
}
