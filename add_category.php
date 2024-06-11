<?php
include("config.php");

// Formdan gelen verileri al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    $category_order = $_POST['category_order'];
    
    // Veritabanına yeni kategori eklemek için SQL sorgusu oluştur
    $sql = "INSERT INTO categories (category_name, category_order) VALUES ('$category_name', '$category_order')";
    
    // SQL sorgusunu veritabanında çalıştır
    $result = berkhoca_query_parser($sql);
    
    // Eğer sorgu başarılı bir şekilde çalışırsa
    if ($result) {
        // Kategori başarıyla eklendi, yönlendirme yapabilirsiniz
        header("Location: category_list.php");
        exit();
    } else {
        echo "Error adding category.";
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
            <h1>Add New Category</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-group has-success">
                            <label class="control-label" for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>

                        <div class="form-group has-warning">
                            <label class="control-label" for="category_order">Category Order</label>
                            <input type="number" class="form-control" id="category_order" name="category_order" required>
                        </div>

                        <button type="submit" class="btn btn-lg btn-secondary">
                            <i class="fa fa-check"></i> Add Category
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
