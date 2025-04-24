<?php
session_start();


include("../inc/connection.php"); 

// Delete user if requested
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM logintb WHERE id = $id");
    header("Location: manage_users.php");
    exit();
}

// Fetch all users
$result = mysqli_query($con, "SELECT * FROM logintb"); 

// Function to get age group from DOB
function getAgeGroup($dob) {
    $age = date_diff(date_create($dob), date_create('today'))->y;
    if ($age >= 7 && $age <= 13) return "Level 1 (7-13)";
    if ($age >= 14 && $age <= 18) return "Level 2 (14-18)";
    if ($age >= 19) return "Level 3 (19+)";
    return "Unknown";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - SmartMind</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fc;
      margin: 0;
      padding: 0;
    }

    .container {
      margin-left: 270px;
      padding: 30px;
    }

    h1 {
      color: #6c5ce7;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      background-color: #f1f1f1;
      color: #333;
    }

    td {
      color: #555;
    }

    .actions a {
      text-decoration: none;
      margin-right: 10px;
      color: #6c5ce7;
      font-weight: bold;
    }

    .actions a.delete {
      color: crimson;
    }

    .actions a:hover {
      text-decoration: underline;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      color: #6c5ce7;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage Users</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>DOB</th>
          <th>Age Group</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($user = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['dob']) ?></td>
            <td><?= getAgeGroup($user['dob']) ?></td>
            <td class="actions">
              <a href="edit_user.php?id=<?= $user['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
              <a href="manage_users.php?delete=<?= $user['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fas fa-trash-alt"></i> Delete</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <a href="admin.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
  </div>
</body>
</html>
