<?php 
include 'config.php'; 
if(isset($_POST['signup_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['pass']; // Password (Plain for college project, use password_hash for real)

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0) {
        echo "<script>alert('ईमेल आधीच रजिस्टर आहे!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO users (full_name, email, password, role) VALUES ('$name', '$email', '$pass', 'user')");
        echo "<script>alert('अकाउंट तयार झाले! आता लॉगिन करा.'); window.location.href='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>FruitKart | Join Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: linear-gradient(45deg, #2ecc71, #27ae60); height: 100vh; display: flex; justify-content: center; align-items: center; font-family: 'Poppins', sans-serif; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 15px; width: 350px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); text-align: center; }
        .card h2 { color: #27ae60; margin-bottom: 20px; }
        input { width: 90%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; outline: none; }
        .btn { width: 100%; padding: 12px; background: #27ae60; border: none; color: white; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn:hover { background: #219150; }
        a { text-decoration: none; color: #27ae60; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h2><i class="fas fa-leaf"></i> FruitKart</h2>
        <p>Create New Account</p>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="signup_btn" class="btn">Register Now</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>