<?php
// Connect to DB
require 'db.php';

// Fetch vehicles
$stmt = $pdo->query("SELECT * FROM vehicles ORDER BY id DESC");
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Horics Autos - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .vehicle-card img { height: 200px; object-fit: cover; }
    .search-form select, .search-form input { font-size: 0.9rem; }
  </style>
</head>
<body>

<!-- Hero -->
<header class="bg-dark text-white text-center py-5">
  <div class="container">
    <h1 class="display-5 fw-bold">Find Your Perfect Car</h1>
    <p>Browse our extensive inventory of high-quality vehicles</p>
  </div>
</header>

<!-- Search Filters -->
<section class="bg-light py-4">
  <div class="container">
    <form id="filterForm" class="row g-2 search-form">
      <div class="col-md"><input type="text" id="searchInput" class="form-control" placeholder="Search Make or Model"></div>
      <div class="col-md"><select id="fuelFilter" class="form-select"><option value="">Fuel Type</option><option>Petrol</option><option>Diesel</option><option>Hybrid</option></select></div>
      <div class="col-md"><select id="bodyFilter" class="form-select"><option value="">Body Type</option><option>SUV</option><option>Coupe</option><option>Sedan</option></select></div>
      <div class="col-md"><button type="button" class="btn btn-danger w-100" onclick="filterVehicles()">Search</button></div>
    </form>
  </div>
</section>

<!-- Vehicle Inventory -->
<section class="py-5">
  <div class="container">
    <h2 class="mb-4">Vehicle Inventory</h2>
    <div class="row" id="vehicleList">

      <?php foreach ($vehicles as $v): ?>
      <div class="col-md-4 mb-4 vehicle-card" 
           data-make="<?= strtolower($v['make']) ?>" 
           data-model="<?= strtolower($v['model']) ?>" 
           data-fuel="<?= strtolower($v['fuel_type']) ?>" 
           data-body="<?= strtolower($v['body_type']) ?>">
        <div class="card h-100">
          <img src="<?= htmlspecialchars($v['image']) ?>" class="card-img-top" alt="<?= $v['make'] . ' ' . $v['model'] ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $v['year'] ?> <?= $v['make'] ?> <?= $v['model'] ?></h5>
            <p class="card-text">$<?= number_format($v['price'], 2) ?> | <?= number_format($v['mileage']) ?> mi</p>
            <a href="vehicle.php?id=<?= $v['id'] ?>" class="btn btn-primary btn-sm">View Details</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<script>
function filterVehicles() {
  const keyword = document.getElementById('searchInput').value.toLowerCase();
  const fuel = document.getElementById('fuelFilter').value.toLowerCase();
  const body = document.getElementById('bodyFilter').value.toLowerCase();

  document.querySelectorAll('.vehicle-card').forEach(card => {
    const make = card.getAttribute('data-make');
    const model = card.getAttribute('data-model');
    const fuelType = card.getAttribute('data-fuel');
    const bodyType = card.getAttribute('data-body');

    const matchSearch = !keyword || make.includes(keyword) || model.includes(keyword);
    const matchFuel = !fuel || fuelType === fuel;
    const matchBody = !body || bodyType === body;

    card.style.display = (matchSearch && matchFuel && matchBody) ? 'block' : 'none';
  });
}
</script>

</body>
</html>
