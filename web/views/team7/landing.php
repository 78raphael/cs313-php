<?php
  $full_name = $_SESSION['full_name'];
?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/week7.css">
    <title>Week 7: Team Activity</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <h1>Welcome <?=$full_name?></h1>
        <div class="btn-div">
          <a href="/controllers/week7/?action=logout" alt="Logout">
            <div class="">Logout</div>
          </a>
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