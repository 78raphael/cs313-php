<?php
if(!isset($_SESSION)) {
  session_start();
} 
  $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';

  $fullName = $_SESSION['full_name'];
  $status = $_SESSION['status'];

  // var_dump($appointments);
?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/week6.css">
    <title>Week 6 - Activity</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <h1>Welcome <?=$fullName?></h1>
        <div class="">
          <h3>Status: <?=$status?></h3>
          <?=$message?>
          <div class="default-div">
            <h3>Appointments</h3>
            <form method="POST" action="/controllers/week6/?action=updateAppt">
              <?=$appointments?>
            </form>
          </div>
          <!-- <form method="POST" action="/controllers/week6/index.php?action=login">
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
          </form> -->
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