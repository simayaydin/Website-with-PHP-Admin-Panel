<?php
include("config.php");
include("logged_in_check.php");

// Edit edilecek ürün ID'sini al
$product_id = $_GET['id'];

// Formdan gelen verileri al ve güncelleme sorgusunu çalıştır
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    // Eğer yeni bir resim yüklendiyse
    if (!empty($_FILES['form_file']['name'])) {
        $uploaddir = 'C:/xampp/htdocs/admin_panel/images/';
        $uploadfile = $uploaddir . basename($_FILES['form_file']['name']);

        if (move_uploaded_file($_FILES['form_file']['tmp_name'], $uploadfile)) {
            $product_picture = 'images/' . basename($_FILES['form_file']['name']);
            $sql = "UPDATE products SET 
                        product_name='$product_name',
                        price='$price',
                        stock_quantity='$stock_quantity',
                        description='$description',
                        product_picture='$product_picture',
                        category_id='$category_id'
                    WHERE product_id='$product_id'";
        } else {
            echo "Possible file upload attack!\n";
        }
    } else {
        $sql = "UPDATE products SET 
                    product_name='$product_name',
                    price='$price',
                    stock_quantity='$stock_quantity',
                    description='$description',
                    category_id='$category_id'
                WHERE product_id='$product_id'";
    }

    $result = berkhoca_query_parser($sql);

    if ($result) {
        echo "Product updated successfully.";
    } else {
        echo "An error occurred while updating product.";
    }
}

// Mevcut ürün bilgilerini al
$sql = "SELECT * FROM products WHERE product_id='$product_id'";
$result = berkhoca_query_parser($sql);

// Sorgu sonucunu bir diziye dönüştür
$product = mysqli_fetch_assoc($result);

// Mevcut kategorileri al
$category_sql = "SELECT * FROM categories ORDER BY category_name ASC";
$category_result = berkhoca_query_parser($category_sql);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        <div id="content-header">
            <h1>Edit Product</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=$product_id"; ?>" enctype="multipart/form-data">
                        <div class="form-group has-success">
                            <label class="control-label" for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>">
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>">
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="stock_quantity">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>">
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="form_file">Product Picture</label>
                            <input type="file" id="form_file" name="form_file">
                            <br>
                            <img src="http://localhost/admin_panel/<?php echo $product['product_picture']; ?>" width="125" alt="<?php echo $product['product_name']; ?>">
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <?php while($category = mysqli_fetch_assoc($category_result)): ?>
                                    <option value="<?php echo $category['category_id']; ?>" <?php if($category['category_id'] == $product['category_id']) echo 'selected'; ?>><?php echo $category['category_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-lg btn-secondary">
                            <i class="fa fa-check"></i> Update
                        </button>
                    </form>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
