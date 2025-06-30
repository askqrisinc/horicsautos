<?php
require 'db.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $make = trim($_POST['make'] ?? '');
  $model = trim($_POST['model'] ?? '');
  $min_price = (int) ($_POST['min_price'] ?? 0);
  $max_price = (int) ($_POST['max_price'] ?? 0);

  if ($email) {
    $stmt = $pdo->prepare("INSERT INTO vehicle_alerts (email, make, model, min_price, max_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$email, $make, $model, $min_price, $max_price]);
    $success = true;
  } else {
    $error = "Please enter a valid email.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vehicle Alerts | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f4f7fa; }
    .alert-form { max-width: 600px; margin: 60px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    h2 { text-align: center; margin-bottom: 30px; }
    .btn-primary { background: #ff4f1c; border: none; }
    .btn-primary:hover { background: #e7430e; }
    .alert { margin-top: 20px; }
  </style>
</head>
<body>

<div class="container">
  <div class="alert-form">
    <h2>Sign Up for Vehicle Alerts</h2>

    <?php if ($success): ?>
      <div class="alert alert-success">Thank you! We'll email you when matching vehicles are added.</div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Email Address *</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Preferred Make</label>
        <input type="text" name="make" class="form-control">
      </div>
      <div class="mb-3">
        <label>Preferred Model</label>
        <input type="text" name="model" class="form-control">
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Minimum Price ($)</label>
          <input type="number" name="min_price" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label>Maximum Price ($)</label>
          <input type="number" name="max_price" class="form-control">
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Subscribe</button>
    </form>
  </div>
</div>

</body>
</html>
