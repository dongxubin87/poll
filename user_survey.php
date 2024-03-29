<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: user_dashboard.php");
  exit;
}

$questions = [
  ['id' => 1, 'text' => 'Question 1'],
  ['id' => 2, 'text' => 'Question 2'],
  ['id' => 3, 'text' => 'Question 3']
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="survey-container">
    <h2>Survey</h2>
    <form action="submit_survey.php" method="post">
      <?php foreach ($questions as $question) : ?>
        <label for="question_<?php echo $question['id']; ?>"><?php echo $question['text']; ?></label>
        <input type="text" id="question_<?php echo $question['id']; ?>" name="answer_<?php echo $question['id']; ?>" required>
      <?php endforeach; ?>
      <button type="submit">Submit</button>
    </form>
  </div>
</body>

</html>