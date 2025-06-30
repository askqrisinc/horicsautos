<?php
require 'db.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $message]);
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
  <title>Contact Us | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f9fbfd; }
    .contact-box { max-width: 600px; margin: 60px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    .form-control, textarea { border-radius: 6px; }
    .btn-primary { background: #ff4f1c; border: none; }
    .btn-primary:hover { background: #e93d0a; }
    .alert { margin-top: 20px; }
  </style>
</head>
<body>

<div class="container">
  <div class="contact-box">
    <h2 class="mb-4 text-center">Contact the Owner</h2>

    <?php if ($success): ?>
      <div class="alert alert-success">Your message has been sent successfully!</div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" novalidate>
      <div class="mb-3">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($name ?? '') ?>">
      </div>
      <div class="mb-3">
        <label>Email *</label>
        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($email ?? '') ?>">
      </div>
      <div class="mb-3">
        <label>Phone</label>
        <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($phone ?? '') ?>">
      </div>
      <div class="mb-3">
        <label>Message *</label>
        <textarea name="message" class="form-control" rows="4" required><?= htmlspecialchars($message ?? '') ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100">Send Message</button>
    </form>

    <div class="mt-4 text-muted text-center">
      Or contact us directly:<br>
      📞 1226-436-11800 | 📧 info@horicsautos.com
    </div>
  </div>
</div>

</body>
</html>
