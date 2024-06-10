<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Projects</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4caf50;
            color: #ffffff;
            padding: 15px;
            text-align: center;
        }

        #projectTable {
            margin: 20px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            background-color: #ffffff;
            border-collapse: collapse;
        }
        .back{
            background-color: #4caf50;
            color: #ffffff;
            padding: 15px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #projectTable th, #projectTable td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        #projectTable th {
            background-color: #4caf50;
            color: #ffffff;
        }

        .downloadButton {
            background-color: #4caf50;
            color: #ffffff;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <header>
        <h1>Your Projects</h1>
    </header>

    <table id="projectTable">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Student Id</th>
                <th>Project Title</th>
                <th>Guide Name</th>
                <th>Team Members Count</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            $conn = new mysqli('localhost', 'root', '', 'project');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Fetch data from the database
            $sql = "SELECT * FROM user_project";
            $result = $conn->query($sql);
            
            // Output data into HTML table
            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$count."</td>";
                    echo "<td>".$row['student_id']."</td>";
                    echo "<td>".$row['project_tittle']."</td>";
                    echo "<td>".$row['leader_name']."</td>";
                    echo "<td>".$row['team_count']."</td>";
                    echo "<td><a href='".$row['project_link']."' target='_blank'>Project Link</a></td>";
                    echo "</tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='6'>No projects found.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <a href="./project/project.php"><button class="back">Back </button></a>
</body>
</html>
