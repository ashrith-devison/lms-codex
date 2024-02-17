<?php
$conn = mysqli_connect("localhost", "root", "", "university");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $fileId = $argv[1];

    $sql = "SELECT * FROM files_uploaded WHERE id = $fileId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = "C:/wamp64/www/vit-lms-2.0/university_files/";
        $filePath = $filePath . $row['folderpath'] . '/' . $row['filename'];
        if (unlink($filePath)) {
            // Delete file record from database
            $deleteSql = "DELETE FROM files_uploaded WHERE id = $fileId";
            if ($conn->query($deleteSql) === TRUE) {
                echo "<script>alert('success')</script>";
                echo "<script>window.location.href='/lms/content'</script>";
                exit();
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error deleting file from server.";
        }
    } else {
        echo "File not found.";
    }
$conn->close();
?>
