<!-- 
PROJECT NAME: Contact Management System
AUTHERS: Irfan Shaikh(38) and Prateek Sharma(41)
TECHNOLOGIES USED: html5, css3, bootstrap4, jquery, php, mysql
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>

    <!-- IMPORT PROCESS.PHP FILE -->
    <?php require_once "process.php"; ?>

    <!-- SHOW ALERT SESSEION MESSAGES -->
    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-dismissible fade show alert-<?= $_SESSION['msg_type'] ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>



    <!-- HEADER -->
    <div class="cms-header">
            <h1>Contact Management System</h1>
    </div>

    <!-- APPLICATION CONTAINER -->
    <div class="container row">

    <!-- FORM -->
    <div class="row justify-content-center col-lg-4">
            <form action="process.php" method="POST" id="cms-form">
                <div class="cms-form-container">
                    <div class="cms-form-header">
                        <p class="cms-form-header-text">Create New Contact</p>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="input_name"
                        value="<?php echo $name_from_db; ?>" placeholder="John Doe">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="input_email" 
                        value="<?php echo $email_from_db; ?>" placeholder="example@gmail.com" required>
                    </div>
        
                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="text" class="form-control" id="number" name="input_number" 
                        value="<?php echo $number_from_db; ?>" placeholder="123456899" required>
                    </div>
        
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="input_location" 
                        value="<?php echo $location_from_db; ?>" placeholder="Mumbai, Delhi etc." required>
                    </div>
        
                    <div class="form-group">
                        <?php if ($update_record == true): ?>
                            <button class="btn btn-info btn-block" name="update" type="submit">Update</button>
                        <?php else: ?>
                            <button class="btn btn-primary btn-block" name="save" type="submit">Save</button>
                        <?php endif; ?>
                    </div>
                </div>     
            </form>
        </div>



        <!-- SHOW DATABASE DATA IN A TABLE -->
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'cms_data') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM contact_data") or die($mysqli->error);
        ?>

        <!-- TABLE -->
        <div class="row justify-content-center table-responsive-md col-lg-8">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <!-- looping through the fetched data -->
                <?php while($db_record = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $db_record['contact_name_db']; ?></td>
                    <td><?php echo $db_record['contact_email_db']; ?></td>    
                    <td><?php echo $db_record['contact_number_db']; ?></td>
                    <td><?php echo $db_record['contact_location_db']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $db_record['contact_data_id'];?>" 
                        class="btn btn-info">Edit</a>
                        
                        <a href="process.php?delete=<?php echo $db_record['contact_data_id'];?>" 
                        class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>