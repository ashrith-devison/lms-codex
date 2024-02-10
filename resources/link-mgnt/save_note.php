<head>
    <style>
        #customAlert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #34495e; /* Light navy blue color */
            color: #ffffff; /* White text */
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #customAlertContent {
            background-color: #ffffff; /* White box inside */
            padding: 15px;
            border-radius: 8px;
        }

        #customAlert button {
            padding: 10px;
            background-color: #34495e; /* Light navy blue button background */
            color: #ffffff; /* White button text color */
            border: 2px solid #ffffff; /* White button border */
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }

        #customAlert button:hover {
            background-color: #2c3e50; /* Darker navy blue on hover */
            color: #ffffff; /* White text on hover */
        }
    </style>
</head>
<html>
<div id='customAlert'></div>
</html>
<?php

$dsn = "mysql:host=localhost;dbname=university";
$username = "root";
$password = "";
if(isset($_GET['video-id'],$_GET['notes'],$_GET['video-url'])){
$videoid = $_GET['video-id'];
$noteText = $_GET['notes'];
$videourl = $_GET['video-url'];
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $encodedNoteText = htmlspecialchars($noteText, ENT_QUOTES, 'UTF-8');

    $stmt = $pdo->prepare("UPDATE link_mgnt SET notes = '$encodedNoteText' WHERE id = '$videoid'");
    $stmt->execute();
    echo "<script>showAlert('Note saved Successfully')</script>";
    $redirectlink = "video-view.php?video-url=".$videourl."&video-id=".$videoid;
    echo "<script>window.location.href='$redirectlink'</script>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $pdo = null;
}
}
?>