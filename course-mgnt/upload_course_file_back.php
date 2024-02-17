<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "university");

        $coursefile = mysqli_real_escape_string($conn, $argv[1]);   
        $filename = $argv[2];
        $timestamp = date("Y-m-d H:i:s");
            $query = "INSERT INTO files_uploaded 
            (filename, folderpath, time_stamp)
            VALUES('$filename','$coursefile','$timestamp' )";

            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Upload Success');
                    window.location.replace('/lms/content'); 
                </script>";
            } 
            else {
                echo "<script>alert('Error in Database')</script>";
            }
?>
