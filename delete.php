<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM students WHERE student_id=$id");
}
mysqli_close($conn);
header("Location: select.php");
exit;
?>
