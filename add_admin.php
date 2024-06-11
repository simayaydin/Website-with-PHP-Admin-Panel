<?php
include("config.php");
include("logged_in_check.php");

// Formdan gelen verileri al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a_name = $_POST['name'];
    $a_surname = $_POST['surname'];
    $a_username = $_POST['username'];
    $a_pass = $_POST['password'];
    
    // Veritabanına yeni admin eklemek için SQL sorgusu oluştur
    $sql = "INSERT INTO admin_table (admin_name, admin_surname, admin_username, admin_pass) 
            VALUES ('$a_name', '$a_surname', '$a_username', '$a_pass')";
    
    // SQL sorgusunu veritabanında çalıştır
    $result = berkhoca_query_parser($sql);
    
    // Eğer sorgu başarılı bir şekilde çalışırsa
    if ($result) {
        echo "New admin added successfully.";
    } else {
        echo "An error occurred while adding admin.";
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
            <h1>Add New Admin</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-group has-success">
                            <label class="control-label" for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group has-warning">
                            <label class="control-label" for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname">
                        </div>

                        <div class="form-group has-error">
                            <label class="control-label" for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>  

                        <div class="form-group has-success">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <!-- Diğer gerekli alanları buraya ekleyebilirsiniz -->

                        <button type="submit" class="btn btn-lg btn-secondary">
                            <i class="fa fa-check"></i> Add
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
