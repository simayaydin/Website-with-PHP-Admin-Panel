<?php
include("config.php");
include("logged_in_check.php");

// Kategorileri almak için SQL sorgusu
$category_sql = "SELECT * FROM categories ORDER BY category_name ASC";
$category_result = berkhoca_query_parser($category_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_FILES['form_file']['name'])) {
        die('PLEASE CHOOSE A FILE...');
    }

    $uploaddir = 'C:/xampp/htdocs/admin_panel/images/';
    $uploadfile = $uploaddir . basename($_FILES['form_file']['name']);

    if (move_uploaded_file($_FILES['form_file']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.<br>";
        // Web'de kullanılabilir dosya yolu
        $product_picture = 'images/' . basename($_FILES['form_file']['name']);
        
        // Hata ayıklama için eklenmiş kodlar
        // echo "Upload path: " . $uploadfile . "<br>";
        // echo "Product picture path: " . $product_picture . "<br>";

        // Veritabanına kaydetme işlemi
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];

        $sql = "INSERT INTO products (product_name, price, stock_quantity, description, product_picture, category_id) VALUES ('$product_name', '$price', '$stock_quantity', '$description', '$product_picture', '$category_id')";
        
        if (berkhoca_query_parser($sql)) {
            echo "";
        } else {
            echo "Error adding product: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Possible file upload attack!<br>";
    }
}
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        
        <div id="content-header">
            <h1>Add Product</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <h3 class="heading">Add New Product</h3>

                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="stock_quantity">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="form_file">Product Picture</label>
                            <input type="file" id="form_file" name="form_file" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <?php while($category = mysqli_fetch_assoc($category_result)): ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>

                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
