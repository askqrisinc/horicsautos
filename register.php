<?php
require 'db.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm = $_POST['confirm_password'] ?? '';

  if ($name && $email && $password && $password === $confirm) {
    $hashed = password_hash($password, PASSWORD_BCRYPT);

    try {
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
      $stmt->execute([$name, $email, $hashed]);
      $success = true;
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        $error = "Email already registered.";
      } else {
        $error = "Something went wrong. Please try again.";
      }
    }
  } else {
    $error = "Please fill out all fields correctly.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f9fbfd; }
    .register-form {
      max-width: 500px; margin: 60px auto; background: #fff;
      padding: 30px; border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    .btn-primary { background: #ff4f1c; border: none; }
    .btn-primary:hover { background: #e7420f; }
  </style>
</head>
<body>

<div class="container">
  <div class="register-form">
    <h2 class="text-center mb-4">Create Account</h2>

    <?php if ($success): ?>
      <div class="alert alert-success">Account created successfully. <a href="login.php">Login here</a>.</div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Your Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required minlength="6">
      </div>
      <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
  </div>
</div>

</body>
</html>
