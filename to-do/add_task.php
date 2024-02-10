<?php
    $conn = mysqli_connect("localhost", "root", "", "university");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $deadline = $_POST['deadline'];
    $work = $_POST['work'];
    $subject = $_POST['subject'];
    $remarks = $_POST['remarks'];
    $action = $_POST['action'];

    $query = "INSERT INTO todo_list (deadline, work, subject, remarks, action) 
              VALUES ('$deadline', '$work', '$subject', '$remarks', '$action')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Task added successfully!')</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    echo
        "<script>window.location.href = '../home.php';</script>";
    mysqli_close($conn);
?>
