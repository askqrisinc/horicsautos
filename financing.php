<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Financing Options | Horics Autos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f9fbfd; }
    .financing-section { padding: 60px 20px; max-width: 900px; margin: auto; }
    .calculator-box {
      background: #fff; border-radius: 10px; padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    .btn-primary { background: #ff4f1c; border: none; }
    .btn-primary:hover { background: #e7430e; }
    .section-title { text-align: center; margin-bottom: 40px; }
    .form-label { font-weight: 500; }
    #monthlyPayment {
      font-size: 1.3rem;
      font-weight: bold;
      color: #28a745;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="financing-section">
  <h2 class="section-title">Vehicle Financing & Loan Calculator</h2>

  <div class="mb-5">
    <p>At Horics Autos, we offer competitive vehicle financing options to help you get behind the wheel faster. Our partners provide affordable rates, quick approval, and flexible terms.</p>
    <ul>
      <li>✔️ Low-interest auto loans</li>
      <li>✔️ Finance both new and used vehicles</li>
      <li>✔️ Quick and easy approval process</li>
      <li>✔️ Trade-in credit included in your plan</li>
    </ul>
  </div>

  <div class="calculator-box">
    <h4 class="mb-4">Estimate Your Monthly Payment</h4>
    <form id="loanCalculator">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Vehicle Price ($)</label>
          <input type="number" class="form-control" id="price" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Down Payment ($)</label>
          <input type="number" class="form-control" id="down" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Interest Rate (%)</label>
          <input type="number" class="form-control" id="rate" step="0.01" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Loan Term (months)</label>
          <input type="number" class="form-control" id="term" required>
        </div>
        <div class="col-md-6 align-self-end">
          <button type="button" onclick="calculateLoan()" class="btn btn-primary w-100">Calculate</button>
        </div>
      </div>
    </form>
    <div id="monthlyPayment"></div>
  </div>
</div>

<script>
function calculateLoan() {
  const price = parseFloat(document.getElementById('price').value) || 0;
  const down = parseFloat(document.getElementById('down').value) || 0;
  const rate = parseFloat(document.getElementById('rate').value) || 0;
  const term = parseInt(document.getElementById('term').value) || 1;

  const principal = price - down;
  const monthlyRate = rate / 100 / 12;
  const payment = principal * monthlyRate / (1 - Math.pow(1 + monthlyRate, -term));

  document.getElementById('monthlyPayment').innerText =
    "Estimated Monthly Payment: $" + (payment ? payment.toFixed(2) : "0.00");
}
</script>

</body>
</html>
