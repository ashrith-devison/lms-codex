<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Links</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <style>
      
        body{
            background: rgb(24, 32, 41);
        }
        h1{
            color: white;
        }
        #topicsContainer {
            margin: 20px;
            background: white;
            border-radius: 5px;
            padding: 19px;
        }

        .topics h2 {
            cursor: pointer;
            color: #0066cc;
            margin: 0;
        }

        .notes {
            margin: 20px;
        }

        #toggleButton {
            background-color: #0066cc;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        #toggleButton:hover {
            background-color: #004080;
        }

        .notes h2 {
            color: #0066cc;
        }

        .notes p {
            margin-top: 10px;
            line-height: 1.6;
        }
        body {
            font-family: 'Roboto', sans-serif;
        }

        .container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            caret-color: black;
        }

        .topics {
            flex: 1;
            margin-right: 20px;
            font-size: 12px;
        }

        .topics h2 {
            cursor: pointer;
            color: #0066cc;
            margin: 0;
        }

        .notes-container {
            flex: 2;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            background: white;
            border-radius: 5px;
            padding: 19px;
            
        }

        .notes h2 {
            color: #0066cc;
        }

        .notes p {
            margin-top: 10px;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <header>
        <h1>Uploaded Links</h1>
    </header>

    <div class="container">
        <div class="topics" id="topicsContainer" hidden>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "university");

            if(isset($_POST['coursename'])){
                $course = mysqli_real_escape_string($conn, $_POST["coursename"]);
                if ($conn->connect_error) {
                    die("Connection Error");
                } else {
                    $query = "SELECT * FROM link_mgnt WHERE subject = '$course'";
                    $result = $conn->query($query);
                    $count = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<ul>";
                            echo "<li><h2 onclick='toggleNotes($count)'><a href='#notes$count'>" . $row['topic'] . "</a></h2></li>";
                            $count++;
                            echo "</ul>";
                        }
                    }
                }
            }
            ?>
        </div>

        <div class="notes-container">
            <button id="toggleButton" onclick="toggleTopics()">Topics</button>
            <button id="toggleButton" onclick="redirect('index.php')">Home</button>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "university");
            if ($conn->connect_error) {
                die("Connection Error");
            } else {
                $query = "SELECT * FROM link_mgnt WHERE subject = 'Design and Analysis of Algorithms'";
                $result = $conn->query($query);
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $decodedNotes = html_entity_decode($row['notes']);
                        echo "<div id='notes$count' style='display:none;' class='notes'>";
                        echo "<hr><h2><b><u><a name='notes$count'></a>" . $row['topic'] . "</u></b></h2><br>";
                        echo "<p>" . $decodedNotes . "</p>";
                        echo "</div>";
                        $count++;
                    }
                }
            }
            ?>
        </div>
    </div>

    <script>
        function toggleNotes(index) {
            var notes = document.getElementById('notes' + index);
            if (notes.style.display === 'none' || notes.style.display === '') {
                notes.style.display = 'block';
                notes.scrollIntoView({ behavior: 'smooth' });
            } else {
                notes.style.display = 'none';
            }
        }

        function toggleTopics() {
            var topics = document.getElementById('topicsContainer');
            if (topics.style.display === 'none' || topics.style.display === '') {
                topics.style.display = 'block';
            } else {
                topics.style.display = 'none';
            }
        }

        function redirect(page){
            window.location.href = page;
        }
    </script>

</body>
</html>
