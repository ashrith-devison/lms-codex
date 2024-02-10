<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "university");

    if (isset($_POST['submit'])) {
      $coursefile = mysqli_real_escape_string($conn, $_POST["coursename"]);
      $targetDir = "university_files/".$coursefile."/";
      $targetFile = $targetDir . basename($_FILES["pdffile"]["name"]);
      $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
      $filesize = $_FILES["pdffile"]["size"]; // Added file size check
        
        if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], '../'.$targetFile)) {
            $filename = $_FILES["pdffile"]["name"];
            $folderpath = $targetDir;
            $timestamp = date("Y-m-d H:i:s");
            $query = "INSERT INTO files_uploaded 
            (filename, folderpath, time_stamp)
            VALUES('$filename','$folderpath','$timestamp' )";

            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Upload Success')</script>";
            } 
            else {
                echo "<script>alert('Error in Database')</script>";
            }
        } 
        else {
            echo "Error in uploading";
        }
    }
    echo '<script>window.location.href = "../home.php";</script>';
?>
