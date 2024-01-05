<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo '<script>
            var message = "Create an Account or Login First";
            alert(message);
            window.location.href = "register.html";
          </script>';
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="shorcut icon" type="image" href="logo.png">
</head>
<body>
    <?php

    include 'navbar.php';

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "online_store";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        function updateUser($conn, $userId, $name, $number, $email, $password, $userAddr) {
            $stmt = $conn->prepare("UPDATE tbl_register SET user_name = ?, user_number = ?, user_email = ?, user_pass = ?, user_addr = ? WHERE user_id = ?");
            $stmt->bind_param("ssssss", $name, $number, $email, $password, $userAddr, $userId);
            $stmt->execute();
            $stmt->close();
        }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userAddr = $_POST['address'];

    $stmt = $conn->prepare("SELECT * FROM tbl_register WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $updatedUser = $result->fetch_assoc();

        $fieldsModified = false;

        if ($name !== $updatedUser['user_name'] || $number !== $updatedUser['user_number'] || $email !== $updatedUser['user_email'] || $password !== $updatedUser['user_pass'] || $userAddr !== $updatedUser['user_addr']) {
            $fieldsModified = true;
        }

        if ($fieldsModified) {
            updateUser($conn, $user_id, $name, $number, $email, $password, $userAddr);

            echo "<script>alert('Profile updated successfully!');</script>";
        } else {
            echo "<script>alert('No changes were made.');</script>";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
}


        $stmt = $conn->prepare("SELECT * FROM tbl_register WHERE user_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            ?>

            <?php
        } else {
            echo "User not found.";
        }

        $conn->close();
    } else {
        echo "User ID not set.";
    }
    ?>

            <div class="profile-container">
                <div class="profile-card">
                    <div id="original-profile">
                        <h2 class="profile-title"><i class="fas fa-user"></i>Your Profile</h2>
                        <p><strong><i class="fas fa-id-badge"></i>Your ID :</strong> <?php echo $user['user_id']; ?></p>
                        <p><strong><i class="fas fa-user"></i>Your Name :</strong> <?php echo $user['user_name']; ?></p>
                        <p><strong><i class="fas fa-phone fa-rotate-90"></i>Your Number :</strong> <?php echo $user['user_number']; ?></p>
                        <p><strong><i class="fas fa-envelope"></i>Your Email :</strong> <?php echo $user['user_email']; ?></p>
                        <p><strong><i class="fas fa-map-marker-alt"></i>Your Address :</strong> <?php echo $user['user_addr'] ?? '<span style="color: red; font-size: 16px; font-family: Times New Roman, sans-serif;">Address Not Set Yet!!!</span>'; ?></p>
                        <p><strong><i class="fas fa-lock"></i>Your Password :</strong>
                            <span id="password-value" style="display: none;"><?php echo $user['user_pass']; ?></span>
                            <i id="password-toggle-icon" class="toggle-password fas fa-eye" onclick="togglePassword()"></i>
                        </p>

                    </div>

                    <div id="update-form" style="display: none;">
                        <h2 class="profile-title"><i class="fas fa-user"></i>Update Profile</h2>

                        <form method="post" action="">
                            <p><strong><i class="fas fa-id-badge"></i>Your ID :</strong> <?php echo $user['user_id']; ?> </p> <br>
                            <span style="color: red; font-size: 16px; text-align: center; font-family: 'Times New Roman', sans-serif; display: inline-block; width: 100%;">Note: ID Cannot Be Changed!</span>

                            <p><strong><i class="fas fa-user"></i>Your Name :</strong> <input class="textbox" type="text" name="name" value="<?php echo $user['user_name']; ?>"></p>
                            <p><strong><i class="fas fa-phone fa-rotate-90"></i>Your Number :</strong> <input class="textbox" type="text" name="number" value="<?php echo $user['user_number']; ?>"></p>
                            <p><strong><i class="fas fa-envelope"></i>Your Email :</strong> <input class="textbox" type="email" name="email" value="<?php echo $user['user_email']; ?>"></p>
                            <p><strong><i class="fas fa-map-marker-alt"></i>Your Address :</strong> <input class="textbox" type="text" name="address" value="<?php echo $user['user_addr']; ?>"></p>
                            <p><strong><i class="fas fa-lock"></i>Your Password :</strong>
                                <input class="textbox" id="password-input" type="password" name="password" value="<?php echo $user['user_pass']; ?>">
                                <i id="eye-icon" class="eye-icon fas fa-eye" onclick="togglePasswordVisibility()"></i>
                            </p>

                            <input class="update-button" type="submit" value="Update" onclick="showAlert()">
                        </form>
                    </div>

                    <button class="edit-button" onclick="toggleProfileForm()">Edit Profile</button>
                </div>
            </div>
            
    <script>
        function toggleProfileForm() {
            var originalProfile = document.getElementById("original-profile");
            var updateForm = document.getElementById("update-form");
            var editButton = document.getElementsByClassName("edit-button")[0];

            if (originalProfile.style.display === "none") {
                originalProfile.style.display = "block";
                updateForm.style.display = "none";
                editButton.innerHTML = "Edit Profile";
            } else {
                originalProfile.style.display = "none";
                updateForm.style.display = "block";
                editButton.innerHTML = "Cancel";
            }
        }

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password-input");
            var eyeIcon = document.getElementById("eye-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        function togglePassword() {
            var passwordValue = document.getElementById("password-value");
            var passwordToggleIcon = document.getElementById("password-toggle-icon");

            if (passwordValue.style.display === "none") {
                passwordValue.style.display = "inline-block";
                passwordToggleIcon.classList.remove("fa-eye-slash");
                passwordToggleIcon.classList.add("fa-eye");
            } else {
                passwordValue.style.display = "none";
                passwordToggleIcon.classList.remove("fa-eye");
                passwordToggleIcon.classList.add("fa-eye-slash");
            }
        }


    </script>
</body>
</html>
