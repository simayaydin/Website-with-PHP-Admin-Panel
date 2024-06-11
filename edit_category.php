<?php
include("config.php");
include("logged_in_check.php");

// Edit edilecek kategori ID'sini al
$category_id = $_GET['id'];

// Formdan gelen verileri al ve güncelleme sorgusunu çalıştır
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    
    $sql = "UPDATE categories SET 
                category_name='$category_name'
            WHERE category_id='$category_id'";
    
    $result = berkhoca_query_parser($sql);
    
    if ($result) {
        echo "Category updated successfully.";
    } else {
        echo "An error occurred while updating category.";
    }
}

// Mevcut kategori bilgilerini al
$sql = "SELECT * FROM categories WHERE category_id='$category_id'";
$result = berkhoca_query_parser($sql);

// Sorgu sonucunu bir diziye dönüştür
$category = mysqli_fetch_assoc($result);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        <div id="content-header">
            <h1>Edit Category</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=$category_id"; ?>">
                        <div class="form-group has-success">
                            <label class="control-label" for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $category['category_name']; ?>">
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