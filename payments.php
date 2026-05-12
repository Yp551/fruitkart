<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FruitKart - Secure Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #0b1120; font-family: 'Poppins', sans-serif; color: white; }
        .payment-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .method-option {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
        .method-option:hover { border-color: #38bdf8; background: rgba(56, 189, 248, 0.05); }
        .form-check-input:checked + label { color: #38bdf8; }
        .btn-pay {
            background: linear-gradient(90deg, #0ea5e9, #2563eb);
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: 0.4s;
        }
        .btn-pay:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4); }
        .back-link { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        .back-link:hover { color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="mb-4">
        <a href="index.php" class="back-link"><i class="bi bi-arrow-left me-2"></i>Back to Shopping</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="payment-card">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Secure <span class="text-info">Checkout</span></h3>
                    <p class="text-secondary small">तुमचा पसंतीचा पेमेंट पर्याय निवडा</p>
                </div>

                <form>
                    <div class="method-option">
                        <div class="form-check d-flex align-items-center justify-content-between">
                            <div>
                                <input class="form-check-input" type="radio" name="payMethod" id="upi" checked>
                                <label class="form-check-label ms-2 fw-bold" for="upi">UPI / Google Pay</label>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg" width="50" alt="UPI">
                        </div>
                        <input type="text" class="form-control bg-dark border-secondary text-white mt-3" placeholder="Enter UPI ID (e.g. name@upi)">
                    </div>

                    <div class="method-option">
                        <div class="form-check d-flex align-items-center justify-content-between">
                            <div>
                                <input class="form-check-input" type="radio" name="payMethod" id="card">
                                <label class="form-check-label ms-2 fw-bold" for="card">Credit / Debit Card</label>
                            </div>
                            <i class="bi bi-credit-card fs-4 text-info"></i>
                        </div>
                    </div>

                    <div class="method-option">
                        <div class="form-check d-flex align-items-center justify-content-between">
                            <div>
                                <input class="form-check-input" type="radio" name="payMethod" id="cod">
                                <label class="form-check-label ms-2 fw-bold" for="cod">Cash on Delivery</label>
                            </div>
                            <span class="badge bg-success opacity-75">FREE</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-pay btn-primary w-100 mt-4 text-uppercase">
                        Complete Order <i class="bi bi-lock-fill ms-2"></i>
                    </button>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted" style="font-size: 0.8rem;">
                        <i class="bi bi-shield-lock-fill me-1"></i> SSL Encrypted & Secure Payment
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>