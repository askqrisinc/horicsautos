<?php
require 'db.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $date = $_POST['preferred_date'] ?? '';
  $message = trim($_POST['message'] ?? '');
  $vehicle_id = $_POST['vehicle_id'] ?? null;

  if ($name && $email && $date) {
    // Store in database
    $stmt = $pdo->prepare("INSERT INTO test_drive_bookings (name, email, phone, preferred_date, message, vehicle_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $date, $message, $vehicle_id]);

    // Send email
    $to = 'info@horicsautos.com';
    $subject = "Test Drive Request from $name";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nPreferred Date: $date\nMessage: $message\nVehicle ID: $vehicle_id";
    $headers = "From: $email";

    mail($to, $subject, $body, $headers);

    $success = true;
  } else {
    $error = "Please fill out all required fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Test Drive | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8f9fc; }
    .btn-primary { background-color: #ff4f1c; border: none; }
    .btn-primary:hover { background-color: #e63e0d; }
    .modal-header { background: #ff4f1c; color: white; }
  </style>
</head>
<body>

<div class="container text-center my-5">
  <h2>Book a Test Drive</h2>
  <p>Click below to request a test drive for your selected vehicle.</p>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#testDriveModal">Book Now</button>

  <?php if ($success): ?>
    <div class="alert alert-success mt-4">Your test drive request has been submitted!</div>
  <?php elseif ($error): ?>
    <div class="alert alert-danger mt-4"><?= $error ?></div>
  <?php endif; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="testDriveModalLabel">Book a Test Drive</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="vehicle_id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">
        <div class="mb-3">
          <label>Your Name *</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email Address *</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Phone</label>
          <input type="tel" name="phone" class="form-control">
        </div>
        <div class="mb-3">
          <label>Preferred Test Drive Date *</label>
          <input type="date" name="preferred_date" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Message (optional)</label>
          <textarea name="message" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit Request</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($success): ?>
<script>
  const successModal = new bootstrap.Modal(document.getElementById('testDriveModal'));
  successModal.hide();
</script>
<?php endif; ?>

</body>
</html>
