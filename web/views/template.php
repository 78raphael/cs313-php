<?php
if(!isset($_SESSION)) {
  session_start();
}
?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/weekX.css">
    <title>TITLE HERE</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
        <h1>Week X - Activity</h1>
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