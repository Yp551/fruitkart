<?php 
// सर्वात आधी session_start() असणे गरजेचे आहे
session_start(); 
include 'config.php'; 

if(isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    // Database मधून चेक करणे
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // सेशनमध्ये डेटा सेव्ह करणे
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['full_name'];
        $_SESSION['role'] = $row['role'];

        // लॉगिन सक्सेसफुल मेसेज आणि रिडायरेक्ट
        if($row['role'] == 'admin') {
            echo "<script>alert('Admin Login Successful!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Login Successful! Welcome " . $row['full_name'] . "'); window.location.href='index.php';</script>";
        }
    } else {
        // चुकीचा पासवर्ड किंवा ईमेल असल्यास
        echo "<script>alert('ईमेल किंवा पासवर्ड चुकीचा आहे!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FruitKart | Secure Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body {
            background: linear-gradient(135deg, #2874f0 0%, #00d2ff 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: fadeInUp 0.8s ease;
        }

        .login-card h2 { color: #2874f0; margin-bottom: 10px; font-size: 28px; }
        .login-card p { color: #666; margin-bottom: 30px; font-size: 14px; }

        .input-group { position: relative; margin-bottom: 20px; }
        .input-group i { position: absolute; left: 15px; top: 15px; color: #2874f0; }
        
        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
            background: #f9f9f9;
        }

        .input-group input:focus { border-color: #2874f0; box-shadow: 0 0 8px rgba(40,116,240,0.2); background: #fff; }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #fb641b;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(251,100,27,0.3);
        }

        .login-btn:hover { background: #e65c15; transform: translateY(-2px); }

        .footer-text { margin-top: 20px; font-size: 13px; color: #888; }
        .footer-text a { color: #2874f0; text-decoration: none; font-weight: 600; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="login-card">
    <div style="background: #2874f0; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
        <i class="fas fa-user-lock" style="color: white; font-size: 24px;"></i>
    </div>
    <h2>Welcome Back</h2>
    <p>Login to your FruitKart account</p>

    <form method="POST">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" required>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="pass" placeholder="Password" required>
        </div>
        <button type="submit" name="login_btn" class="login-btn">LOGIN</button>
    </form>

    <div class="footer-text">
        Don't have an account? <a href="signup.php">Create One</a><br><br>
        <a href="index.php"><i class="fas fa-arrow-left"></i> Back to Store</a>
    </div>
</div>

</body>
</html>