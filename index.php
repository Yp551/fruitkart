<?php 
session_start(); 
include 'config.php'; 

// Initialize cart if not set
if(!isset($_SESSION['cart'])){ $_SESSION['cart'] = array(); }

// Handling Add to Cart
if(isset($_POST['add_to_cart'])){
    $p_id = $_POST['p_id'];
    if(!in_array($p_id, $_SESSION['cart'])){
        $_SESSION['cart'][] = $p_id;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FruitStore | Premium Experience</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #020617; 
            --card-bg: #0f172a;
            --primary: #38bdf8;
            --accent: #fbbf24;
            --text-main: #f8fafc;
            --glass: rgba(15, 23, 42, 0.8);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(251, 191, 36, 0.08) 0px, transparent 50%);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Navbar Custom */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 8%;
            background: var(--glass);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            position: sticky; top: 0; z-index: 1000;
        }

        .logo { font-size: 24px; font-weight: 800; letter-spacing: -1px; }
        .logo span { color: var(--primary); }

        .nav-links { display: flex; align-items: center; gap: 30px; }
        .nav-links a { color: #94a3b8; text-decoration: none; font-weight: 600; transition: 0.3s; font-size: 15px; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }

        .cart-btn { background: rgba(56, 189, 248, 0.1); padding: 8px 16px; border-radius: 50px; border: 1px solid rgba(56, 189, 248, 0.2); display: flex; align-items: center; gap: 8px; }
        .cart-count { background: var(--primary); color: #020617; padding: 2px 8px; border-radius: 20px; font-size: 11px; font-weight: 800; }

        .auth-btn { background: var(--primary); color: #000 !important; padding: 10px 24px !important; border-radius: 12px; font-weight: 700 !important; box-shadow: 0 10px 20px rgba(56, 189, 248, 0.2); }

        /* Hero Section */
        .hero {
            min-height: 85vh; display: flex; align-items: center; padding: 0 8%;
            margin: 20px 4%; border-radius: 40px; border: 1px solid rgba(255, 255, 255, 0.05);
            background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
            position: relative; overflow: hidden;
        }

        .hero-content h1 { font-size: 4.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 25px; }
        .hero-content h1 span { color: var(--primary); }
        .hero-content p { font-size: 1.1rem; color: #94a3b8; max-width: 550px; margin-bottom: 40px; }

        .hero-image img { width: 100%; max-width: 550px; animation: float 5s ease-in-out infinite; filter: drop-shadow(0 40px 80px rgba(0,0,0,0.7)); }

        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-30px); } }

        /* Stats Section (New) */
        .stats-container { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; padding: 60px 8%; }
        .stat-card { background: var(--card-bg); padding: 30px; border-radius: 24px; text-align: center; border: 1px solid rgba(255,255,255,0.03); }
        .stat-card i { font-size: 2rem; color: var(--primary); margin-bottom: 15px; }
        .stat-card h3 { font-size: 1.5rem; margin-bottom: 5px; }
        .stat-card p { color: #64748b; font-size: 0.9rem; }

        /* Product Cards */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 40px 0; }
        .card { background: var(--card-bg); border-radius: 30px; padding: 25px; border: 1px solid rgba(255,255,255,0.03); transition: 0.4s; position: relative; overflow: hidden; }
        .card:hover { transform: translateY(-15px); border-color: var(--primary); box-shadow: 0 30px 60px rgba(0,0,0,0.5); }
        
        .price-tag { display: flex; align-items: baseline; gap: 10px; margin-top: 15px; justify-content: center; }
        .add-btn { width: 100%; padding: 16px; border-radius: 16px; border: none; background: #1e293b; color: white; font-weight: 700; cursor: pointer; transition: 0.3s; margin-top: 20px; }
        .card:hover .add-btn { background: var(--primary); color: #000; }

        /* Footer Custom */
        footer { background: #01040a; padding: 80px 8% 40px; border-top: 1px solid rgba(255,255,255,0.05); }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 50px; margin-bottom: 60px; }
        .footer-col h4 { color: #fff; margin-bottom: 25px; font-size: 1.2rem; }
        .footer-col p { color: #64748b; line-height: 1.8; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #64748b; text-decoration: none; transition: 0.3s; }
        .footer-links a:hover { color: var(--primary); padding-left: 5px; }

        @media (max-width: 992px) {
            .hero { flex-direction: column; text-align: center; padding: 60px 5%; }
            .hero-content h1 { font-size: 3rem; }
            .hero-image img { max-width: 350px; margin-top: 40px; }
            .stats-container { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="logo">
        <i class="fas fa-leaf" style="color:var(--primary)"></i> Fruit<span>kart</span>
    </div>
    
    <div class="nav-links">
        <a href="index.php" class="active">Home</a>
        <a href="#fruits">Fruits</a>
        <a href="about.php">About Us</a>
        <a href="payments.php">Payments</a>
        
        <a href="cart.php" class="cart-btn">
            <i class="fas fa-shopping-basket"></i>
            Cart <span class="cart-count"><?php echo count($_SESSION['cart']); ?></span>
        </a>

        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="auth-btn" style="background:#ef4444; color:#fff !important;">Logout</a>
        <?php else: ?>
            <a href="login.php" class="auth-btn">Login</a>
        <?php endif; ?>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <div style="background: rgba(56, 189, 248, 0.1); color: var(--primary); display: inline-block; padding: 8px 20px; border-radius: 100px; font-size: 13px; font-weight: 800; text-transform: uppercase; margin-bottom: 25px; border: 1px solid rgba(56, 189, 248, 0.2);">
            ✨ Organic & Farm Fresh
        </div>
        <h1>Freshness <br>Delivered <span>Directly.</span></h1>
        <p>Premium quality fruits sourced from local farmers, delivered to your doorstep within 24 hours of harvest.</p>
        <div style="margin-top: 40px;">
            <a href="#fruits" style="background:var(--primary); color:#000; padding: 18px 45px; border-radius: 18px; text-decoration:none; font-weight:800; display:inline-block; transition:0.3s; box-shadow: 0 20px 40px rgba(56, 189, 248, 0.25);">Start Shopping</a>
            <a href="about.php" style="margin-left:25px; color:#fff; text-decoration:none; font-weight:600; border-bottom: 2px solid var(--primary);">Our Story →</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="images/fruit_basket.png" alt="Fresh Fruit" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3194/3194591.png'">
    </div>
</section>

<section class="stats-container">
    <div class="stat-card">
        <i class="fas fa-truck-fast"></i>
        <h3>Express Delivery</h3>
        <p>Within 24 Hours</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-seedling"></i>
        <h3>100% Organic</h3>
        <p>No Chemicals Added</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-wallet"></i>
        <h3>Best Prices</h3>
        <p>Direct from Farmers</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-headset"></i>
        <h3>Premium Support</h3>
        <p>Dedicated Assistance</p>
    </div>
</section>

<div class="container" id="fruits" style="padding: 100px 8%;">
    <div style="text-align: center; margin-bottom: 60px;">
        <h2 style="font-size: 3rem; font-weight: 800;">Today's Fresh Picks</h2>
        <div style="width: 80px; height: 4px; background: var(--primary); margin: 20px auto; border-radius: 10px;"></div>
    </div>

    <div class="product-grid">
        <?php
        $res = mysqli_query($conn, "SELECT * FROM products");
        if($res && mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)) {
        ?>
        <div class="card">
            <div style="background: #020617; border-radius: 20px; padding: 20px;">
                <img src="images/<?php echo $row['image']; ?>" style="width:100%; height:220px; object-fit:contain;" onerror="this.src='https://via.placeholder.com/300x220/0f172a/38bdf8?text=Premium+Fruit'">
            </div>
            <h4 style="margin: 25px 0 10px; font-size: 1.6rem; text-align: center;"><?php echo $row['name']; ?></h4>
            <div class="price-tag">
                <span style="color: var(--primary); font-size: 1.8rem; font-weight: 800;">₹<?php echo $row['price']; ?></span>
                <span style="color: #475569; text-decoration: line-through;">₹<?php echo $row['old_price']; ?></span>
            </div>
            <form method="POST">
                <input type="hidden" name="p_id" value="<?php echo $row['id']; ?>">
                <button name="add_to_cart" class="add-btn">
                    <i class="fas fa-plus-circle" style="margin-right:10px;"></i> ADD TO CART
                </button>
            </form>
        </div>
        <?php } } else { echo "<p style='text-align:center; width:100%;'>No products available yet.</p>"; } ?>
    </div>
</div>

<footer>
    <div class="footer-grid">
        <div class="footer-col">
            <div class="logo" style="margin-bottom:20px;">
                <i class="fas fa-leaf" style="color:var(--primary)"></i> Fruit<span>kart</span>
            </div>
            <p>Bringing the freshest organic fruits from local Indian farms directly to your dining table. Quality you can taste, health you can trust.</p>
        </div>
        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul class="footer-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#fruits">Fruits</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="payments.php">Payments</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Support</h4>
            <ul class="footer-links">
                <li><a href="#">Track Order</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Contact Support</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Newsletter</h4>
            <p>Join for exclusive organic deals.</p>
            <div style="margin-top:20px; display:flex;">
                <input type="text" placeholder="Your Email" style="padding:12px; background:#0f172a; border:1px solid #1e293b; border-radius:10px 0 0 10px; color:white; width:100%;">
                <button style="background:var(--primary); border:none; padding:12px 20px; border-radius:0 10px 10px 0; font-weight:800; cursor:pointer;">Join</button>
            </div>
        </div>
    </div>
    <div style="text-align: center; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 30px;">
        <p style="color: #475569;">© 2026 FruitStore. Developed for Premium Experience.</p>
    </div>
</footer>

</body>
</html>