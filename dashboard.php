
<?php
include('dabcon.php');

// Get user data from query parameters
$name = isset($_GET['name']) ? $_GET['name'] : 'Unknown';
$username = isset($_GET['username']) ? $_GET['username'] : 'Unknown';
$email = isset($_GET['email']) ? $_GET['email'] : 'Unknown';
$created_at = isset($_GET['created_at']) ? $_GET['created_at'] : 'Unknown';

$sql = "SELECT name, username, email, created_at FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-Do List App</title>
    <style>
      * {
        margin: 0;
        padding: 0;
      }

      body {
        background: rgb(2, 0, 36);
        background: linear-gradient(
          54deg,
          rgba(2, 0, 36, 1) 13%,
          rgba(14, 48, 36, 1) 37%,
          rgba(17, 8, 42, 1) 76%,
          rgba(10, 6, 49, 1) 89%
        );
        display: flex;
        justify-content: center;
      }

      .container {
        text-align: center;
        width: 90%;
        min-height: 100vh;
      }

      .container h2 {
        color: white;
        margin-top: 15px;
        font-size: 30px;
      }

      .container ol {
        width: 70%;
        margin: auto;
        padding: 40px;
      }

      li {
        color: rgb(226, 69, 7);
        text-align: left;
        padding: 10px;
        box-shadow: rgba(0, 0, 0, 0.2) 56px 39px 20px 0px;
        border: 2px solid white;
        margin-top: 10px;
        border-radius: 5px;
        font-size: 25px;
      }
    </style>
</head>
<body>
    <div class="container">
      <h2>Users in the Database</h2>
      <ol id="learnList">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li> Name: " . htmlspecialchars($row['name']) . " | Username: " . htmlspecialchars($row['username']) . " | Email: " . htmlspecialchars($row['email']) . " | Registration Time: " . htmlspecialchars($row['created_at']) . "</li>";
            }
        } else {
            echo "<li>No users found</li>";
        }
        $conn->close();
        ?>
      </ol>
      <h3>Logged in User:</h3>
      <p>Name: <?php echo htmlspecialchars($name); ?></p>
      <p>Username: <?php echo htmlspecialchars($username); ?></p>
      <p>Email: <?php echo htmlspecialchars($email); ?></p>
      <p>Registration Time: <?php echo htmlspecialchars($created_at); ?></p>
    </div>
</body>
</html>

