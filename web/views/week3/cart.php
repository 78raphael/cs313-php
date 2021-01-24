<?php

if(!isset($_SESSION)) {
  session_start();
} 

  if(isset($_POST)) {
    if(isset($_POST['submit']))  {
      unset($_POST['submit']);
    }

    foreach($_POST as $key => $value) {
      unset($_SESSION[$key]);
    }
  }

  $cartItem = '';

  if(count($_SESSION) > 0)  {
    $cartItem .= '<ul>';
    foreach($_SESSION as $key=>$value)  {
      $cartItem .= '<li><input type="checkbox" name="'.$key.'">' . $key. '</li>';
    }
    $cartItem .= '</ul>';
    $cartItem .= '<p><button type="submit" name="submit" >Remove Item</button></p>';

    $cartItem .= '<div class="btn-div">
    <a href="?action=checkout" alt="Link to Confirmation Page">
      <div class="checkout-button">
        Checkout
      </div>
    </a>
  </div>';
  } else {
    $cartItem = '<div class="empty-cart">Cart is empty. Please select an item.</div>';
  }

?>
<?=$top_stuff?>
    <link rel="stylesheet" href="../../resources/css/week3.css">
    <title>W3: Shopping Cart</title>
  </head>
  <body>
<?=$navigation?>
    <main>
      <div class="container">
        <h1>View Cart</h1>
<?php
  if(isset($_SESSION["message"])) {
    echo $_SESSION["message"];
  }
?>
        <div class="btn-div">
          <a href="/?action=week3" alt="Return to Browse page">Back to Browse Page</a>
        </div>
        <div class="cart">
          <form action="" method="POST">
            <?=$cartItem?>
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