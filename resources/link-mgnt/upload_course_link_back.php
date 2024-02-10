<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "university");

    if (isset($_POST['submit'])) {
      $coursefile = mysqli_real_escape_string($conn, $_POST["coursename"]);
      $link = mysqli_real_escape_string($conn, $_POST["yt-link"]);
      $topic = mysqli_real_escape_string($conn, $_POST["topic-name"]);
    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO link_mgnt 
    (subject, topic, link, updatedtime)
    VALUES('$coursefile','$topic','$link','$timestamp' )";
        if ($conn->query($query) === TRUE) {
            echo "<script>alert('Upload Success')</script>";
        } 
        else {
            echo "<script>alert('Error in Database')</script>";
        }
    }
    echo '<script>window.location.href = "upload_course_link.html";</script>';
?>
