<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course Site</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f2f2f2;
                margin: 20px;
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

            tr:hover {
                background-color: #f5f5f5;
            }

            a {
                text-decoration: none;
                color: #3498db;
                font-weight: bold;
            }

            a:hover {
                color: #21618C;
            }

            .upload-link {
                display: block;
                margin-top: 10px;
                padding: 10px;
                text-align: center;
                background-color: #3498db;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }

            .back-link {
                        display: block;
                        margin-top: 10px;
                        padding: 10px;
                        text-align: center;
                        background-color: #2ecc71;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                    }

            .back-link:hover {
                        background-color: #27ae60;
            }

            @media (min-width: 768px) {
                /* Adjust styles for larger screens (desktop) */
                body {
                    margin: 40px;
                }

                table {
                    width: 80%;
                    margin: 20px auto;
                }

                .upload-link {
                    position: fixed;
                    top: 40px;
                    right: 40px;
                }
            }
            .delete-link {
                color: #e74c3c;
                font-weight: bold;
                cursor: pointer;
            }

            .delete-link:hover {
                color: #c0392b;
            }
    </style>
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost","root","","university");
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $course = mysqli_real_escape_string($conn, $_POST["coursename"]);
        }
        else if($_SERVER['REQUEST_METHOD'] == "GET"){
            $course = mysqli_real_escape_string($conn, $_GET["coursename"]);
        }

        if($conn->connect_error){
            die("Connection Error");
        }
        else{
            $query = "SELECT * FROM link_mgnt WHERE subject = '$course'";
            $result = $conn->query($query);  
            echo "<h1>Uploaded Links :</h1>";
            echo "<h2>".$course."</h2>";    
        }
        $conn->close();
    ?>
    <a href='upload_course_link.html' class='upload-link'>Upload More Links</a>
    <a href='link-page.html' class='back-link'>Back to Course Page</a>
    <table>
        <thead>
            <tr>
                <th>No:</th>
                <th>Topic Name</th>
                <th>Video</th>
                <th>Delete</th> <!-- New column for delete action -->
            </tr>
        </thead>
        <tbody>
            <?php
                $count = 1;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$count."</td>";
                        echo "<td>".$row['topic']."</td>";
                        echo "<td> <a href= 'video-view.php?video-url=".urlencode($row['link']). "&video-id=".urlencode($row['id'])."' target='_blank'>view</a></td>";
                        echo "<td> <a class='delete-link' href='delete-link.php?linkid=".urlencode($row['id'])."&coursename=".$course."'>delete</a></td>";
                        
                        echo "</tr>";
                        $count++;
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>
