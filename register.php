<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "online_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup_submit'])) {
    $signup_id = $_POST['signup_id'];
    $signup_name = $_POST['signup_name'];
    $signup_number = $_POST['signup_number'];
    $signup_email = $_POST['signup_email'];
    $signup_password = $_POST['signup_password'];
    $signup_confirm_password = $_POST['signup_confirm_password'];

    $id_check_query = "SELECT COUNT(*) as count FROM tbl_register WHERE user_id = '$signup_id'";
    $id_check_result = $conn->query($id_check_query);
    $id_check_row = $id_check_result->fetch_assoc();

    if ($id_check_row['count'] > 0) {
        echo '<script>
                alert("Error: ID is already taken. Please choose a different ID.");
                window.location.href = "register.html";
            </script>';
        exit();
    }

    // Check if the email already exists
    $email_check_query = "SELECT COUNT(*) as count FROM tbl_register WHERE user_email = '$signup_email'";
    $email_check_result = $conn->query($email_check_query);
    $email_check_row = $email_check_result->fetch_assoc();

    if ($email_check_row['count'] > 0) {
        echo '<script>
                alert("Error: Email is already taken. Please choose a different email.");
                window.location.href = "register.html";
            </script>';
        exit();
    }

    // Check if passwords match
    if ($signup_password !== $signup_confirm_password) {
        echo '<script>
                alert("Error: Passwords do not match.");
                window.location.href = "register.html";
            </script>';
        exit();
    }

    $insert_query = "INSERT INTO tbl_register (user_id, user_name, user_number, user_email, user_pass) VALUES ('$signup_id', '$signup_name', '$signup_number', '$signup_email', '$signup_password')";
    if ($conn->query($insert_query) === TRUE) {

        session_start();
        $_SESSION['user_id'] = $signup_id;
        echo '<script>
                alert("Successfully registered.");
                window.location.href = "register.html";
            </script>';
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
