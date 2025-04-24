<?php
session_start();
include("inc/connection.php"); // Update this path based on your project



// Fetch all IQ questions
$query = "SELECT * FROM iqquestions ORDER BY level, id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage IQ Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f1f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #5e2b97;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #8a4fff;
            color: white;
            padding: 12px;
        }
        td {
            padding: 10px;
            text-align: center;
        }
        .action-btns a {
            margin: 0 5px;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .edit-btn {
            background-color: #4CAF50;
        }
        .delete-btn {
            background-color: #f44336;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage IQ Questions</h2>
    <a href="add_question.php" style="
    display: inline-block;
    margin-bottom: 15px;
    background-color: #5e2b97;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
">
    ➕ Add New Question
</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Option D</th>
            <th>Correct Answer</th>
            <th>Level</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['question']) ?></td>
            <td><?= htmlspecialchars($row['option_a']) ?></td>
            <td><?= htmlspecialchars($row['option_b']) ?></td>
            <td><?= htmlspecialchars($row['option_c']) ?></td>
            <td><?= htmlspecialchars($row['option_d']) ?></td>
            <td><?= $row['correct_answer'] ?></td>
            <td>Level <?= $row['level'] ?></td>
            <td class="action-btns">
                <a href="edit_question.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                <a href="delete_question.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
