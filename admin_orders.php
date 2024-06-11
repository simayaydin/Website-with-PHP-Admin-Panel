<?php
include("config.php");
include("logged_in_check.php");

// Oturum başlatma (Eğer oturum başlatılmadıysa başlat)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Siparişleri veri tabanından çekme
$order_sql = "SELECT * FROM orders ORDER BY order_date DESC";
$order_result = berkhoca_query_parser($order_sql);

// mysqli_result'ı bir diziye dönüştürme
$orders = mysqli_fetch_all($order_result, MYSQLI_ASSOC);
?>

<?php include('header.php'); ?>

<head>
    <style>
        .order-container {
            width: 80%;
            margin: 20px auto;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .order-table th {
            background-color: #f2f2f2;
        }

        .order-table img {
            width: 50px;
            height: auto;
        }
    </style>
</head>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">

        <div id="content-header">
            <h1>Orders</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="order-container">
                <?php if (count($orders) > 0) : ?>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?php echo ($order['order_id']); ?></td>
                                    <td><?php echo ($order['user_id']); ?></td>
                                    <td><?php echo ($order['product_id']); ?></td>
                                    <td><?php echo ($order['product_name']); ?></td>
                                    <td><?php echo ($order['stock_quantity']); ?></td>
                                    <td><?php echo ($order['product_price']); ?> USD</td>
                                    <td><img src="http://localhost/admin_panel/<?php echo ($order['product_picture']); ?>" alt="<?php echo ($order['product_name']); ?>" onerror="this.src='http://localhost/admin_panel/images/placeholder_image.jpg';"></td>
                                    <td><?php echo ($order['order_date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No orders found.</p>
                <?php endif; ?>
            </div>
        </div> <!-- /#content-container -->
    </div> <!-- #content -->

</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
