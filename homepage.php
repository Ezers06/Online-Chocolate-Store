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
  <title>Homepage</title>
  <link rel="stylesheet" type="text/css" href="homepage.css">
  <link rel="shorcut icon" type="image" href="logo.png">
</head>
<body>
<?php
include 'navbar.php';
?>

<section class="upper">
  <div class="upper-content">
    <h1 class="main-heading">Indulge in Exquisite Chocolates at Ezers Store</h1>
    <p class="buy-text">Discover our premium selection of chocolates, crafted from the finest ingredients. Treat yourself or your loved ones to a delightful experience of rich flavors and luxurious textures.</p>
    <a href="product.php" class="buy-button">
      <span class="buy-text">Shop Now</span>
      <span class="buy-icon">&#8594;</span>
    </a>
  </div>
</section>



<section class="featured-product">
  <h2 class="section-title">Featured Product</h2>
  <div class="profile-card">
    <div class="product-image">
      <img src="pdt/toblerone.png" alt="Toblerone">
    </div>
    <div class="product-details">
      <h2 class="product-title">Toblerone</h2>
      <p class="product-description">Indulge in the exquisite taste of Toblerone, crafted from the finest raw materials. Let its unique flavor awaken your senses.</p>
      <p class="product-price">RM14</p>
      <a href="product.php" class="buy-button">Buy Now</a>
    </div>
  </div>

  <div class="profile-card">
    <div class="product-image">
      <img src="pdt/hershey.png" alt="Hershey Nuggets">
    </div>
    <div class="product-details">
      <h2 class="product-title">Hershey Nuggets</h2>
      <p class="product-description">Hershey's Nuggets Extra Creamy Milk Chocolate With Toffee And Almonds make it better for your daily comsumable.</p>
      <p class="product-price">RM20</p>
      <a href="product.php" class="buy-button">Buy Now</a>
    </div>
  </div>

  <div class="profile-card">
    <div class="product-image">
      <img src="pdt/ferrero.png" alt="Ferrero Rocher">
    </div>
    <div class="product-details">
      <h2 class="product-title">Ferrero Rocher</h2>
      <p class="product-description">A whole crunchy hazelnut in the heart, a delicious creamy hazelnut filling, a crisp wafer shell covered with chocolate and gently roasted pieces.</p>
      <p class="product-price">RM55</p>
      <a href="product.php" class="buy-button">Buy Now</a>
    </div>
  </div>
</section>

</body>
</html>
