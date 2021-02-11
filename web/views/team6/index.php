<?php

$checkboxes = '';

foreach($topics AS $topic)  {
  $checkboxes .= '<input type="checkbox" name="'.$topic['name'].'" value="'.$topic['id'].'">'.$topic['name'].'</label><br>';
}

$checkboxes .= '<input type="checkbox" name="UserCheckbox" value="4"><input type="text" name="UserText" placeholder="Enter new topic"></label><br>';

?>
<?=$top_stuff?>
    <link rel="stylesheet" href="/resources/css/week5.css">
    <title>Week 6 - Team Activity</title>
  </head>
  <body>
    <?=$navigation?>
    <main>
      <div class="container">
      <h1>Week 6: Team Activity</h1>
        <form method="POST" action="index.php?action=team6">
        Book:<br><input type="text" name="book"><br>
        Chapter:<br><input type="text" name="chapter"><br>
        Verse:<br><input type="text" name="verse"><br>
        Content:<br><textarea rows="10" cols="50" name="content"></textarea><br>
        <br>
        <?=$checkboxes?>
        <br>
        <input type="submit" name="submit">
        </form>
      </div>
    </main>
    <?=$bottom_stuff?>
  </body>
</html>