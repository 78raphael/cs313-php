<?php
if(!isset($_SESSION)) {
  session_start();
}

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
        <h1>Create Appointment</h1>
        <div class="">
          <?=$message?>
          <div>
            <a href="/?action=week7" alt="Back to landing page"><< Back</a>
          </div>
          <form method="POST" action="/controllers/project1/?action=create">
            <div class="appt users-dropdown">
              <?php 
              if($_SESSION['status'] === 'admin') {
                echo $userList;
              } else  {
                echo "<input type='hidden' name='usersList' value='$_SESSION[p1_id]'>";
              }
              ?>
            </div>
            <div class="appt sessions-dropdown">
              <?=$sessionList?>
            </div>
            <div class="appt">
              Enter Date (YYYY-MM-DD)<br>
              <input type="text" name="date" placeholder="ex. 2021-04-19">
            </div>
            <div class="appt">
              Enter Time (Use 24-hour format)<br>
              <input type="text" name="time" placeholder="ex. 13:30:00">
            </div>
            <div class="appt">
              Notes<br>
              <textarea name="notes" cols="50" rows="5"></textarea>
            </div>
            <div class="default-div submit-25">
              <button class="" type="submit" name="submitBtn">Create Appointment</button>
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