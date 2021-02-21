<?php
if(!isset($_SESSION)) {
  session_start();
}

$message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';
?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/weekX.css">
    <title>Week 7: Team Activity</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <h1>Week 7 - Team Activity</h1>
          <div class="">
            <h3>Sign Up</h3>
            <?=$message?>
            <form method="POST" action="/controllers/week7/index.php?action=register">
              <div class="default-div">
                <label for="first_name">Enter first name</label><br>
                <input type="text" name="first_name" placeholder="ex. Bob" required>
              </div>
              <div class="default-div">
                <label for="last_name">Enter last name</label><br>
                <input type="text" name="last_name" placeholder="ex. Jones" required>
              </div>
              <div class="default-div">
                <label for="username">Enter a username</label><br>
                <input type="text" name="username" placeholder="Username" required>
              </div>
              <div class="default-div">
                <label for="email">Enter an email address</label><br>
                <input type="text" name="email" placeholder="ex. email@example.com" required>
              </div>
              <div class="default-div">
                <label for="password">Enter password</label><br>
                <input type="password" name="password" placeholder="Password" required>
              </div>
              <div class="default-div">
                <button class="" type="submit" name="submitBtn">Register</button>
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