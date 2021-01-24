<?php
if(!isset($_SESSION)) {
  session_start();
  $first_visit = true;
} 
else {
  // var_dump($_SESSION);
  $first_visit = false;
}
    $message = false;
    $count = 0;
  
  if(isset($_POST['item1']))  {
    $_SESSION["item1"] = $_POST['item1'];
    $message = true;
    $count++;
  } 
  else {
    unset($_SESSION["item1"]);
  }

  if(isset($_POST['item2']))  {
    $_SESSION["item2"] = $_POST['item2'];
    $message = true;
    $count++;
  } 
  else {
    unset($_SESSION["item2"]);
  }

  if(isset($_POST['item3']))  {
    $_SESSION["item3"] = $_POST['item3'];
    $message = true;
    $count++;
  } 
  else {
    unset($_SESSION["item3"]);
  }

  if(isset($_POST['item4']))  {
    $_SESSION["item4"] = $_POST['item4'];
    $message = true;
    $count++;
  } 
  else {
    unset($_SESSION["item4"]);
  }

  $_SESSION["message"] = ($message === true) ? "<p class='success'>Items added to cart</p>" : "<p class='warning'>No items in cart</p>";

?>

<?=$top_stuff?>
  <link rel="stylesheet" href="/resources/css/week3.css">
    <title>Week 3: Shopping Cart</title>
  </head>
  <body>
<?=$navigation?>
    <main>
      <div class="container">
        <h1>Browse Items</h1>
<?php
  if(isset($_SESSION["message"])) {
    echo $_SESSION["message"];
  }
?>
        <form action="" method="POST">
          <p><input type="checkbox" name="item1" <?php if(isset($_SESSION['item1'])) { echo 'checked';} ?>> Item 1</p>
          <p><input type="checkbox" name="item2" <?php if(isset($_SESSION['item2'])) { echo 'checked';} ?>> Item 2</p>
          <p><input type="checkbox" name="item3" <?php if(isset($_SESSION['item3'])) { echo 'checked';} ?>> Item 3</p>
          <p><input type="checkbox" name="item4" <?php if(isset($_SESSION['item4'])) { echo 'checked';} ?>> Item 4</p>
          <p><button type="submit" name="submit" >Add To Cart</button></p>
        </form>

        <div class="btn-div">
          <a href="/controllers/week3/?action=cart" alt="Link to go to view Cart">
            <div class="cart-button">
              View Cart
            </div>
          </a>
        </div>

        <!-- <h1>Destroy Session</h1>
        <form action="" method="get">
          <button type="submit" name="destroy" value="true">Destroy Session</button>
        </form> -->
      </div>
    </main>
<?=$bottom_stuff?>
  </body>
</html>

<?php
  // if (isset($_GET["destroy"]))  {
  //     session_destroy();
  // }


  if(isset($_SESSION['message'])) { 
    unset($_SESSION['message']); 
  }

  //echo variable info
  // echo "Session: <br>";
  // if(isset($_SESSION)) {
  //   foreach($_SESSION as $key=>$value)  {
  //     echo 'key: ' . $key . ' :: value ' . $value . '<br>';
  //   }
  // }
  // var_dump($_SESSION);
  // var_dump($_SESSION['item1']);
  // var_dump($_SESSION['item2']);
  // unset($_SESSION["message"]);
?>