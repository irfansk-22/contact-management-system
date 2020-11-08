<?php

    session_start();
    $mysqli = new mysqli('localhost', 'root', '', 'cms_data') or die(mysqli_error($mysqli)); 

    //Setting the default values of input filds If edit btn is not clicked yet

    $id = 0;            //variable $id represents the the id of selected or active row 
    $name_from_db ='';
    $email_from_db = '';
    $number_from_db = '';
    $location_from_db = '';
    $update_record = false; 

    // EDIT PROCESS
    if(isset($_GET['edit'])) {

        $id = $_GET['edit'];
        $update_record = true;
        
        $result = $mysqli->query("SELECT * FROM contact_data WHERE contact_data_id = $id") 
        or die($mysqli->error);

        //Make sure that the record exist before processing it
        if ($result->num_rows) {
            
            $db_record = $result->fetch_array();
            $name_from_db = $db_record['contact_name_db'];
            $email_from_db = $db_record['contact_email_db'];
            $number_from_db = $db_record['contact_number_db'];
            $location_from_db = $db_record['contact_location_db'];
        }
    }

    // UPDATE PROCESS
    if (isset($_POST['update'])) {

        $id = $_POST['id'];

        $updated_name = $_POST['input_name'];
        $updated_email = $_POST['input_email'];
        $updated_number = $_POST['input_number'];
        $updated_location = $_POST['input_location'];

        $mysqli->query(
        "UPDATE contact_data SET 
        contact_name_db='$updated_name', 
        contact_email_db ='$updated_email',
        contact_number_db ='$updated_number', 
        contact_location_db = '$updated_location' 
        WHERE contact_data_id = $id
        ")
        or die($mysqli->error);

        $_SESSION['message'] = 'Record has been updated!';
        $_SESSION['msg_type'] = 'warning';

        header('location: index.php');
    }

    // SAVE PROCESS
    if (isset($_POST['save'])) {
        $input_name = $_POST['input_name'];
        $input_email = $_POST['input_email'];
        $input_number = $_POST['input_number'];
        $input_location = $_POST['input_location'];

        $mysqli->query(
            "INSERT INTO contact_data (contact_name_db, contact_email_db, contact_number_db, contact_location_db) 
            VALUES('$input_name', '$input_email', '$input_number', '$input_location')")
            or die($mysqli->error);

        $_SESSION['message'] = 'Record has been saved!';
        $_SESSION['msg_type'] = 'success';

        header('location: index.php');
    }

    // DELETE PROCESS
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $mysqli->query("DELETE FROM contact_data WHERE contact_data_id = $id")
        or die($mysqli->error);

        $_SESSION['message'] = 'Record has been deleted!';
        $_SESSION['msg_type'] = 'danger';

        header('location: index.php');
    }

?>