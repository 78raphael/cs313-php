<?php
session_start();

$message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';
?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/week7.css">
    <title>Project 1</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <h1>Project 1</h1>
          <div class="">
            <div>
              <a href="/?action=week7" alt="Back to Sign in">Back to Sign-In</a>
            </div>
            <h3>Sign Up</h3>
            <?=$message?>
            <form method="POST" action="/controllers/project1/index.php?action=register">
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
              <div class="default-div submit-25">
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