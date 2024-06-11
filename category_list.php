<?php
include("config.php");
include("logged_in_check.php");

// Kategorileri adlarına göre alfabetik ve sıralı olarak sıralamak için SQL sorgusu
$sql = "SELECT * FROM categories ORDER BY category_order ASC, category_name ASC";
$result = berkhoca_query_parser($sql);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        
        <div id="content-header">
            <h1>Category List</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form action="update_category_order.php" method="post">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Başlangıç sayısı
                                $count = 1;

                                // Her kategori için tablo satırı oluştur
                                foreach ($result as $category) {
                                    echo "<tr>";
                                    echo "<td>{$count}</td>";
                                    echo "<td>{$category['category_name']}</td>";
                                    echo "<td><input type='number' name='order[{$category['category_id']}]' value='{$category['category_order']}' class='form-control'></td>";
                                    echo "<td>
                                            <a href='edit_category.php?id={$category['category_id']}' class='btn btn-primary'>Edit</a>
                                            <a href='delete_category.php?id={$category['category_id']}' class='btn btn-danger'>Delete</a>
                                          </td>";
                                    echo "</tr>";

                                    // Sayacı bir arttır
                                    $count++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Update Order</button>
                    </form>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->     
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
