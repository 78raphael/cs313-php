<?php
if(!isset($_SESSION)) {
  session_start();
} 
  $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';

  $fullName = $_SESSION['p1_full_name'];
  $status = $_SESSION['p1_status'];

  // var_dump($appointments);
?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/week7.css">
    <title>Project 1</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <div class="title-bar">
          <div class="btn-div logout-btn">
            <a href="/controllers/project1/?action=logout" alt="Logout">
              <div class="">Logout</div>
            </a>
          </div>
          <h1>Welcome <?=$fullName?> [<?=$status?>]</h1>
        </div>
        <div class="">
          <?=$userNav?>
          <?=$message?>
          <div class="default-div">
            <h3>Appointments</h3>
            <form method="POST" action="/controllers/project1/?action=update">
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