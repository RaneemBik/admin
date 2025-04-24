<?php
session_start();
include("../inc/connection.php");



// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct = $_POST['correct_answer'];
    $level = $_POST['level'];

    $query = "INSERT INTO iqquestions (question, option_a, option_b, option_c, option_d, correct_answer, level) 
              VALUES ('$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct', '$level')";

    if (mysqli_query($con, $query)) {
        header("Location: manage_iqquestions.php");
        exit();
    } else {
        echo "Error adding question.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New IQ Question</title>
    <style>
        body {
            font-family: Arial;
            background: #f0eefc;
        }
        .form-box {
            width: 60%;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #5e2b97;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            background-color: #5e2b97;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Add New IQ Question</h2>
    <form method="post">
        <label>Question</label>
        <input type="text" name="question" required>

        <label>Option A</label>
        <input type="text" name="option_a" required>

        <label>Option B</label>
        <input type="text" name="option_b" required>

        <label>Option C</label>
        <input type="text" name="option_c" required>

        <label>Option D</label>
        <input type="text" name="option_d" required>

        <label>Correct Answer</label>
        <select name="correct_answer" required>
            <option value="">-- Select --</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>

        <label>Level (1 for Age 7–13, 2 for 14–18, 3 for 19+)</label>
        <input type="text" name="level" required>

        <button type="submit">Add Question</button>
    </form>
</div>

</body>
</html>
