<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #F99133;
      background-size: 50% 100%;
      padding: 10px;
      margin: 0;
    }

    .navbar a {
      background-color: #FBEEE6;
      margin-right: 10px;
      font-size: 18px;
      border-radius: 50px;
    }


    .left-links {
      display: flex;
      align-items: center;
    }

    .logo {
      margin-right: 10px;
      flex: 0 0 auto;
      max-width: 100px;
      max-height: 100px;
      border-radius: 30px;
    }

    .right-links {
      display: flex;
      align-items: center;
      position: relative;
    }

    .cart-button {
      background-color: #FBEEE6;
      padding: 5px 10px;
      border-radius: 50px;
      margin-right: 10px;
      cursor: pointer;
    }

    .cart-box {
      position: fixed;
      top: 120px;
      right: 0;
      bottom: 0;
      width: 300px;
      background-color: #FBEEE6;
      padding: 20px;
      border-radius: 5px;
      display: none;
      overflow-y: auto;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      animation-duration: 0.3s;
      animation-fill-mode: both;
      animation-timing-function: ease-out;
      z-index: 999;
    }

    .cart-box.show {
      display: block;
      animation-name: slideIn;
    }

    .cart-box.hide {
      animation-name: slideOut;
    }

    .cart-box ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      margin-top: 10px;
      border: 1px solid #D35400;
      background-color: #FCF3CF;
    }

    h2 {
      color: #000;
      font-size: 24px;
      margin: 0;
      padding: 10px 0;
      border: 1px solid #000;
      text-align: center;
      border-radius: 5px;
    }

    .item-details {
      margin-left: 50px;
      margin-top: 30px;
      margin-bottom: 30px;
      font-size: 15px;
    }

    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    .cart-item-image {
      position: absolute;
      width: 60px;
      height: 60px;
      object-fit: contain;
      margin-right: 20px;
      display: grid;
      margin-left: 20px;
      margin-top: -10px;
      margin-bottom: 20px;
      border: 1px solid #000;
    }

    #cart-total {
      margin-top: 10px;
      text-align: center;
      font-size: 18px;
      padding-top: 10px;
    }

    #cart-total:before {
      content: "";
      display: block;
      width: 150px;
      height: 3px;
      background-color: #E59866;
      margin: 0 auto;
      margin-bottom: 10px;
    }

    #cart-total:after {
      content: "";
      display: block;
      width: 150px;
      height: 3px;
      background-color: #E59866;
      margin: 0 auto;
      margin-top: 10px;
    }

    #cart-total span {
      display: inline-block;
      background-color: #FBEEE6;
      padding: 5px 10px;
      border-radius: 50px;
      font-weight: bold;
      color: #E59866;
    }

    @keyframes slideIn {
      0% {
        transform: translateX(100%);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes slideOut {
      0% {
        transform: translateX(0);
        opacity: 1;
      }
      100% {
        transform: translateX(100%);
        opacity: 0;
      }
    }

    .buy-button {
      background-color: #8B4513;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 5px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .buy-button:hover {
      background-color: #A0522D;
    }

    .buy-button:active {
      background-color: #61380B;
    }

  .search-container {
    text-align: center;
    margin-bottom: -10px;
    position: relative;
    z-index: 999;
  }

  .search-container input[type="text"] {
    padding: 5px 10px;
    border-radius: 50px;
    font-size: 16px;
    border: 1px solid #ccc;
    margin-right: 10px;
    margin-bottom: 10px;
  }

  .search-container ul {
    list-style-type: none;
    right: 5px;
    padding: 0;
    margin: 0;
    max-width: 300px;
    margin: 10px auto;
    text-align: left;
    position: absolute;
    z-index: 999;
    width: 230px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
  }

  .search-container ul li {
    padding: 5px;
    cursor: pointer;
  }

  .search-container ul li:hover {
    background-color: #ddd;
  }


  .suggestion-image {
    width: 40px;
    height: 40px;
    margin-right: 5px;
  }

  .suggestion-details {
    margin-bottom: 20px;
    display: inline-block;
    vertical-align: middle;
  }

  .hide {
    display: none;
  }


  #cart-item-count {
    background-color: #ff0000;
    color: #ffffff;
    padding: 4px 8px;
    border-radius: 50%;
    font-size: 12px;
    position: absolute;
    top: -5px;
    right: 90px;
    display: none;
  }

  #cart-item-count.show {
    display: inline-block;
  }

  .user-id {
    font-family: "Arial" , sans-serif;
    color: #000;
    font-size: 16px;
    font-weight: bold;
  }


</style>

</head>

<body>
  <div class="navbar">
    <div class="left-links">
      <img src="logo.png" alt="Ezers Store" class="logo">
      <a href="homepage.php">Home</a>
      <a href="product.php">Products</a>
    </div>
    <div class="right-links">

      <?php
        $currentPage = basename($_SERVER['PHP_SELF']);
        if ($currentPage !== 'product.php') {
      ?>
      <div class="search-container">
        <input type="text" id="search-input" oninput="searchProducts()" placeholder="Search Products">
        <ul id="suggestions"></ul>
      </div>
      <?php } ?>

      <a href="profile.php"><i class="fas fa-user"><span class="user-id">  <?php echo $_SESSION['user_id']; ?></span></i></a>
      <a href="contact.php"><i class="fas fa-envelope"></i></a>

      <form method="POST" action="">
        <div class="cart-button" onclick="toggleCart()">
         <i class="fas fa-shopping-cart"></i>
         <span id="cart-item-count"></span>
        </div>

        <div class="cart-box" id="cart-box">
          <h2>Your Cart</h2>
          <ul id="cart-items"></ul>
          <p id="cart-total"></p>
          <input type="hidden" name="cart_items" id="cart-items-input">
          <button class="buy-button" type="submit" name="buy">Buy Now</button>
        </div>
      </form>

      <a href="logout.php">Logout</a>
    </div>
  </div>

  <script>
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

    function selectSuggestion(product) {
  window.location.href = 'product.php?name=' + encodeURIComponent(product.name);
}


function searchProducts() {
  const searchInput = document.getElementById('search-input');
  const query = searchInput.value.toLowerCase().trim();
  const suggestionsList = document.getElementById('suggestions');
  suggestionsList.innerHTML = '';

  if (query.length === 0) {
    return;
  }

  const products = [
    { name: 'Daim', price: 17, image: 'pdt/daim.png' },
    { name: 'Toblerone', price: 14, image: 'pdt/toblerone.png' },
    { name: 'Hershey Nugget', price: 20, image: 'pdt/hershey.png' },
    { name: 'Ferrero Rocher', price: 55, image: 'pdt/ferrero.png' },
    { name: 'Almond Gold', price: 18, image: 'pdt/almond.png' },
    { name: 'Peppero', price: 27, image: 'pdt/peppero.png' },
    { name: 'Maltesers', price: 12, image: 'pdt/malteser.png' },
    { name: 'Kinder Bueno', price: 15, image: 'pdt/toblerone.png' }
  ];

  const filteredProducts = products.filter(product => {
    const productName = product.name.toLowerCase();
    return productName.includes(query);
  });

  const sortedProducts = filteredProducts.sort((a, b) => {
    const productNameA = a.name.toLowerCase();
    const productNameB = b.name.toLowerCase();
    const startsWithQueryA = productNameA.startsWith(query);
    const startsWithQueryB = productNameB.startsWith(query);

    if (startsWithQueryA && !startsWithQueryB) {
      return -1;
    } else if (!startsWithQueryA && startsWithQueryB) {
      return 1;
    } else {
      return productNameA.localeCompare(productNameB);
    }
  });

  sortedProducts.forEach(product => {
    const listItem = document.createElement('li');
    listItem.addEventListener('click', () => selectSuggestion(product));

    const image = document.createElement('img');
    image.src = product.image;
    image.alt = product.name;
    image.classList.add('suggestion-image');
    listItem.appendChild(image);

    const detailsContainer = document.createElement('div');
    detailsContainer.classList.add('suggestion-details');

    const name = document.createElement('span');
    name.textContent = product.name;
    detailsContainer.appendChild(name);

    const price = document.createElement('span');
    price.textContent = ' - RM' + product.price;
    detailsContainer.appendChild(price);

    listItem.appendChild(detailsContainer);
    suggestionsList.appendChild(listItem);
  });

  suggestionsList.style.display = 'block';
}

  </script>
</body>
</html>
