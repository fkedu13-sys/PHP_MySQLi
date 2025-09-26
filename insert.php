<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    $sql = "INSERT INTO students (first_name,last_name,gender,date_of_birth,email,phone_number,enrollment_date)
            VALUES ('$first_name','$last_name','$gender','$date_of_birth','$email','$phone_number',CURDATE())";

    if (mysqli_query($conn, $sql)) {
        header("Location: select.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h1 class="mb-4">Add a New Student</h1>
    <form method="post" action="insert.php" class="row g-3">
      <div class="col-md-6">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-select" required>
          <option>Male</option>
          <option>Female</option>
          <option>Other</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="date_of_birth" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="form-label">Phone</label>
        <input type="text" name="phone_number" class="form-control">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-success">Add Student</button>
        <a href="select.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
