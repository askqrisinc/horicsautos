<?php
require 'db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM vehicles WHERE id = ?");
$stmt->execute([$id]);
$vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vehicle) {
    echo "Vehicle not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $vehicle['year'] . ' ' . $vehicle['make'] . ' ' . $vehicle['model'] ?> | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8f9fc; }
    .main-image { height: 400px; object-fit: cover; width: 100%; border-radius: 10px; }
    .thumbs img { height: 80px; object-fit: cover; cursor: pointer; border-radius: 6px; }
    .specs li { padding: 6px 0; border-bottom: 1px solid #ddd; }
    .btn-primary { background: #ff4f1c; border: none; }
    .btn-outline-primary { border-color: #ff4f1c; color: #ff4f1c; }
    .btn-outline-primary:hover { background-color: #ff4f1c; color: #fff; }
    .card { border: none; border-radius: 10px; box-shadow: 0 3px 12px rgba(0,0,0,0.08); }
  </style>
</head>
<body>

<!-- Header -->
<header class="bg-dark text-white p-4 text-center">
  <h1><?= $vehicle['year'] ?> <?= $vehicle['make'] ?> <?= $vehicle['model'] ?></h1>
</header>

<!-- Main Section -->
<section class="container my-5">
  <div class="row g-5">
    <!-- Image Gallery -->
    <div class="col-md-6">
      <img src="<?= htmlspecialchars($vehicle['image']) ?>" id="mainImage" class="main-image mb-3" alt="Main image">

      <div class="d-flex gap-2 thumbs">
        <img src="<?= htmlspecialchars($vehicle['image']) ?>" onclick="changeImage(this.src)" class="img-thumbnail">
        <img src="img/<?= $vehicle['id'] ?>-2.jpg" onerror="this.style.display='none'" onclick="changeImage(this.src)" class="img-thumbnail">
        <img src="img/<?= $vehicle['id'] ?>-3.jpg" onerror="this.style.display='none'" onclick="changeImage(this.src)" class="img-thumbnail">
      </div>
    </div>

    <!-- Vehicle Info -->
    <div class="col-md-6">
      <h3 class="text-success">$<?= number_format($vehicle['price']) ?></h3>
      <ul class="list-unstyled specs">
        <li><strong>Mileage:</strong> <?= number_format($vehicle['mileage']) ?> mi</li>
        <li><strong>Transmission:</strong> <?= $vehicle['transmission'] ?></li>
        <li><strong>Fuel Type:</strong> <?= $vehicle['fuel_type'] ?></li>
        <li><strong>Body Type:</strong> <?= $vehicle['body_type'] ?></li>
        <li><strong>Location:</strong> <?= $vehicle['location'] ?></li>
      </ul>
      <div class="mt-4">
        <a href="book-test-drive.php?id=<?= $vehicle['id'] ?>" class="btn btn-primary">Book a Test Drive</a>
        <a href="carfax/<?= $vehicle['id'] ?>.pdf" target="_blank" class="btn btn-outline-primary ms-2">History Report</a>
      </div>
    </div>
  </div>

  <!-- Description -->
  <div class="mt-5">
    <h4>Description</h4>
    <p><?= nl2br(htmlspecialchars($vehicle['description'] ?? 'This vehicle is in great condition. Contact us for more info.')) ?></p>
  </div>
</section>

<script>
  function changeImage(src) {
    document.getElementById('mainImage').src = src;
  }
</script>

</body>
</html>
