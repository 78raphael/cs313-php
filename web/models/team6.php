<?php

function team6($book, $chapter, $verse, $content, $faith = NULL, $sacrifice = NULL, $charity = NULL, $userCheckbox = NULL, $userText = NULL)  {
  $pdo = connector();
  return "inside team6 function on team6.php" . $pdo;

  $stmt = $pdo->prepare('INSERT INTO scriptures(book, chapter, verse, content)
  VALUES (:book, :chapter, :verse, :content)');
  $stmt->bindValue(':book', $book, PDO::PARAM_STR);
  $stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);
  $stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
  $stmt->bindValue(':content', $content, PDO::PARAM_STR);
  $stmt->execute();

  $lastId = $pdo->lastInsertId();
  $stmt->closeCursor();

  if($faith != NULL)  {
    $stmt1 = $pdo->prepare('INSERT INTO scripture_topic(scripture_id, topic_id) VALUES (:lastId, :faith)');

    $stmt1->bindValue(':lastId', $lastId, PDO::PARAM_INT);
    $stmt1->bindValue(':faith', $faith, PDO::PARAM_INT);

    $stmt1->execute();
    $stmt1->closeCursor();
  }

  if($sacrifice != NULL)  {
    $stmt2 = $pdo->prepare('INSERT INTO scripture_topic(scripture_id, topic_id) VALUES (:lastId, :sacrifice)');

    $stmt2->bindValue(':lastId', $lastId, PDO::PARAM_INT);
    $stmt2->bindValue(':sacrifice', $sacrifice, PDO::PARAM_INT);

    $stmt2->execute();
    $stmt2->closeCursor();
  }

  if($charity != NULL)  {
    $stmt3 = $pdo->prepare('INSERT INTO scripture_topic(scripture_id, topic_id) VALUES (:lastId, :charity)');

    $stmt3->bindValue(':lastId', $lastId, PDO::PARAM_INT);
    $stmt3->bindValue(':charity', $charity, PDO::PARAM_INT);

    $stmt3->execute();
    $stmt3->closeCursor();
  }


  if($userCheckbox != NULL)  {
    $stmt4 = $pdo->prepare('INSERT INTO topic (name) VALUES(:userText)');
    $stmt4->bindValue(':userText', $userText, PDO::PARAM_STR);
    $stmt4->execute();

    $lastTopicId = $pdo->lastInsertId();
    $stmt4->closeCursor();

    $stmt5 = $pdo->prepare('INSERT INTO scripture_topic(scripture_id, topic_id) VALUES (:lastId, :lastTopicId)');

    $stmt5->bindValue(':lastId', $lastId, PDO::PARAM_INT);
    $stmt5->bindValue(':lastTopicId', $lastTopicId, PDO::PARAM_INT);

    $stmt5->execute();
    $stmt5->closeCursor();
  }

}

function getTopics()  {
  $db = connector();

  $stmt = $db->prepare('SELECT * FROM topic');
  $stmt->execute();

  $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $topics;
}