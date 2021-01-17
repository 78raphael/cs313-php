<?php
  include "../php/assignments-list.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/index.css">
  <link rel="stylesheet" href="/week2/css/week2.css">
  <title>Assignments</title>
</head>
<body>
  <nav>
    <?php
      include '../php/nav.php';
    ?>
  </nav>
  <main>
    <div class="container">
      <div class="assignments-list">
        <?=$assignments_list?>
      </div>
    </div>
  </main>
</body>
</html>