<script>
    history.replaceState(null,null,'/lms/content');
</script>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course Site</title>
        <style>
            #main-content {
                margin-top: 5px;
                font-family: 'Arial', sans-serif;
                background-color: #f2f2f2;
                padding: 30px;
                border: black solid;
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
<script>
        function loadData(url){
            window.location.replace(url);
        }
    </script>
    <?php
        $conn = mysqli_connect("localhost","root","","university");
        $course = $argv[1];
        if($conn->connect_error){
            die("Connection Error");
        }
        else{
            $query = "SELECT * FROM files_uploaded WHERE folderpath LIKE '%" . $course. "%'";
            $result = $conn->query($query);  
            echo "<h1>Uploaded Files :</h1>";
            echo "<h2>".$course."</h2>";    
        }
        $conn->close();
    ?>
    <table>
        <thead>
            <tr>
                <th>No:</th>
                <th>File Name</th>
                <th>Action</th>
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
                        echo "<td>".$row['filename']."</td>";
                        echo "<td><a href='/file-serve/" . $row['folderpath'] .'/'. $row['filename'] . "' target='_blank'>view</a></td>";
                        echo "<td> <a class='delete-link' href='/file-delete/".$row['id']."'>delete</a></td>";
                        echo "</tr>";
                        $count++;
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>
