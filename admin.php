<?php include 'config.php'; 
if($_SESSION['role'] != 'admin') { header("location:login.php"); }

// नवीन फळ ॲड करण्याचे लॉजिक
if(isset($_POST['add_fruit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $img = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "images/".$img);
    
    mysqli_query($conn, "INSERT INTO products (name, price, old_price, image) VALUES ('$name', '$price', '$old_price', '$img')");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="display:flex;">
    <div style="width:250px; background:#2c3e50; height:100vh; color:white; padding:20px; position:fixed;">
        <h2>FruitKart Admin</h2>
        <hr>
        <p><i class="fas fa-plus"></i> Add Fruits</p>
        <p><i class="fas fa-shopping-bag"></i> View Orders</p>
        <a href="logout.php" style="color:red; text-decoration:none;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div style="margin-left:270px; padding:30px; width:100%;">
        <h1>Manager Dashboard</h1>
        <div style="display:flex; gap:20px; margin-bottom:30px;">
            <div style="background:white; padding:20px; flex:1; border-left:5px solid green; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
                <h4>Total Fruits</h4>
                <h2><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products")); ?></h2>
            </div>
            <div style="background:white; padding:20px; flex:1; border-left:5px solid blue; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
                <h4>Total Users</h4>
                <h2><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users")); ?></h2>
            </div>
        </div>

        <h3>Add New Fruit Variety</h3>
        <form method="POST" enctype="multipart/form-data" style="background:white; padding:20px; border-radius:8px;">
            <input type="text" name="name" placeholder="Fruit Name" required style="width:100%; margin-bottom:10px; padding:10px;">
            <input type="number" name="price" placeholder="Selling Price" required style="width:48%; padding:10px;">
            <input type="number" name="old_price" placeholder="MRP (Old Price)" required style="width:48%; padding:10px;">
            <input type="file" name="img" required style="margin-top:15px;">
            <button name="add_fruit" class="btn-buy" style="margin-top:20px; width:200px;">UPLOAD PRODUCT</button>
        </form>
    </div>
</body>
</html>