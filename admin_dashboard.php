<?php
include 'config.php';
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: login.php"); }

// Add Product Logic
if(isset($_POST['add_fruit'])) {
    $name = $_POST['p_name'];
    $price = $_POST['p_price'];
    $img = $_POST['p_image']; // Simply text for now, or use file upload
    mysqli_query($conn, "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$img')");
}

// Delete Product Logic
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel | FruitKart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container { padding: 50px 10%; }
        table { width: 100%; background: white; border-collapse: collapse; margin-top: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        th, td { padding: 15px; border: 1px solid #160b0b; text-align: left; }
        th { background: #2874f0; color: white; }
        .add-form { background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
    </style>
</head>
<body style="background:#f1f3f6;">
    <div class="navbar">
        <div class="logo">FruitKart Admin</div>
        <a href="logout.php" style="color:white;">Logout</a>
    </div>

    <div class="admin-container">
        <h2>Manage Fruit Inventory</h2>
        
        <div class="add-form">
            <h3>Add New Fruit</h3>
            <form method="POST">
                <input type="text" name="p_name" placeholder="Fruit Name" required>
                <input type="number" name="p_price" placeholder="Price" required>
                <input type="text" name="p_image" placeholder="Image Name (e.g. apple.jpg)" required>
                <button type="submit" name="add_fruit" class="btn-add" style="width:200px;">Add Fruit</button>
            </form>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            $products = mysqli_query($conn, "SELECT * FROM products");
            while($row = mysqli_fetch_assoc($products)) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td><img src='images/{$row['image']}' width='50'></td>
                    <td>{$row['name']}</td>
                    <td>₹{$row['price']}</td>
                    <td><a href='?delete={$row['id']}' style='color:red;'>Delete</a></td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>