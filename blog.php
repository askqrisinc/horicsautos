<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Blog | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f9fbfd;
    }
    .blog-section {
      padding: 60px 0;
    }
    .section-title {
      text-align: center;
      margin-bottom: 40px;
      color: #333;
    }
    .blog-card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      overflow: hidden;
      transition: transform 0.2s;
      height: 100%;
    }
    .blog-card:hover {
      transform: translateY(-4px);
    }
    .blog-card img {
      height: 200px;
      object-fit: cover;
    }
    .blog-card .card-body {
      padding: 20px;
    }
    .blog-card h5 {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }
    .blog-card p {
      font-size: 0.95rem;
      color: #666;
    }
    .read-more {
      color: #ff4f1c;
      font-weight: 500;
      text-decoration: none;
    }
    .read-more:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<section class="container blog-section">
  <h2 class="section-title">Latest from Our Blog</h2>
  <div class="row g-4">

    <div class="col-md-4">
      <div class="card blog-card h-100">
        <img src="img/blog1.jpg" class="card-img-top" alt="Blog Image 1">
        <div class="card-body">
          <h5 class="card-title">Top 5 Fuel-Efficient Cars in 2025</h5>
          <p>Discover the latest models that save you money at the pump without sacrificing performance or style.</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card blog-card h-100">
        <img src="img/blog2.jpg" class="card-img-top" alt="Blog Image 2">
        <div class="card-body">
          <h5 class="card-title">What to Look for in a Used Car</h5>
          <p>Our expert checklist helps you avoid common pitfalls when buying a pre-owned vehicle.</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card blog-card h-100">
        <img src="img/blog3.jpg" class="card-img-top" alt="Blog Image 3">
        <div class="card-body">
          <h5 class="card-title">How to Trade in Your Vehicle</h5>
          <p>Learn how to maximize your car's value when trading in for a new or used vehicle at Horics Autos.</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>
    </div>

  </div>
</section>

</body>
</html>
