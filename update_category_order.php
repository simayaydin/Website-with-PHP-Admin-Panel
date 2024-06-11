<?php
include("config.php");
include("logged_in_check.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orders = $_POST['order'];

    foreach ($orders as $id => $order) {
        $id = (int)$id;
        $order = (int)$order;
        $sql = "UPDATE categories SET category_order = $order WHERE category_id = $id";
        berkhoca_query_parser($sql);
    }

    header("Location: category_list.php");
    exit();
}
?>
