<?php
// डेटाबेसचे नाव: fruitkart
$conn = mysqli_connect('localhost', 'root', '', 'fruitkart');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// सेशन सुरू करणे (लॉगिन आणि कार्टसाठी गरजेचे)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// कार्ट रिकामी नसेल तर एरर टाळण्यासाठी डिफॉल्ट ॲरे
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>