import mysql.connector
import matplotlib.pyplot as plt
import sys

# Connect to the MySQL server
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="quiz_database"  # Specify the name of your database
)

# Check if the correct number of command-line arguments is provided
if len(sys.argv) > 1:
    selected_quiz = sys.argv[1]
    print(f"Generating chart for {selected_quiz} scores...")

    # Assuming the connection is successful, you can proceed with executing queries

    # Example: Retrieve scores for the selected quiz from the 'user_scores' table
    mycursor = mydb.cursor()
    query = f"SELECT user_id, {selected_quiz} FROM user_scores"
    mycursor.execute(query)

    # Fetch results
    results = mycursor.fetchall()

    # Separate user_id and quiz scores
    user_ids, scores = zip(*results)

    # Plot a bar chart
    plt.bar(user_ids, scores, label=selected_quiz)

    # Customize the chart
    plt.xlabel('User ID')
    plt.ylabel('Score')
    plt.title(f'{selected_quiz} Scores')
    plt.legend()

    # Show the chart
    plt.show()

    # Close the cursor
    mycursor.close()

    # Close the connection
    mydb.close()
else:
    print("Please provide a quiz name as an argument.")
