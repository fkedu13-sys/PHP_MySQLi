<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['student_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name', gender='$gender',
            date_of_birth='$date_of_birth', email='$email', phone_number='$phone_number' WHERE student_id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: select.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM students WHERE student_id=$id");
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        die("Student not found.");
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h1 class="mb-4">Update Student</h1>
    <form method="post" action="update.php" class="row g-3">
      <input type="hidden" name="student_id" value="<?= $row['student_id']; ?>">
      <div class="col-md-6">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" value="<?= $row['first_name']; ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="<?= $row['last_name']; ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-select" required>
          <option <?= $row['gender']=='Male'?'selected':'' ?>>Male</option>
          <option <?= $row['gender']=='Female'?'selected':'' ?>>Female</option>
          <option <?= $row['gender']=='Other'?'selected':'' ?>>Other</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="date_of_birth" class="form-control" value="<?= $row['date_of_birth']; ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= $row['email']; ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Phone</label>
        <input type="text" name="phone_number" class="form-control" value="<?= $row['phone_number']; ?>">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-warning">Update Student</button>
        <a href="select.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
