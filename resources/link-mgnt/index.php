<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f4f4f4; /* Light gray background */
            color: #333; /* Dark text color */
            overflow-y: auto;
        }


        button {
            padding: 15px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            background-color: #2ecc71; /* Green button background */
            color: #fff; /* White button text color */
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s; /* Smooth transition */
        }

        button:hover {
            background-color: #27ae60; /* Darker green on hover */
        }

        iframe {
            width: 100%;
            height: 500px;
            border: none;
        }
        a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #27ae60;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
        .todo-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 90px;
            overflow-x: auto;
        }
        footer {
            background-color: #333333;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            margin-top: 40px; /* Add margin-top to create a gap */
            width: 100%;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        header {
            background-color: #3498db;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        nav {
            background-color: #2ecc71;
            padding: 10px;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        li {
            display: inline;
        }

    </style>
</head>
<body>

    <header>
            <h1>Welcome to Mayank Portal</h1>
    </header> 
    <nav>
        <ul>
            <li><a href="upload_course_link.html">Link Upload</a></li>
            <li><a href="link-page.html">Course Links Page</a></li>
            <li><a href="view-notes.html">View Notes</a></li>
            <li><a href="../../home.php">Home Page</a></li>
            <li><a href="../index.php">Resources</a></li>
        </ul>
    </nav>
<div class="todo-container">
        <h2>To-Do List</h2>
        <table>
            <thead>
                <tr>
                    <th>Deadline</th>
                    <th >Work</th>
                    <th >Subject</th>
                    <th>Action</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "university"); 
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $query = "
                    SELECT id, DATE_FORMAT(deadline, '%d-%m-%Y %h:%i %p') AS dateAP, work, subject, remarks, action, deadline FROM todo_list
                            ORDER BY
                                CASE 
                                    WHEN action = 'completed' THEN 1
                                    ELSE 0
                                END, 
                                deadline ASC
                    ";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $delreq = "DELETE todo_list WHERE id = ".$row['id'];
                            echo "<tr>";
                            echo "<td>{$row['dateAP']}</td>";
                            echo "<td>{$row['work']}</td>";
                            echo "<td>{$row['subject']}</td>";
                            echo "<td> {$row['action']}</td>";
                             echo "<td>{$row['remarks']}</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No tasks available.</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Mayank Mahajan, Research-Associate</p>
        <p>Harvard Business School</p>
    </footer>



<script>
    function redirectTo(url) {
        window.location.href = url;
    }
</script>

</body>
</html>
