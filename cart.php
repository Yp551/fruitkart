<?php
session_start();
include 'config.php'; 

// १. युजर लॉगिन आहे की नाही ते तपासणे
if(!isset($_SESSION['user_id'])){
   header('location:login.php'); 
   exit();
}

$user_id = $_SESSION['user_id'];

// २. उत्पादन कार्टमधून काढणे (DELETE Logic)
if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   // Query सुरक्षित करण्यासाठी mysqli_real_escape_string वापरले आहे
   $remove_id = mysqli_real_escape_string($conn, $remove_id);
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id' AND user_id = '$user_id'") or die('Remove Query failed: ' . mysqli_error($conn));
   header('location:cart.php');
   exit();
}

// ३. ऑर्डर प्लेस करणे (PLACE ORDER Logic)
if(isset($_POST['order_btn'])){
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
   
   if(mysqli_num_rows($cart_query) > 0){
      // कार्ट रिकामी करणे
      mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Order Query failed: ' . mysqli_error($conn));
      echo "<script>alert('ऑर्डर यशस्वी झाली! FruitKart वापरल्याबद्दल धन्यवाद.'); window.location.href='index.php';</script>";
   }else{
      echo "<script>alert('तुमची कार्ट आधीच रिकामी आहे!');</script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FruitKart - My Cart</title>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
   <style>
      :root {
         --primary-bg: #0b0e14;
         --card-bg: rgba(255, 255, 255, 0.05);
         --accent-blue: #3498db;
         --text-main: #ffffff;
         --glass-border: rgba(255, 255, 255, 0.1);
      }

      body {
         margin: 0;
         font-family: 'Poppins', sans-serif;
         background: radial-gradient(circle at top right, #1a1f2c, #0b0e14);
         color: var(--text-main);
         min-height: 100vh;
      }

      nav {
         display: flex; justify-content: space-between; align-items: center;
         padding: 20px 8%; background: rgba(11, 14, 20, 0.9);
         backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border);
         position: sticky; top: 0; z-index: 1000;
      }

      .logo { font-size: 24px; font-weight: 700; color: var(--accent-blue); text-decoration: none; }
      .back-btn { color: #fff; text-decoration: none; font-size: 14px; }

      .container { max-width: 1000px; margin: 50px auto; padding: 0 20px; }
      
      .cart-box {
         background: var(--card-bg); backdrop-filter: blur(15px);
         border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden;
      }

      table { width: 100%; border-collapse: collapse; }
      th { text-align: left; padding: 20px; background: rgba(255, 255, 255, 0.03); color: #a0a0a0; font-size: 13px; }
      td { padding: 20px; border-bottom: 1px solid var(--glass-border); }

      .product-img { width: 60px; height: 60px; border-radius: 10px; object-fit: cover; vertical-align: middle; margin-right: 15px; background: #222; }
      
      .remove-link { color: #ff4d4d; text-decoration: none; font-weight: 600; }
      .remove-link:hover { text-decoration: underline; }

      .cart-footer {
         display: flex; justify-content: flex-end; padding: 30px;
         background: rgba(255, 255, 255, 0.02); align-items: center; gap: 40px;
      }

      .total-price { font-size: 24px; font-weight: 700; color: #2ecc71; }

      .btn-order {
         background: linear-gradient(135deg, #ff6b35, #ff8c00);
         color: white; border: none; padding: 15px 40px; border-radius: 10px;
         font-weight: 700; cursor: pointer; transition: 0.3s;
      }
      .btn-order:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3); }
   </style>
</head>
<body>

<nav>
   <a href="index.php" class="logo">FruitKart</a>
   <a href="index.php" class="back-btn"><i class="fas fa-chevron-left"></i> Back to Shop</a>
</nav>

<div class="container">
   <h2 style="margin-bottom: 20px;">My Shopping Cart</h2>

   <div class="cart-box">
      <table>
         <thead>
            <tr>
               <th>Product</th>
               <th>Price</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $grand_total = 0;
               // डेटाबेसमधून कार्ट मधील डेटा आणणे
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Fetch Query failed: ' . mysqli_error($conn));
               
               if(mysqli_num_rows($select_cart) > 0){
                  while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
            <tr>
               <td>
                  <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" class="product-img" alt="fruit">
                  <span><?php echo $fetch_cart['name']; ?></span>
               </td>
               <td>₹<?php echo $fetch_cart['price']; ?></td>
               <td>
                  <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="remove-link" onclick="return confirm('Remove this item?');">
                     <i class="fas fa-trash"></i> Remove
                  </a>
               </td>
            </tr>
            <?php
                  $grand_total += $fetch_cart['price'];
                  }
               }else{
                  echo '<tr><td colspan="3" style="text-align:center; padding:80px; color:#666;">
                        <i class="fas fa-shopping-basket" style="font-size: 40px; display:block; margin-bottom:10px;"></i>
                        तुमची कार्ट रिकामी आहे!
                        <br><a href="index.php" style="color:#3498db; text-decoration:none;">खरेदी सुरू करा</a>
                        </td></tr>';
               }
            ?>
         </tbody>
      </table>

      <?php if($grand_total > 0){ ?>
      <div class="cart-footer">
         <div>
            <span style="color: #a0a0a0;">Total Amount:</span>
            <div class="total-price">₹<?php echo number_format($grand_total, 2); ?></div>
         </div>
         <form method="post">
            <button type="submit" name="order_btn" class="btn-order">PLACE ORDER</button>
         </form>
      </div>
      <?php } ?>
   </div>
</div>

</body>
</html>