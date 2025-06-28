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
        "Question 1: I feel overwhelmingly sad at times",
        "Question 2: When I think of the future I feel hopeless",
	    "Question 3: I am often on the brink of tears or cry",
	    "Question 4: My appetite has changed a lot",
	    "Question 5: I think I am unattractive or ugly",
        "Question 6: The bad things in my life aren’t all my fault",
	    "Question 7: I feel like I am being punished",
	    "Question 8: I find it really hard to do anything, especially work",
	    "Question 9: I find it easy to make decisions, big and small",
        "Question 10: I have thought about ending my life",
	    
            
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
            $stmt = $conn->prepare("INSERT INTO customer_profile (Depression) VALUES (?)");
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
	
          <h2>Depression Quiz Questions:</h2>
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
