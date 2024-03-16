<?php
    /*
        ===========================================================
        RoomRaccoon Technical Assessment by William Madede
        ===========================================================
        Author: William Madede
        
        You may not copy, alter or distribute this code without
        the express permission from the author.
        ===========================================================
    */

    session_start();
    include('../includes/error_reporting.php');
    include('../Classes/dbFunctions.php');

    if(isset($_POST['type']) AND $_POST['type'] != ''){
        $type = $_POST['type'];
        $functionObj = new dbFunctions();
        if($type == 'SIGN_IN') { //Sign In
            $email = $_POST['username'];
            $password = $_POST['user_password'];

            $login = $functionObj->UserLogin($email, $password);
            echo $login;
            die();
        }elseif($type == "ADD") { //Add New Item
            $user_id = base64_decode($_SESSION['id']);
            $item_code = $_POST['item_code'];
            $item_quantity = $_POST['item_quantity'];
            $item_description = $_POST['item_description'];
            $item_name = $_POST['item_name'];

            $add = $functionObj->addItem($item_code, $item_quantity, $item_description, $item_name, $user_id);
            echo $add;
            die();
        }elseif($type == "UPDATE") { //Update existing item.
            $user_id = base64_decode($_SESSION['id']);
            $record_id = $_POST['uid'];
            $item_name = $_POST['i_name'];
            $item_code = $_POST['i_code'];
            $item_quantity = $_POST['i_qty'];
            $item_description = $_POST['i_descr'];

            $update = $functionObj->updateItem($record_id, $item_code, $item_quantity, $item_description, $item_name, $user_id);
            echo $update;
            die();
        }elseif($type == "DELETE") { //Delete existing item.
            $user_id = base64_decode($_SESSION['id']);
            $record_id = $_POST['uid'];

            $delete = $functionObj->deleteItem($record_id, $user_id);
            echo $delete;
            die();
        };
    };
?>
