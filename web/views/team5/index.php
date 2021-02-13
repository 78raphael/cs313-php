<?php

?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/week5.css">
    <title>Week 5 - Team Activity</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
      <h1>Week 5: Scripture Resources</h1>
        <?=$toPrint?>
        <form action="index.php?action=team5" method="POST">
          <div class="default-div">
            <label for="search">Enter Book</label><br>
            <input type="text" name="search">
          </div>
          <div class="default-div">
            <button type="submit" name="submitBtn">Submit</button>
          </div>
        </form>
      </div>
    </main>
    <?=$bottom_stuff?>
  </body>
</html>