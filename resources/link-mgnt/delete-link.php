<?php
$conn = mysqli_connect("localhost", "root", "", "university");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['linkid'],$_GET['coursename'])) {
    $fileId = $_GET['linkid'];
    $course = $_GET['coursename'];
    $sql = "SELECT * FROM link_mgnt WHERE id = $fileId";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $deleteSql = "DELETE FROM link_mgnt WHERE id = $fileId";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('success')</script>";
        echo "<script>window.location.href='link-site.php?coursename=" . $course . "'</script>";

        exit();
    } 
    else {
        echo "Error deleting record: " . $conn->error;
    }   
} 
else {
    echo "File not found.";
    }

$conn->close();
?>
