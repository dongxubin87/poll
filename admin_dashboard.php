<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
  header("Location: admin_login.php");
  exit();
}
require_once 'db_connect.php';
try {
  $stmtUsers = $pdo->query("SELECT user_id, username, email FROM Users WHERE is_admin = 0");
  $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
  $stmtAdmin = $pdo->prepare("SELECT email FROM Users WHERE username = ?");
  $stmtAdmin->execute([$_SESSION['username']]);
  $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
  $_SESSION['email'] = $admin['email'];


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
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin_styles.css">
</head>

<body>
  <div class="container">
    <div class="leftcontainer">
      <div class="profile-container">
        <div class="profile" onclick="toggleMenu()"></div>

        <div class="menu" id="profileMenu">
          <div class="menu-item">Username: <?php echo $_SESSION['username']; ?></div>
          <div class="menu-item">Email: <?php echo $_SESSION['email']; ?></div>
          <div class="menu-item">
            <label for="avatarInput">Change Avatar:</label>
            <input type="file" id="avatarInput" class="menu-item" accept="image/*" onchange="changeAvatar(event)">
          </div>
          <div class="menu-item" onclick="logout()">Logout</div>
        </div>

      </div>
      <div class="welcome">Welcome admin!</div>

      <div class="userlist-container">

        <p class="userlist"><a href="buildsurvey.php">Bulid New Questionnaire</a></p>
      </div>
    </div>

    <div class="rightcontainer">
      <div class="userlist-container">
        <h2>User List</h2>
        <table>
          <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
          <?php
          // Fetch all users except admins
          $stmtUsers = $pdo->query("SELECT user_id, username, email, created_at FROM Users WHERE is_admin = 0");
          $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

          $index = 1;
          foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . $index . '</td>';
            echo '<td>' . $user['username'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            echo '<td>' . $user['created_at'] . '</td>';
            echo '<td><button class="delete-button" onclick="deleteUser(' . $user['user_id'] . ')">Delete</button></td>';
            echo '</tr>';
            $index++;
          }
          ?>
        </table>
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
            echo '<td>' . $questionnaire['title'] . '</td>';
            echo '<td>' . $questionnaire['created_at'] . '</td>';
            echo '</tr>';
          }
          ?>
        </table>
      </div>

    </div>
  </div>


  <script>
    function toggleMenu() {
      var menu = document.getElementById("profileMenu");
      menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }

    function changeAvatar(event) {
      var file = event.target.files[0];
      var reader = new FileReader();
      reader.onload = function() {
        var avatar = document.querySelector('.profile');
        avatar.style.backgroundImage = "url('" + reader.result + "')";
      };
      reader.readAsDataURL(file);
    }

    function logout() {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "admin_logout.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          window.location.href = "admin_login.php";
        }
      };
      xhr.send("logout=true");
    }

    function deleteUser(userId) {
      var confirmDelete = confirm("Are you sure you want to delete this user?");
      if (confirmDelete) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_user.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              alert("User deleted successfully!");
            } else {
              alert("Error deleting user. Please try again later.");
            }
          }
        };
        xhr.send("user_id=" + userId);
      }
    }

    function deleteUser(userId) {
      if (confirm("Are you sure you want to delete this user?")) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              location.reload();
            } else {
              alert("Error deleting user. Please try again later.");
            }
          }
        };
        xhr.open("POST", "delete_user.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("user_id=" + userId);
      }
    }
  </script>
</body>

</html>