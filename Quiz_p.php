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
        "Question 1: I find it very hard to unwind, relax or sit still",
        "Question 2: I have had stomach problems, such as feeling sick or stomach cramps",
	    "Question 3: I have been irritable and easily become annoyed",
	    "Question 4: I have experienced shortness of breath",
	    "Question 5: I have felt dizzy and unsteady at times",
        "Question 6: I have had difficulties with sleep (including waking early, finding it hard to go to sleep)",
	    "Question 7: I have felt panicked and overwhelmed by things in my life",
	    "Question 8: I have felt nervous and on edge",
	    "Question 9: I have had trembling hands",
        "Question 10: I seem to be constantly worrying about things",
	    
            
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
            $stmt = $conn->prepare("INSERT INTO customer_profile (Anxiety) VALUES (?)");
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
	
          <h2>Anxiety Quiz Questions:</h2>
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
