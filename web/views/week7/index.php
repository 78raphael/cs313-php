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
        <h1>Week 7: Project 1</h1>
        <div class="">
          <h3>Login</h3>
          <?=$message?>
          <form method="POST" action="/controllers/project1/index.php?action=login">
            <div class="default-div">
              <label for="username">Enter Username</label><br>
              <input type="text" name="username" placeholder="Username">
            </div>
            <div class="default-div">
              <label for="password">Enter Password</label><br>
              <input type="password" name="password" placeholder="password">
            </div>
            <div class="default-div">
              <button class="submit-25" type="submit" name="submitBtn">Submit</button>
            </div>
          </form>
          <div>
            If you do not have a login, <a href="/controllers/project1/?action=signup" alt="Register Username & Password">[register here]</a>
          </div>
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