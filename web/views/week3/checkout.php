<?=$top_stuff?>
  <link rel="stylesheet" href="../../resources/css/week3.css">
    <title>W3: Shopping Cart</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <h1>Checkout</h1>
<?php
  if(isset($_SESSION["message"])) {
    echo $_SESSION["message"];
  }
?>
        <div class="btn-div">
          <a href="?action=cart" alt="Return to Cart">Back to Cart</a>
        </div>
        <div class="">
          <form action="../../controllers/week3/" method="POST">
            <p><label for="firstName">First Name</label><br><input type="text" name="firstName" placeholder="ex. Johnny" required></p>
            <p><label for="lastName">Last Name</label><br><input type="text" name="lastName" placeholder="ex. Appleseed" required></p>
            <p><label for="address">Street Address</label><br><input type="text" name="address" placeholder="ex. 123 First St." required></p>
            <p><label for="city">City</label><br><input type="text" name="city" placeholder="ex. Phoenix" required></p>
            <p><label for="state">State</label><br><input type="text" name="state" placeholder="ex. AZ" required></p>
            <p><label for="zip">Zip Code</label><br><input type="text" name="zip" placeholder="ex. 85101" required></p>
            
            <p><button type="submit" name="submit" >Checkout</button>
            <input type="hidden" name="action" value="confirm"></p>
          </form>
        </div>

      </div>
    </main>
    <?=$bottom_stuff?>
  </body>
</html>
<?php
  if(isset($_SESSION['message'])) { 
    unset($_SESSION['message']); 
  }
?>