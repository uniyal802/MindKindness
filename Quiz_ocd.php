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
        "Question 1: Concerns with contamination (dirt, germs, chemicals, radiation) or acquiring a serious illness such as AIDS?",
        "Question 2: Overconcern with keeping objects (clothing, groceries, tools) in perfect order or arranged exactly?",
	    "Question 3: Have you worried a lot about terrible things happening, such as Fire, burglary, or flooding the house?",
	    "Question 4: Have you worried a lot about accidentally hitting a pedestrian with your car, or letting your call roll down the hill? ",
	    "Question 5: Have you worried a lot about losing something valuable?",
        "Question 6: Have you felt driven to perform certain acts over and over again, such as checking light switches, water faucets, the stove, door locks, or emergency brake?",
	    "Question 7: Unnecessary re-reading or re-writing; re-opening envelopes before they are mailed?",
	    "Question 8: Examining your body for signs of illness?",
	    "Question 9: Have you worried about acting on an unwanted and senseless urge or impulse, such as physically harming a loved one, pushing a stranger in front of a bus, steering your car into oncoming traffic; inappropriate sexual contact; or poisoning dinner guests?",
        "Question 10: Needing to “confess” or repeatedly asking for reassurance that you said or did something correctly?",
	    
            
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
            $stmt = $conn->prepare("INSERT INTO customer_profile (OCD) VALUES (?)");
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
	
          <h2>OCD Quiz Questions:</h2>
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
