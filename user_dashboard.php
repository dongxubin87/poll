<?php
session_start();
require_once 'db_connect.php';
try {
  $stmtQuestionnaires = $pdo->query("SELECT questionnaire_id, title FROM questionnaires");
  $questionnaires = $stmtQuestionnaires->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    #avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #ccc;
      background-size: cover;
      background-position: center;
      cursor: pointer;
    }

    #userInfo {
      margin-top: 20px;
    }

    #username,
    #email {
      margin-bottom: 10px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
  </style>
</head>

<body>

  <h2>User Profile</h2>

  <div id="avatar" onclick="changeAvatar()" title="Click to change avatar"></div>

  <div id="userInfo">
    <p id="username"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?></p>
    <p id="email"><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></p>
  </div>
  <div class="questionnaire-list">
    <h2>Questionnaire List</h2>
    <table>
      <tr>
        <th>No.</th>
        <th>Title</th>
        <th>Created At</th>
      </tr>
      <?php
      $stmtQuestionnaires = $pdo->query("SELECT questionnaire_id, title,created_at FROM questionnaires");
      $questionnaires = $stmtQuestionnaires->fetchAll(PDO::FETCH_ASSOC);

      foreach ($questionnaires as $index => $questionnaire) {
        echo '<tr>';
        echo '<td>' . ($index + 1) . '</td>';
        echo '<td><a href="uservote.php?questionnaire_id=' . $questionnaire['questionnaire_id'] . '">' . $questionnaire['title'] . '</a></td>';

        echo '<td>' . $questionnaire['created_at'] . '</td>';
        echo '</tr>';
      }
      ?>
    </table>
  </div>


  <script>
    function changeAvatar() {
      var input = document.createElement('input');
      input.type = 'file';
      input.accept = 'image/*';
      input.onchange = function(event) {
        var file = event.target.files[0];
        if (file) {
          var reader = new FileReader();
          reader.onload = function(e) {
            document.getElementById('avatar').style.backgroundImage = 'url(' + e.target.result + ')';
          }
          reader.readAsDataURL(file);
        }
      };
      input.click();
    }
  </script>

</body>

</html>