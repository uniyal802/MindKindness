<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mental Health Quiz</title>
    <link rel="stylesheet" href="index_css.css">
</head>
<body>
    <div class="quiz-container">
        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mindk";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $questions = array(
        "Question 1: How often do you have difficulty sustaining your attention while doing something for work, college/school, a hobby, or fun activity (e.g., remaining focused during lectures, lengthy reading or conversations)?",
        "Question 2: How often are you easily distracted by external stimuli, like something in your environment or unrelated thoughts?",
	    "Question 3: How often do you avoid, dislike, or are reluctant to engage in tasks that require sustained mental effort or thought?",
	    "Question 4: How often do you fail to give close attention to details, or make careless mistakes in things such as schoolwork, at work, or during other activities?",
	    "Question 5: How often do you lose, misplace or damage something that's necessary in order to get things done (e.g., your phone, eyeglasses, paperwork, wallet, keys, etc.)?",
        "Question 6: How often do you have difficulty waiting your turn, such as while waiting in line?",
	    "Question 7: How often are you unable to play or engage in leisurely activities quietly? ",
	    "Question 8: How often do you have difficulty in organizing an activity or task needing to get done (e.g., poor time management, fails to meet deadlines, difficulty managing sequential tasks)?",
	    "Question 9: How often do you forget to do something you do all the time, such as missing an appointment or paying a bill?",
        "Question 10: How often do you feel like you're 'on the go,' acting as if you're 'driven by a motor' (e.g., you're unable to be or uncomfortable being still for an extended period of time, such as in a restaurant or a meeting)?",
	    
            
        );

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $totalScore = 0;
            for ($i = 1; $i <= 10; $i++) {
                $response = $_POST["response_$i"];
                if ($response === "Yes") {
                    $totalScore += 1;
                }
            }

            // Insert total score into the database
            $stmt = $conn->prepare("INSERT INTO customer_profile (ADHD) VALUES (?)");
            $stmt->bind_param("i", $totalScore);

            if ($stmt->execute()) {
                echo "<h2>Quiz Completed!</h2>";
                echo "<p>Your total score: $totalScore</p>";
                
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        // Close the database connection
        $conn->close();
        ?>
	
          <h2>ADHD Quiz Questions:</h2>
          <a href="ml.html">
        <button type="button">Next</button>
    </a>
            <form method="post" action="">
            <?php
            for ($i = 0; $i < 10; $i++) {
                $questionNumber = $i + 1;
                echo "<label for='response_$questionNumber'>{$questions[$i]}</label>";
                echo "<select id='response_$questionNumber' name='response_$questionNumber'>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>
                      </select><br>";
            }
            ?>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
</body>
</html>
