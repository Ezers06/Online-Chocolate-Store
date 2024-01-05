<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "online_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user details from the database
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query to fetch user details
    $user_query = "SELECT user_name, user_email, user_number FROM tbl_register WHERE user_id = '$user_id'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_name = $user_row['user_name'];
        $user_email = $user_row['user_email'];
        $user_number = $user_row['user_number'];
    }
}

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
  <title>Contact Us</title>
  <link rel="stylesheet" type="text/css" href="contact.css">
  <link rel="shorcut icon" type="image" href="logo.png">
</head>
<body>
<?php
include 'navbar.php';
?>

<div class="background">
  <div class="container">
    <div class="screen">
      <div class="screen-header">
        <div class="screen-header-left">
          <div class="screen-header-button close"></div>
          <div class="screen-header-button maximize"></div>
          <div class="screen-header-button minimize"></div>
        </div>
        <div class="screen-header-right">
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
        </div>
      </div>
      <div class="screen-body">
        <div class="screen-body-item left">
          <div class="app-title">
            <span>CONTACT</span>
            <span>US</span>
          </div>
          <div class="app-contact">CONTACT INFO : +60 11 37064754</div>
        </div>
        <div class="screen-body-item">
          <form class="app-form" action="send_email.php" method="POST">
              <div class="app-form-group">
                <label for="name" style="display: block; font-weight: bold; margin-bottom: 5px; position: absolute;
                top: 97px; right: 300px;" class="label">NAME:</label>
                <input id="name" class="app-form-control" name="name" placeholder="NAME" value="<?php echo isset($user_name) ? $user_name : ''; ?>">
              </div>
              <div class="app-form-group">
                <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px; position: absolute;
                top: 150px; right: 300px;" class="label">EMAIL:</label>
                <input id="email" class="app-form-control" name="email" placeholder="EMAIL" value="<?php echo isset($user_email) ? $user_email : ''; ?>">
              </div>
              <div class="app-form-group">
                <label for="contact" style="display: block; font-weight: bold; margin-bottom: 5px; position: absolute;
                top: 201px; right: 300px;" class="label">CONTACT NO:</label>
                <input id="contact" class="app-form-control" name="contact" placeholder="CONTACT NO" value="<?php echo isset($user_number) ? $user_number : ''; ?>">
              </div>
              <div class="app-form-group message">
                <label for="message" style="display: block; font-weight: bold; margin-bottom: 5px; position: absolute;
                top: 280px; right: 300px;" class="label">MESSAGE:</label>
                <input id="message" class="app-form-control" name="message" placeholder="CHAT US">
              </div>
            <div class="app-form-group buttons">
              <button type="button" class="app-form-button" onclick="cancelForm()">CANCEL</button>
              <button class="app-form-button">SEND</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function cancelForm() {
  window.location.href = "homepage.php";
}
</script>

</body>
</html>
