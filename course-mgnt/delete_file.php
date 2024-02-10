<?php
$conn = mysqli_connect("localhost", "root", "", "university");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['fileId'])) {
    $fileId = $_GET['fileId'];

    $sql = "SELECT * FROM files_uploaded WHERE id = $fileId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = '../' . $row['folderpath'] . '/' . $row['filename'];

        // Delete file from server
        if (unlink($filePath)) {
            // Delete file record from database
            $deleteSql = "DELETE FROM files_uploaded WHERE id = $fileId";
            if ($conn->query($deleteSql) === TRUE) {
                echo "<script>alert('success')</script>";
                echo "<script>window.location.href='course_page.html'</script>";
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
} else {
    echo "Invalid parameters.";
}

$conn->close();
?>
