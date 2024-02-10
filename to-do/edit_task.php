<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "university");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $editTaskId = mysqli_real_escape_string($conn, $_POST["edit-task-id"]);
    $editDeadline = mysqli_real_escape_string($conn, $_POST["edit-deadline"]);
    $editWork = mysqli_real_escape_string($conn, $_POST["edit-work"]);
    $editSubject = mysqli_real_escape_string($conn, $_POST["edit-subject"]);
    $editRemarks = mysqli_real_escape_string($conn, $_POST["edit-remarks"]);
    $editAction = mysqli_real_escape_string($conn, $_POST["edit-action"]);

    $updateQuery = "UPDATE todo_list SET 
                    deadline = '$editDeadline',
                    work = '$editWork',
                    subject = '$editSubject',
                    remarks = '$editRemarks',
                    action = '$editAction'
                    WHERE id = '$editTaskId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Task updated successfully!')</script>";
    } else {
        echo "<script>alert('Error updating task: {mysqli_error($conn)}')</script>";
    }
    mysqli_close($conn);
    echo
        "<script>window.location.href = '../home.php'</script>";
}
?>
