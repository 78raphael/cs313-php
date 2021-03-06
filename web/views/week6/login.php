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
        <div class="btn-div">
          <a href="/controllers/week6/?action=logout" alt="Logout">
            <div class="">Logout</div>
          </a>
        </div>
        <div class="">
          <h3>Status: <?=$status?></h3>
          <?=$message?>
          <div class="default-div">
            <h3>Appointments</h3>
            <form method="POST" action="/controllers/week6/?action=update">
              <?=$appointments?>
            </form>
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