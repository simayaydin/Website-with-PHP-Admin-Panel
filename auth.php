<?php

include("config.php");

// POST verilerini al
$username = $_POST['form_username'];
$password = $_POST['form_password'];

// SQL sorgusunu oluştur
$sql = "SELECT * FROM admin_table WHERE admin_username = '$username' AND admin_pass = '$password' ";

// SQL sorgusunu çalıştır ve sonuç kümesini al
$result = berkhoca_query_parser($sql);

// Sonuç kümesinin satır sayısını kontrol et
if($result && $result->num_rows > 0) {
    // Sonuçlar bulunduğunda, ilk satırı al
    $row = $result->fetch_assoc();
    
    // Oturumu başlat
    session_start();

    // Oturum değişkenlerini ayarla
    $_SESSION['admin_id'] = $row['admin_id'];
    $_SESSION['admin_username'] = $row['admin_username'];

    // Yönlendirme yap
    header("Location: dashboard.php");
    exit; // Yönlendirme yaptıktan sonra işlemi sonlandır
} else {
    // Sonuçlar bulunamadığında veya hata oluştuğunda, oturumu yok et ve çıkış yap
    session_destroy();
    header("Location: logout.php?warning=1");
    exit; // Yönlendirme yaptıktan sonra işlemi sonlandır
}

?>
