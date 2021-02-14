<?php
if(!isset($_SESSION)) {
  session_start();
} 
  $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';
?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/week6.css">
    <title>Week 6 - Activity</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <h1>Week 6: DB Data Modification</h1>
        <div class="">
          <h3>Login</h3>
          <?=$message?>
          <form method="POST" action="/controllers/week6/index.php?action=login">
            <div class="default-div">
              <label for="email">Enter Email</label><br>
              <input type="text" name="email" placeholder="ex. name@email.com">
            </div>
            <div class="default-div">
              <label for="password">Enter Password</label><br>
              <input type="password" name="password" placeholder="password">
            </div>
            <div class="default-div">
              <button type="submit" name="submitBtn">Submit</button>
            </div>
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