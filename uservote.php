<?php
session_start();

require_once 'db_connect.php';

if (!isset($_GET['questionnaire_id'])) {
  echo "Questionnaire ID is missing.";
  exit();
}

try {
  $questionnaireId = $_GET['questionnaire_id'];
  $stmtQuestionnaire = $pdo->prepare("SELECT title FROM questionnaires WHERE questionnaire_id = ?");
  $stmtQuestionnaire->execute([$questionnaireId]);
  $questionnaire = $stmtQuestionnaire->fetch(PDO::FETCH_ASSOC);

  $stmtQuestions = $pdo->prepare("SELECT question_id, content, type FROM questions WHERE questionnaire_id = ?");
  $stmtQuestions->execute([$questionnaireId]);
  $questions = $stmtQuestions->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Vote</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    .odd {
      background-color: #f0f0f0;
      padding: 10px;
    }

    .even {
      background-color: #ffffff;
      padding: 10px;
    }
  </style>
</head>

<body>

  <h2><?php echo $questionnaire['title']; ?></h2>
  <form action="logout.php" method="post">
    <button type="submit">Logout</button>
    <button id="copyButton">Share</button>

  </form>


  <form action="process_vote.php" method="post">
    <?php $counter = 1; ?>
    <?php foreach ($questions as $question) : ?>
      <div class="question <?php echo ($counter % 2 == 0) ? 'even' : 'odd'; ?>">
        <p><?php echo $counter; ?>. <?php echo $question['content']; ?></p>
        <?php if ($question['type'] === 'true_false') : ?>
          <label>
            <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="true">
            True
          </label>
          <label>
            <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="false">
            False
          </label>
        <?php elseif ($question['type'] === 'single_choice') : ?>
          <?php
          $stmtOptions = $pdo->prepare("SELECT option1, option2 FROM questions WHERE question_id = ?");
          $stmtOptions->execute([$question['question_id']]);
          $options = $stmtOptions->fetch(PDO::FETCH_ASSOC);
          ?>
          <label>
            <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="<?php echo $options['option1']; ?>">
            <?php echo $options['option1']; ?>
          </label>
          <label>
            <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="<?php echo $options['option2']; ?>">
            <?php echo $options['option2']; ?>
          </label>
        <?php endif; ?>
      </div>
      <?php $counter++; ?>
    <?php endforeach; ?>

    <input type="hidden" name="questionnaire_id" value="<?php echo $questionnaireId; ?>">
    <button type="submit">Submit</button>
  </form>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var copyButton = document.getElementById('copyButton');

      copyButton.addEventListener('click', function(event) {
        event.preventDefault();

        var textarea = document.createElement('textarea');
        textarea.value = window.location.href;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('The link has been copied!');
      });
    });
  </script>
</body>

</html>