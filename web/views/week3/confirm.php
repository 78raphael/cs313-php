<?php
if(!isset($_SESSION)) {
  session_start();
} 

  $cartTotal = "";

  if(isset($_SESSION))  {
    $cartTotal .= '<ul>';
    foreach($_SESSION as $key=>$value)  {
      $cartTotal .= '<li>' . $key. '</li>';
    }
    $cartTotal .= '</ul>';
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
        <h1>Confirmation</h1>
        <h3>Shipping Address</h3>
        <div class="shipping-address">
          <ul>
            <li><?=$firstName?> <?=$lastName?></li>
            <li><?=$address?></li>
            <li><?=$city?>, <?=$state?> <?=$zip?></li>
          </ul>
        </div>
        <h3>Cart</h3>
        <div class="shipping-address">
          <?=$cartTotal?>
        </div>
        <div class="btn-div">
          <a href="/?action=week3" alt="Return to Checkout">Back to Browse Page</a>
        </div>
      </div>
    </main>
    <?=$bottom_stuff?>
  </body>
</html>