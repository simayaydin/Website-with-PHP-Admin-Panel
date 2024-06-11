<?php
include("config.php");
include("logged_in_check.php");

// Silinecek admin'in ID'sini al
$admin_id = $_GET['id'];

// Admin'i veritabanından sil
$sql = "DELETE FROM admin_table WHERE admin_id='$admin_id'";
$result = berkhoca_query_parser($sql);

if ($result) {
    echo "Admin deleted successfully.";
} else {
    echo "An error occurred while deleting admin.";
}

// Yönlendirme
header("Location: admin_list.php"); // Admin listesine geri döndür
exit;
?>
