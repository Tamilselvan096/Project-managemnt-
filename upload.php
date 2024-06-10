<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('./background.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: auto; /* Set overflow to auto to enable scrolling */
        }

        header {
            background-color: #4caf50;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        #uploadContainer {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
            max-height: 80vh; /* Set a maximum height for the container */
            overflow-y: auto; /* Enable vertical scrolling if needed */
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        #submitBtn {
            background-color: #4caf50;
            color: #ffffff;
            padding: 15px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Upload Project</h1>
    </header>

    <div id="uploadContainer">
        <h2>Project Submission Form</h2>
        <form id="projectForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="student_id">Student ID:</label><br>
            <input type="text" id="student_id" name="student_id" required><br><br>

            <label for="project_title">Project Title:</label><br>
            <input type="text" id="project_title" name="project_title" required><br><br>

            <label for="team_count">Team Count:</label><br>
            <input type="number" id="team_count" name="team_count" min="1" required><br><br>

            <label for="leader_name">Guide Name:</label><br>
            <input type="text" id="leader_name" name="leader_name" required><br><br>

            <label for="project_link">Project Link:</label><br>
            <input type="url" id="project_link" name="project_link" required><br><br>

            <button type="submit" id="submitBtn">Submit</button>
            
        </form>
    </div>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Establish a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $student_id = $_POST['student_id'];
        $project_title = $_POST['project_title'];
        $team_count = $_POST['team_count'];
        $leader_name = $_POST['leader_name'];
        $project_link = $_POST['project_link'];

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO user_project (student_id, project_tittle, team_count, leader_name, project_link) VALUES (?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("ssiss", $student_id, $project_title, $team_count, $leader_name, $project_link);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect after successful form submission
            //header("Location: thank_you.php");
            exit(); // Terminate the script to prevent further execution
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>

</body>
</html>
