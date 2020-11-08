<!-- 
PROJECT NAME: Contact Management System
AUTHERS: Irfan Shaikh and Prateek Sharma
TECHNOLOGIES USED: html5, css3, bootstrap4, jquery, php, MySQL
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css"
    integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" 
    crossorigin="anonymous" />
</head>
<body>

    <!-- IMPORT PROCESS.PHP FILE -->
    <?php require_once "process.php";?>

    <!-- SHOW ALERT SESSEION MESSAGES -->
    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>


    <!-- APPLICATION CONTAINER -->
    <div class="container">

        <?php
            //querying all the data from db to show in the html table
            $mysqli = new mysqli('localhost', 'root', '', 'cms_data') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM contact_data") or die($mysqli->error);
        ?>

        <!-- TABLE -->
        <div class="row justify-content-center">
            <table class="table">
                <thead>
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


        <!-- FORM -->
        <div class="row justify-content-center">
            <form action="process.php" method="POST">

                <input type="hidden" name="record_id_to_update" value="<?php echo $record_id; ?>">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="input_name"
                    value="<?php echo $name_from_db; ?>" placeholder="John Doe" required>
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
                    <?php if ($update_data == true): ?>
                        <button class="btn btn-info btn-block" name="update" type="submit">Update</button>
                    <?php else: ?>
                        <button class="btn btn-primary btn-block" name="save" type="submit">Save</button>
                    <?php endif; ?>
                </div> 
            </form>
        </div>
    </div>
</body>
</html>