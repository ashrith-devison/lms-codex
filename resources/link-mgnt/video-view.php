<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video Viewer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            display: flex;
            margin: 0;
            overflow: hidden;
            background : black;
            caret-color: black;
        }

        #videoContainer {
            height: 90vh;
            width: 70%;
            margin: 10px;
            border: 8px solid #3498db;
            border-radius: 15px;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 100%;
        }

        #notepadContainer {
            width: 30%;
            height: 50%;
            padding: 10px;
            margin: 3px;
            box-sizing: border-box;
            background : white;
            border-radius : 9px;
            caret-color: black;
        }

        label {
            display: block;
            font-size: 24px;
            margin-bottom: 10px;
            position:relative;
            margin-left:2px;
        }

        [contenteditable="true"] {
            width: 100%;
            height: 70vh;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 10px;
            font: "roboto";
            font-size: 18px;
            box-sizing: border-box;
            margin-bottom: 20px;
            overflow: auto;
            
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Custom alert box styles */
        #customAlert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #34495e;
            color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #customAlertContent {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
        }

        #customAlert button {
            padding: 10px;
            background-color: #34495e;
            color: #ffffff;
            border: 2px solid #ffffff;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        #customAlert button:hover {
            background-color: #2c3e50;
            color: #ffffff;
        }
            @media only screen and (max-width: 768px) {
        /* Mobile and Tablet Styles */

            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                overflow: auto;
                background : black;
                caret-color: black;
            }

        #videoContainer,
        #notepadContainer {
            width: 90%;
            margin: 5px auto; /* Adjusted margin */
            box-sizing: border-box;
        }

        #videoContainer {
            height: 50vh;
            border: 8px solid #3498db;
            border-radius: 15px;
            overflow: hidden;
        }

        #notepadContainer {
            padding: 10px;
            width:90%;
            height: 10%; /* Adjusted height */
            overflow: auto;
        }
    }

</style>
</head>
<body>

<?php
    if (isset($_GET['video-url'],$_GET['video-id'])) {
        $videoUrl = $_GET['video-url'];
        $videoid = $_GET['video-id'];

        if (filter_var($videoUrl, FILTER_VALIDATE_URL) && strpos($videoUrl, 'youtube.com') !== false) {
            $videoId = getYouTubeVideoId($videoUrl);
            echo '<div id="videoContainer">
                    <iframe src="https://www.youtube.com/embed/' . $videoId . '" allowfullscreen></iframe>
                </div>';
        } else {
            echo '<p>Invalid YouTube video URL.</p>';
        }
    } else {
        echo '<p>No video URL provided.</p>';
    }

    function getYouTubeVideoId($url) {
        $videoId = '';
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $url, $matches);
        if (isset($matches[1])) {
            $videoId = $matches[1];
        }
        return $videoId;
    }
?>

<div id="notepadContainer">
<label>Notes</label>
    <div contenteditable="true" id="noteContent" placeholder="Write your notes here..." >
        <?php
        // Assuming you have a valid database connection
        $dsn = "mysql:host=localhost;dbname=university";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch notes from the database
            $sql = "SELECT notes FROM link_mgnt WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $videoid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Decode HTML content and display with formatting
                $decodedNoteText = htmlspecialchars_decode($result['notes'], ENT_QUOTES);
                echo $decodedNoteText;
            } else {
                echo "Note not found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $pdo = null;
        }
        ?>
    </div>
    <div>
        <button onclick="saveNote()">Save</button>
    </div>
</div>

<div id="customAlert"></div>

<script>
    function saveNote() {
        var videoUrl = encodeURIComponent("<?php echo $_GET['video-url']; ?>");
        var videoid = encodeURIComponent("<?php echo $_GET['video-id']; ?>");
        var noteText = encodeURIComponent(document.getElementById("noteContent").innerHTML);

        var formData = new FormData();
        formData.append('video-url', videoUrl);
        formData.append('video-id', videoid);
        formData.append('notes', noteText);

        fetch('save_note.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            showAlert('Note saved successfully!', '');
            window.location.href = "save_note.php?video-url=" + videoUrl + "&video-id=" + videoid + "&notes=" + noteText;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function showAlert(message, page) {
        var alertBox = document.getElementById('customAlert');
        alertBox.style.display = 'block';
        alertBox.innerHTML = `<p>${message}</p><button onclick="hideAlert('${page}')">OK</button>`;
    }

    function hideAlert(page) {
        var alertBox = document.getElementById('customAlert');
        alertBox.style.display = 'none';
        alertBox.innerHTML = '';
        if (page !== '') {
            window.location.href = page;
        }
    }
</script>
</body>
</html>
