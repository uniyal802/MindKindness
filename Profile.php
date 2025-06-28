<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>User Profile</h1>
    <div id="profileInfo">
        <!-- User information will be dynamically added here -->
    </div>
    <button onclick="redirectToUpdatePage()">Update Profile</button>

    <script>
        // Assuming you have an API endpoint to fetch user information
        const userId = 123; // Replace with the actual user ID
        const apiUrl = `/api/user/${userId}`;

        // Fetch user information from the server
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => displayUserProfile(data))
            .catch(error => console.error('Error fetching user profile:', error));

        function displayUserProfile(user) {
            const profileInfoElement = document.getElementById('profileInfo');
            const userInfoHTML = `
                <p><strong>Name:</strong> ${user.name}</p>
                <p><strong>Email:</strong> ${user.email}</p>
                <p><strong>Age:</strong> ${user.age}</p>
                <!-- Add more user information as needed -->
            `;
            profileInfoElement.innerHTML = userInfoHTML;
        }

        function redirectToUpdatePage() {
            // Redirect to the update profile page
            window.location.href = 'update-profile.html';
        }
    </script>
</body>
</html>
