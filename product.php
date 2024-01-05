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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="product.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="shorcut icon" type="image" href="logo.png">
  <title>Products</title>
</head>
<body>

<?php
include 'navbar.php';

// Connect to the database
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'online_store';

// Create a new PDO connection
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}

if (isset($_POST['buy'])) {
  $cartItems = json_decode($_POST['cart_items'], true);

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT user_addr FROM tbl_register WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user['user_addr'] === null) {
        echo '<script>
                var message = "Please update your address before buying items.";
                if (confirm(message)) {
                    window.location.href = "profile.php";
                } else {
                    window.location.href = "product.php";
                }
              </script>';
        exit();
    }

  // Initialize variables for total price, product names, prices, and quantities
  $totalPrice = 0;
  $productNames = [];
  $productPrices = [];
  $productQuantities = [];

  foreach ($cartItems as $item) {
    $productName = $item['name'];
    $price = $item['price'];
    $totalPrice += $item['price'] * $item['quantity'];
    $quantity = $item['quantity'];

    // Add product details to respective arrays
    $productNames[] = $productName;
    $productPrices[] = $price;
    $productQuantities[] = $quantity;
  }

  // Combine product details into strings with new lines
  $combinedProductNames = implode(PHP_EOL, $productNames);
  $combinedProductPrices = implode(PHP_EOL, $productPrices);
  $combinedProductQuantities = implode(PHP_EOL, $productQuantities);

  // Display a prompt for payment only if the total price is greater than 0
  if ($totalPrice > 0) {
    echo '<input type="hidden" id="paymentNumber" value="' . $totalPrice . '">';

echo '<script>
  var paymentNumber = ' . $totalPrice . ';
  var userInput = prompt("Please make a payment of RM" + paymentNumber + ".");

  if (userInput === null) {
    alert("Order Cancelled: No payment made.");
    window.location.href = "product.php";
  } else if (parseInt(userInput) < paymentNumber) {
    var amountShort = paymentNumber - parseInt(userInput);
    alert("Order Cancelled: Not enough money. You are short of: RM" + amountShort);
    window.location.href = "product.php";
  } else {
    var moneyBalance = parseInt(userInput) - paymentNumber;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "insert_product.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        if (moneyBalance === 0) {
          alert("Order Success");
        } else {
          alert("Order Success: Your money balance: RM" + moneyBalance + " is sent back to your account.");
        }
        window.location.href = "product.php";
      }
    };
    xhr.send("product_name=' . urlencode($combinedProductNames) . '&product_price=' . urlencode($combinedProductPrices) . '&quantity=' . urlencode($combinedProductQuantities) . '&total_price=' . urlencode($totalPrice) . '");
  }
</script>';

  } else {
    echo '<script>
      alert("No items in the cart. Order cannot be processed.");
      window.location.href = "product.php";
    </script>';
  }

  exit();
}
?>


<div class="wrapper1">
  <div class="container">
    <div class="top"></div>
    <div class="bottom1">
      <div class="left">
        <div class="details">
          <h1>Daim</h1>
          <p>RM17</p>
        </div>
        <div class="buy" onclick="addToCart('Daim', 17, 'pdt/daim.png')"><i class="fas fa-shopping-cart add-cart"></i></div>
      </div>
    </div>
  </div>
  <div class="inside">
    <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
    <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Daim</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Milk Chocolate</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>200g</td>
        </tr>
      </table>
    </div>
  </div>
</div>

  <div class="wrapper2">
    <div class="container">
      <div class="top"></div>
      <div class="bottom2">
        <div class="left">
          <div class="details">
            <h1>Toblerone</h1>
            <p>RM14</p>
          </div>
          <div class="buy" onclick="addToCart('Toblerone', 14, 'pdt/toblerone.png')"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </div>
    <div class="inside">
      <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
      <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Toblerone</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Milk Chocolate</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>200g</td>
        </tr>
      </table>
      </div>
    </div>
  </div>

  <div class="wrapper3">
    <div class="container">
      <div class="top"></div>
      <div class="bottom3">
        <div class="left">
          <div class="details">
            <h1>Hershey's</h1>
            <p>RM20</p>
          </div>
          <div class="buy" onclick="addToCart('Hersheys Nuggets', 15, 'pdt/hershey.png')"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </div>
    <div class="inside">
      <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
      <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Hersheys</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Creamy Milk Chocolate</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>447g</td>
        </tr>
      </table>
      </div>
    </div>
  </div>

  <div class="wrapper4">
    <div class="container">
      <div class="top"></div>
      <div class="bottom4">
        <div class="left">
          <div class="details">
            <h1>Ferrero</h1>
            <p>RM55</p>
          </div>
          <div class="buy" onclick="addToCart('Ferrero Rocher', 55, 'pdt/ferrero.png')"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </div>
    <div class="inside">
      <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
      <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Ferrero Rocher</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Milk Chocolate</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>400g</td>
        </tr>
      </table>
      </div>
    </div>
  </div>

  <div class="wrapper5">
    <div class="container">
      <div class="top"></div>
      <div class="bottom5">
        <div class="left">
          <div class="details">
            <h1>Almond</h1>
            <p>RM18</p>
          </div>
          <div class="buy" onclick="addToCart('Almond Gold', 18, 'pdt/almond.png')"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </div>
    <div class="inside">
      <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
      <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Almond</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Milk Cocoa</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>180g</td>
        </tr>
      </table>
      </div>
    </div>
  </div>

    <div class="wrapper6">
    <div class="container">
      <div class="top"></div>
      <div class="bottom6">
        <div class="left">
          <div class="details">
            <h1>Peppero</h1>
            <p>RM27</p>
          </div>
          <div class="buy" onclick="addToCart('Peppero', 27, 'pdt/peppero.png')"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </div>
    <div class="inside">
      <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
      <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Peppero</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Milk Chocolate</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>256g</td>
        </tr>
      </table>
      </div>
    </div>
  </div>

    <div class="wrapper7">
    <div class="container">
      <div class="top"></div>
      <div class="bottom7">
        <div class="left">
          <div class="details">
            <h1>Malteser</h1>
            <p>RM12</p>
          </div>
          <div class="buy" onclick="addToCart('Malteser', 12, 'pdt/malteser.png')"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </div>
    <div class="inside">
      <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
      <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Maltesers</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Milk Chocolate</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>150g</td>
        </tr>
      </table>
      </div>
    </div>
  </div>

    <div class="wrapper8">
    <div class="container">
      <div class="top"></div>
      <div class="bottom8">
        <div class="left">
          <div class="details">
            <h1>Kinder</h1>
            <p>RM15</p>
          </div>
          <div class="buy" onclick="addToCart('Kinder Bueno', 15, 'pdt/kinder.png')"><i class="fas fa-shopping-cart"></i></div>
        </div>
      </div>
    </div>
    <div class="inside">
      <div class="icon"><i class="fas fa-info-circle fa-lg"></i></div>
      <div class="contents">
      <table>
        <tr>
          <th><br>Brand</th>
        </tr>
        <tr>
          <td>Kinder</td>
        </tr>
        <tr>
          <th><br>Flavour</th>
        </tr>
        <tr>
          <td>Milk Chocolate</td>
        </tr>
        <tr>
          <th><br>Weight</th>
        </tr>
        <tr>
          <td>129g</td>
        </tr>
      </table>
      </div>
    </div>
  </div>


  <script>
    let cart = [];

    function addToCart(productName, price, imagePath) {
      const existingItem = cart.find(item => item.name === productName);
      if (existingItem) {
        existingItem.quantity++;
      } else {
        cart.push({ name: productName, price: price, quantity: 1, image: imagePath });
      }

      showCart();

      console.log("Product Name:", productName);
      console.log("Price:", price);
    }

    function toggleCartItemCount(show) {
      var cartItemCount = document.getElementById("cart-item-count");
      if (show) {
        cartItemCount.classList.add("show");
      } else {
        cartItemCount.classList.remove("show");
      }
    }


    function showCart() {
      const cartDisplay = document.getElementById("cart");
      const cartItemsList = document.getElementById("cart-items");
      const cartTotal = document.getElementById("cart-total");
      const cartItemsInput = document.getElementById("cart-items-input");
      const cartItemCount = document.getElementById("cart-item-count");

      cartItemsList.innerHTML = "";
      cartItemCount.textContent = cart.length;

      for (let item of cart) {
        const listItem = document.createElement("li");

        const quantityContainer = document.createElement("div");
        quantityContainer.classList.add("quantity-container");

        const minusBtn = document.createElement("button");
        minusBtn.textContent = "-";
        minusBtn.addEventListener("click", () => decreaseQuantity(item));
        quantityContainer.appendChild(minusBtn);

        const quantityInput = document.createElement("input");
        quantityInput.type = "number";
        quantityInput.min = 1;
        quantityInput.value = item.quantity;
        quantityInput.addEventListener("change", () => updateQuantity(item, quantityInput.value));
        quantityContainer.appendChild(quantityInput);

        const plusBtn = document.createElement("button");
        plusBtn.textContent = "+";
        plusBtn.addEventListener("click", () => increaseQuantity(item));
        quantityContainer.appendChild(plusBtn);

        const image = document.createElement("img");
        image.src = item.image;
        image.alt = item.name;
        image.classList.add("cart-item-image");

        listItem.appendChild(image);

        const itemDetails = document.createElement("div");
        itemDetails.classList.add("item-details");

        const itemName = document.createElement("span");
        itemName.textContent = item.name;

        const itemPrice = document.createElement("span");
        itemPrice.textContent = ` - RM${item.price}`;

        itemDetails.appendChild(itemName);
        itemDetails.appendChild(itemPrice);
        listItem.appendChild(itemDetails);

        listItem.appendChild(quantityContainer);

        cartItemsList.appendChild(listItem);
      }

      const totalPrice = cart.reduce((total, item) => total + item.price * item.quantity, 0);
      cartTotal.textContent = `Total: RM${totalPrice}`;

      cartItemsInput.value = JSON.stringify(cart);

      if (cart.length > 0) {
      toggleCartItemCount(true);
    } else {
      toggleCartItemCount(false);
    }

      cartDisplay.style.display = "block";
    }

    function increaseQuantity(item) {
      item.quantity++;
      showCart();
    }

    function decreaseQuantity(item) {
      if (item.quantity > 1) {
        item.quantity--;
      } else {
        const itemIndex = cart.findIndex(cartItem => cartItem === item);
        if (itemIndex !== -1) {
          cart.splice(itemIndex, 1);
        }
      }
      showCart();
    }

    function updateQuantity(item, newQuantity) {
      item.quantity = parseInt(newQuantity);
      showCart();
    }


    function toggleCart() {
      var currentPage = window.location.href;
      var cartBox = document.getElementById("cart-box");

      if (currentPage.includes("product.php")) {
        if (cartBox.style.display === "none") {
          cartBox.style.display = "block";
          cartBox.classList.add("show");
          cartBox.classList.remove("hide");
        } else {
          cartBox.classList.add("hide");
          cartBox.classList.remove("show");

          setTimeout(function () {
            cartBox.style.display = "none";
          }, 300);
        }
      } else {
        window.location.href = "product.php";
      }
    }
  </script>
</body>
</html>
