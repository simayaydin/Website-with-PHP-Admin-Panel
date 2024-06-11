<?php
include("config.php");
include("logged_in_check.php");

// Ürünleri almak için SQL sorgusu
$sql = "SELECT products.*, categories.category_name FROM products LEFT JOIN categories ON products.category_id = categories.category_id ORDER BY product_name ASC";
$result = berkhoca_query_parser($sql);

$products = [];
if ($result) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    die("Query failed: " . $conn->error);
}
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">
    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        <div id="content-header">
            <h1>Product List</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Picture</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock Quantity</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($products)) {
                                    foreach ($products as $product) {
                                        $product_picture = $product['product_picture'];
                                        $product_picture_url = "http://localhost/admin_panel/" . $product_picture;

                                        echo "<tr>";
                                        echo "<td>
                                                <a href='$product_picture_url' target='_blank'>
                                                    <img src='$product_picture_url' width='125' alt='{$product['product_name']}' onerror=\"this.src='placeholder_image.jpg';\" />
                                                </a>
                                              </td>";
                                        echo "<td>{$product['product_name']}</td>";
                                        echo "<td>{$product['category_name']}</td>";
                                        echo "<td>{$product['price']}</td>";
                                        echo "<td>{$product['stock_quantity']}</td>";
                                        echo "<td>{$product['description']}</td>";
                                        echo "<td class='text-center'>
                                                <a href='edit_product.php?id={$product['product_id']}' class='btn btn-xs btn-primary'><i class='fa fa-pencil'></i></a>
                                                &nbsp;
                                                <a href='delete_product.php?id={$product['product_id']}' class='btn btn-xs btn-secondary' onclick='return confirm(\"Are you sure you want to delete this product?\")'><i class='fa fa-times'></i></a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No products found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->

                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
