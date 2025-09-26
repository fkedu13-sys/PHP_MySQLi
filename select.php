<?php
include 'db_connect.php';

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY last_name ASC, first_name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1 class="mb-4 text-center">Student List</h1>
  <div class="text-center mb-3">
    <a href="index.html" class="btn btn-secondary">Back to Home</a>
  </div>
  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th><th>First Name</th><th>Last Name</th><th>Gender</th>
        <th>Date of Birth</th><th>Email</th><th>Phone</th><th>Enrollment Date</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
        <td><?php echo htmlspecialchars($row['gender']); ?></td>
        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
        <td><?php echo htmlspecialchars($row['enrollment_date']); ?></td>
        <td>
          <a href="update.php?id=<?php echo urlencode($row['student_id']); ?>" class="btn btn-sm btn-primary">Edit</a>
          
          <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['student_id']; ?>">
            Delete
          </button>

         
          <div class="modal fade" id="deleteModal<?php echo $row['student_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $row['student_id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel<?php echo $row['student_id']; ?>">Confirm Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete <?php echo htmlspecialchars($row['first_name'] . " " . $row['last_name']); ?>?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <a href="delete.php?id=<?php echo urlencode($row['student_id']); ?>" class="btn btn-danger">Yes, Delete</a>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
