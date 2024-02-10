<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
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

        textarea {
            width: 100%;
            height: 50px; /* Set the desired height */
            padding: 10px;
            box-sizing: border-box;
        }
        tr:hover {
            background-color: #f5f5f5;
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
            position: relative;
            margin-top: 20px; /* Add margin-top to create a gap */
            width: 100%;
        }


        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            border: 1px solid #3498db; /* Use a vibrant color for the border */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: grid;
            gap: 10px;
        }

        button {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .cancel {
            background-color: #e74c3c;
        }

        .cancel:hover {
            background-color: #c0392b;
        }
        .action-column {
        width: 100px; /* Adjust the width as needed */
        }
        .update-form {
            align-items: center;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 5px; /* Adjust margin as needed */
        }

        .update-action-select {
            padding: 8px;
            border: 1px solid #ffffff; /* Use a vibrant color for the border */
            border-radius: 5px;
            color: black;
            font-size: 14px;
            margin-right: 5px;
        }

        .update-action-submit {
            padding: 8px 15px;
            background-color: #3498db; /* Use a vibrant color for the background */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            align-items: center;
        }
    
        .update-form select,
        .update-form textarea,
        .update-form input {
            border: 1px solid #27ae60;
            border-radius: 5px;
            padding: 8px;
            margin-right: 5px;
            font-size: 14px;
        }
        @media screen and (max-width: 600px) {
            .todo-container {
                overflow-x: auto;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Mayank Portal</h1>
    </header> 
    <nav>
        <ul>
            <li><a href="course-mgnt/upload_course_file.html">File Upload</a></li>
            <li><a href="course-mgnt/course_page.html">Course Page</a></li>
            <li><a href="resources/index.php">Resources</a></li>
            <li><a href="#" onclick="openForm('addForm')">Add Task</a></li>
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
                    <th>Edit</th>
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
                                
                            echo "<td><button onclick=\"editTask
                            ('{$row['id']}', '{$row['deadline']}', '{$row['work']}', '{$row['subject']}',
                             '{$row['remarks']}', '{$row['action']}')\">Edit</button>
                            </td>";
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

    <div class="form-popup" id="editForm">
        <form action="to-do/edit_task.php" class="form-container" method="post" autocomplete="off">
            <h2>Edit Task</h2>
            <input type="hidden" id="edit-task-id" name="edit-task-id" value="">
            <table>
                <tr>
                    <td><label for="deadline">Deadline:</label></td>
                    <td><input type="datetime-local" id="edit-deadline" name="edit-deadline" required></td>
                </tr>
                <tr>
                    <td><label for="work">Work:</label></td>
                    <td><textarea id="edit-work" name="edit-work" style="width: 100%; height: auto;" required onkeydown = "handleEnter(event)"></textarea></td>
                </tr>
                <tr>
                    <td><label for="subject">Subject:</label></td>
                    <td>
                        <select name="edit-subject" id="edit-subject" required>
                            <option></option>
                            <option value = "Design and Analysis of Algorithms">Design and Analysis of Algorithms</option>
                            <option value = "Operating Systems">Operating Systems</option>
                            <option value = "Software Engineering">Software Engineering</option>
                            <option value = "Marketing Research and Management">Marketing Research and Management</option>
                            <option value = "Operation Research">Operation Research</option>
                            <option value = "ECS1001">ECS1001</option>
                            <option value = "Project Management(VIT-LMS)">Project Management</option>
                        </select> </td>
                </tr>
                <tr>
                    <td><label for="remarks">Remarks:</label></td>
                    <td><input type="text" id="edit-remarks" name="edit-remarks"></td>
                </tr>
                <tr>
                    <td><label for="action">Action:</label></td>
                    <td> 
                        <select name='edit-action' id='edit-action' required>";
                            <option value='completed'>Completed</option>
                            <option value='prerequisite pending'>Prerequisite Pending</option>
                            <option value='on the way'>on the way</option>
                            <option value='final stage'>final stage</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit">Update Task</button>
            <button type="button" class="cancel" onclick="closeForm('editForm')">Close</button>
        </form>
    </div>

    <div class="form-popup" id="addForm">
        <form action="to-do/add_task.php" class="form-container" method="post" autocomplete="off">
            <h2>Add Task</h2>
            <table>
                <tr>
                    <td><label for="deadline">Deadline:</label></td>
                    <td><input type="datetime-local" id="deadline" name="deadline" required></td>
                </tr>
                <tr>
                    <td><label for="work">Work:</label></td>
                    <td><textarea id="work" name="work" required onkeydown = "handleEnter(event)"></textarea></td>
                </tr>
                <tr>
                    <td><label for="subject">Subject:</label></td>
                    <td>
                        <select name="subject" id="subject" required>
                            <option></option>
                            <option value = "Design and Analysis of Algorithms">Design and Analysis of Algorithms</option>
                            <option value = "Operating Systems">Operating Systems</option>
                            <option value = "Software Engineering">Software Engineering</option>
                            <option value = "Marketing Research and Management">Marketing Research and Management</option>
                            <option value = "Operation Research">Operation Research</option>
                            <option value = "ECS1001">ECS1001</option>
                            <option value = "Project Management(VIT-LMS)">Project Management</option>
                        </select> </td>  
                </tr>
                <tr>
                    <td><label for="remarks">Remarks:</label></td>
                    <td><input type="text" id="remarks" name="remarks"></td>
                </tr>
                <tr>
                    <td><label for="action">Action:</label></td>
                    <td>
                    <form action='' method='post'> 
                        <select class = 'update-action-select' name='action'>";
                            <option></option>
                            <option value='completed'>Completed</option>
                            <option value='prerequisite pending'>Prerequisite Pending</option>
                            <option value='on the way'>on the way</option>
                            <option value='final stage'>final stage</option>
                        </select>
                    </form>
                    </td>
                </tr>
            </table>
            <button type="submit" onclick="closeForm('addForm')">Add Task</button>
            <button type="reset" onclick="closeForm('addForm')" class="cancel">Close</button>
        </form>
    </div>

<!-- JavaScript function to fill form fields for editing -->
<script>
    function editTask(id, deadline, work, subject, remarks, action) {
        document.getElementById("edit-task-id").value = id;
        document.getElementById("edit-deadline").value = deadline;
        document.getElementById("edit-work").value = work;
        document.getElementById("edit-subject").value = subject;
        document.getElementById("edit-remarks").value = remarks;
        document.getElementById("edit-action").value = action;
        openForm('editForm');
    }
</script>

<script>
    function handleEnter(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); 
        }
    }
</script>



<script>
    function openForm(formId) {
        document.getElementById(formId).style.display = "block";
    }

    function closeForm(formId) {
        document.getElementById(formId).style.display = "none";
    }
</script>

</body>
</html>