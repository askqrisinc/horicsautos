<?php
require 'db.php';

// Get vehicle IDs from URL
$ids = isset($_GET['ids']) ? explode(',', $_GET['ids']) : [];
$placeholders = implode(',', array_fill(0, count($ids), '?'));

// If no IDs passed, show message
if (empty($ids)) {
    echo "No vehicles selected for comparison.";
    exit;
}

// Fetch vehicles from DB
$stmt = $pdo->prepare("SELECT * FROM vehicles WHERE id IN ($placeholders)");
$stmt->execute($ids);
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Compare Vehicles | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f4f6fa; }
    .comparison-table { overflow-x: auto; }
    .compare-cell img { height: 150px; object-fit: cover; border-radius: 6px; }
    .table thead th { background: #ff4f1c; color: white; text-align: center; }
    .table td, .table th { vertical-align: middle; text-align: center; }
    h1 { text-align: center; margin-top: 30px; }
  </style>
</head>
<body>

<div class="container my-5">
  <h1>Compare Vehicles</h1>
  <div class="comparison-table mt-4">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Feature</th>
          <?php foreach ($vehicles as $v): ?>
            <th><?= $v['year'] . ' ' . $v['make'] . ' ' . $v['model'] ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Image</th>
          <?php foreach ($vehicles as $v): ?>
            <td class="compare-cell"><img src="<?= htmlspecialchars($v['image']) ?>" width="100"></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Price</th>
          <?php foreach ($vehicles as $v): ?>
            <td>$<?= number_format($v['price']) ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Mileage</th>
          <?php foreach ($vehicles as $v): ?>
            <td><?= number_format($v['mileage']) ?> mi</td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Fuel Type</th>
          <?php foreach ($vehicles as $v): ?>
            <td><?= $v['fuel_type'] ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Transmission</th>
          <?php foreach ($vehicles as $v): ?>
            <td><?= $v['transmission'] ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Body Type</th>
          <?php foreach ($vehicles as $v): ?>
            <td><?= $v['body_type'] ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Location</th>
          <?php foreach ($vehicles as $v): ?>
            <td><?= $v['location'] ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Details</th>
          <?php foreach ($vehicles as $v): ?>
            <td><a href="vehicle.php?id=<?= $v['id'] ?>" class="btn btn-sm btn-outline-primary">View</a></td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
