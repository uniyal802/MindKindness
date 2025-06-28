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
        "Question 1: At times, I feel so energetic that I can function on little to no sleep.",
        "Question 2: I have difficulty following through on some of my plans and projects, even though I was very excited about them when I got started.",
	    "Question 3: People have told me they're having trouble keeping up with what I am saying.",
	    "Question 4: I go through periods of time where my sexual drive greatly increases.",
	    "Question 5: I have contemplated ending my own life.",
        "Question 6: I have felt so irritable that I have gotten into arguments with other people pretty quickly.",
	    "Question 7: I periodically do things that carry some risk to them (e.g., using alcohol or drugs, gambling, unsafe sexual activity, thrill-seeking activities).",
	    "Question 8: I have noticed that the windows of time where I feel amazing are typically followed by feeling awful.",
	    "Question 9: Sometimes I am very productive, and at other times I can’t seem to get anything done.",
        "Question 10: There are days when I feel like I can’t get out of bed.",
	    
            
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
            $stmt = $conn->prepare("INSERT INTO customer_profile (BD) VALUES (?)");
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
