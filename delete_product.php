<?php
include("config.php");
include("logged_in_check.php");

// Silinecek ürün ID'sini al
$product_id = $_GET['id'];

// Ürünü veritabanından sil
$sql = "DELETE FROM products WHERE product_id='$product_id'";
$result = berkhoca_query_parser($sql);

if ($result) {
    echo "Product deleted successfully.";
} else {
    echo "An error occurred while deleting product.";
}

// Yönlendirme
header("Location: product_list.php"); // Ürün listesine geri döndür
exit;
?>
