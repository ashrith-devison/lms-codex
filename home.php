<script>
    history.replaceState(null,null,'/lms/content');
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #bbeff6;
            margin: 0;
            border: solid;
            display: flex;
            flex-direction: column; /* Set the flex direction to column */
            min-height: 100vh; /* Ensure the body takes at least the full height of the viewport */
        }

        header {
            background-color: #3b3f52;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            border: solid;
        }

        nav {
            background-color: #a9566d;
            padding: 10px;
            width: 30px;
            height: 100px;
            border-radius: 6px;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Set the flex direction to column */
            align-items: flex-start; /* Align items to the start (left) */
        }

        li {
            display: inline;
            border: 1px solid white; /* Add a border to the bottom of each li */
            padding: 5px; /* Add some padding to visually separate the text from the border */
        }

        /* Adjust the color and size of icons */
        i.fas {
            color: white; /* Set the color to white */
            font-size: 18px; /* Adjust the size of icons */
        }

        a {
            text-decoration: none;
            color: #4f42bd;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #68978b;
        }

        #content {
            display: flex;
            flex-direction: row; /* Set the flex direction to row */
            justify-content: space-between;
        }
    </style>
</head>
<body>
<header>
        <h1>Welcome to Codex Portal</h1>
    </header> 
<div id="content">
    <nav>
        <ul>
            <li><a onclick='loadData("C:/wamp64/www/vit-lms-2.0/course-mgnt/upload_course_file.html","/lms/html/");'><i class="fas fa-file-upload"></i></a></li>
            <li><a onclick='loadData("C:/wamp64/www/vit-lms-2.0/course-mgnt/course_page.html","/lms/html/");'><i class="fas fa-file"></i></a></li>
            <li><a onclick='redirect("C:/wamp64/www/vit-lms-2.0/resources/index.html","/lms/html/");'><i class="fas fa-file-alt"></i></a></li>
        </ul>
    </nav>
<div id = "main-content">
<style>
        
    .todo-container {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        margin: 50px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 90px;
        overflow-x: auto;
        flex-grow: 1; /* Allow the main content to grow and fill available space */
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
<script>
    function loadData(url,route){
            console.log(url);
            url = encodeURIComponent(url);
            fetch(route+url).then(response => {
                if(!response.ok){
                    console.log('error in values');
                }
                console.log("Success");
                return response.text();
            }).then(data => {
                document.getElementById('main-content').innerHTML = data;
            })
    }

        function redirect(url){
            url = encodeURIComponent(url);
            window.location.replace('/lms/html/'+url);
        }
</script>
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
<div>
</body>
</html>