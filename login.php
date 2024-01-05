<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "online_store";

session_start();

if (isset($_POST['login'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_POST['user_id'];
    $user_pass = $_POST['user_pass'];

    $stmt = $conn->prepare("SELECT * FROM tbl_register WHERE user_id=? AND user_pass=?");
    $stmt->bind_param("ss", $user_id, $user_pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];

        header("Location: homepage.php");
        exit();
    } else {
        echo '<script>
                alert("Invalid User ID or password.")
                window.location.href = "register.html";
            ;</script>';
    }

    $stmt->close();
    $conn->close();
}
?>
