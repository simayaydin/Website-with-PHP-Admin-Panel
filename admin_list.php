<?php
include("config.php");
include("logged_in_check.php");

// Veritabanından adminleri almak için SQL sorgusu
$sql = "SELECT * FROM admin_table ORDER BY admin_id DESC";
$result = berkhoca_query_parser($sql);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        
        <div id="content-header">
            <h1>Admin List</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Username</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Her admin için tablo satırı oluştur
                            foreach ($result as $admin) {
                                echo "<tr>";
                                echo "<td>{$admin['admin_id']}</td>";
                                echo "<td>{$admin['admin_name']}</td>";
                                echo "<td>{$admin['admin_surname']}</td>";
                                echo "<td>{$admin['admin_username']}</td>";
                                echo "<td>
                                        <a href='edit_admin.php?id={$admin['admin_id']}' class='btn btn-primary'>Edit</a>
                                        <a href='delete_admin.php?id={$admin['admin_id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this admin?\")'>Delete</a>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
