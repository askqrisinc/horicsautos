<?php
require 'db.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $make = trim($_POST['make'] ?? '');
  $model = trim($_POST['model'] ?? '');
  $year = (int) ($_POST['year'] ?? 0);
  $mileage = (int) ($_POST['mileage'] ?? 0);
  $condition = trim($_POST['condition'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if ($name && $email && $make && $model && $year > 1900) {
    $stmt = $pdo->prepare("INSERT INTO trade_ins (name, email, phone, make, model, year, mileage, condition, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $make, $model, $year, $mileage, $condition, $message]);
    $success = true;
  } else {
    $error = "Please fill out all required fields correctly.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trade-In Your Vehicle | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f4f7fa; }
    .trade-form { max-width: 700px; margin: 60px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    h2 { text-align: center; margin-bottom: 30px; }
    .btn-primary { background: #ff4f1c; border: none; }
    .btn-primary:hover { background: #e7420f; }
    .alert { margin-top: 20px; }
  </style>
</head>
<body>

<div class="container">
  <div class="trade-form">
    <h2>Trade-In Vehicle Evaluation</h2>

    <?php if ($success): ?>
      <div class="alert alert-success">Thank you! We will review your vehicle and contact you shortly.</div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="row g-3">
        <div class="col-md-6">
          <label>Your Name *</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label>Email *</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label>Phone</label>
          <input type="tel" name="phone" class="form-control">
        </div>
        <div class="col-md-6">
          <label>Make *</label>
          <input type="text" name="make" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label>Model *</label>
          <input type="text" name="model" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label>Year *</label>
          <input type="number" name="year" class="form-control" required min="1900" max="<?= date('Y') ?>">
        </div>
        <div class="col-md-3">
          <label>Mileage</label>
          <input type="number" name="mileage" class="form-control">
        </div>
        <div class="col-md-12">
          <label>Condition / Notes</label>
          <textarea name="condition" class="form-control" rows="3" placeholder="e.g. Good, needs minor repairs..."></textarea>
        </div>
        <div class="col-md-12">
          <label>Message (optional)</label>
          <textarea name="message" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100 mt-4">Submit for Evaluation</button>
    </form>
  </div>
</div>

</body>
</html>
