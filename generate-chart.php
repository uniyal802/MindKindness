<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedQuiz = $_POST['quizSelection'];
    $output = shell_exec("python generate_chart.py $selectedQuiz");
    echo "<pre>$output</pre>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Scores Dashboard</title>
</head>
<body>
    <form action="generate_chart.php" method="post">
        <label for="quizSelection">Select Quiz:</label>
        <select id="quizSelection" name="quizSelection">
            <option value="Quiz1">Quiz 1</option>
            <option value="Quiz2">Quiz 2</option>
            <option value="Quiz3">Quiz 3</option>
            <option value="Quiz4">Quiz 4</option>
            <option value="Quiz5">Quiz 5</option>
        </select>
        <button type="submit">Generate Quiz Scores Chart</button>
    </form>
</body>
</html>
