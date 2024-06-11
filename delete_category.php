<?php
include("config.php");
include("logged_in_check.php");

// Silinecek kategori ID'sini al
$category_id = $_GET['id'];

// Kategoriyi veritabanından sil
$sql = "DELETE FROM categories WHERE category_id='$category_id'";
$result = berkhoca_query_parser($sql);

if ($result) {
    echo "Category deleted successfully.";
} else {
    echo "An error occurred while deleting category.";
}

// Yönlendirme
header("Location: category_list.php"); // Kategori listesine geri döndür
exit;
?>
