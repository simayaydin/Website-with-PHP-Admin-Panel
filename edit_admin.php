<?php
include("config.php");
include("logged_in_check.php");

// Edit edilecek admin'in ID'sini al
$admin_id = $_GET['id'];

// Formdan gelen verileri al ve güncelleme sorgusunu çalıştır
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = $_POST['admin_name'];
    $admin_surname = $_POST['admin_surname'];
    $admin_username = $_POST['admin_username'];
    $admin_pass = $_POST['admin_pass'];
    $admin_status = $_POST['admin_status'];
    
    $sql = "UPDATE admin_table SET 
                admin_name='$admin_name', 
                admin_surname='$admin_surname', 
                admin_username='$admin_username', 
                admin_pass='$admin_pass', 
                admin_status='$admin_status'
            WHERE admin_id='$admin_id'";
    
    $result = berkhoca_query_parser($sql);
    
    if ($result) {
        echo "Admin updated successfully.";
    } else {
        echo "An error occurred while updating admin.";
    }
}

// Mevcut admin bilgilerini al
$sql = "SELECT * FROM admin_table WHERE admin_id='$admin_id'";
$result = berkhoca_query_parser($sql);

// Sorgu sonucunu bir diziye dönüştür
$admin = mysqli_fetch_assoc($result);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        <div id="content-header">
            <h1>Edit Admin</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=$admin_id"; ?>">
                        <div class="form-group has-success">
                            <label class="control-label" for="admin_name">Name</label>
                            <input type="text" class="form-control" id="admin_name" name="admin_name" value="<?php echo $admin['admin_name']; ?>">
                        </div>

                        <div class="form-group has-warning">
                            <label class="control-label" for="admin_surname">Surname</label>
                            <input type="text" class="form-control" id="admin_surname" name="admin_surname" value="<?php echo $admin['admin_surname']; ?>">
                        </div>

                        <div class="form-group has-error">
                            <label class="control-label" for="admin_username">Username</label>
                            <input type="text" class="form-control" id="admin_username" name="admin_username" value="<?php echo $admin['admin_username']; ?>">
                        </div>  

                        <div class="form-group has-success">
                            <label class="control-label" for="admin_pass">Password</label>
                            <input type="password" class="form-control" id="admin_pass" name="admin_pass" value="<?php echo $admin['admin_pass']; ?>">
                        </div>

                        <div class="form-group has-warning">
                            <label class="control-label" for="admin_status">Status</label>
                            <input type="text" class="form-control" id="admin_status" name="admin_status" value="<?php echo $admin['admin_status']; ?>">
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
