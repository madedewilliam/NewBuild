<?php
require_once 'dbClass.php';
require_once 'operations.php';
session_start();
class dbFunctions {
    public function LoginUpdate($uid){
        $dbObj = new databaseConnect();
        $connection = $dbObj->openDBConn();
        //Update User Login History
        $strupdt = "update willatoc_system.login_history set number_of_logins = number_of_logins + 1, last_logged_in = NOW() 
                    where user_id = '$uid' limit 1";
        $connection->query($strupdt);
        return 1;
    }

    public function UserLogin($email, $pass){
        $opeObj = new Operations();
        $email = $opeObj->clean_string($email);
        $pass = $opeObj->clean_string($pass);

        $dbObj = new databaseConnect();
        $connection = $dbObj->openDBConn();
        if($connection != "-1"){
        }else{
            return "Could not connect to host.";
        };

        //Login Query
        $usrlogin = "select * from system_users where username = '{$email}' and user_status = 'active' limit 1";
        $check_login = $connection->query($usrlogin);
        if($check_login){
        }else{
            return "Error checking user.";
        };

        if ($check_login->num_rows < 1 ) {
            return "User does not exist";
        };

        while ($login_row = $check_login->fetch_assoc()){
            $id = $login_row['id'];
            $db_hashed_password = $login_row['user_password'];
            $active = $login_row['user_status'];
            $username = $login_row['username'];
            $names = $login_row['names'];
        };

        if (password_verify($pass, $db_hashed_password)) {
            session_regenerate_id(true);
            $_SESSION['username'] = base64_encode($username);
            $_SESSION['password'] = $db_hashed_password;
            $_SESSION['id'] = base64_encode($id);
            $_SESSION['active'] = $active;
            $_SESSION['names'] = base64_encode($names);
            $_SESSION['system_user'] = "system_user";
            $_SESSION['last_activity'] = time();

            $update = $this->LoginUpdate($id);
            return $update;
        } else {
            return "Incorrect user details.";
        };
    }

    public function isItemExists($item_code){
        $dbObj = new databaseConnect();
        $connection = $dbObj->openDBConn();
        if($connection != "-1"){
        }else{
            return "Could not connect to host.";
        };

        //Check Query
        $check = "select * from item_management where item_code = '{$item_code}' and item_status = '1'";
        $stmt = $connection->query($check);
        if($stmt){
        }else{
            return "Error checking item.";
        };

        if ($stmt->num_rows > 0) {
            return 1;
        };
        return 0;
    }

    public function addItem($item_code, $item_quantity, $item_description, $item_name, $user_id){
        $opeObj = new Operations();
        $item_code = $opeObj->clean_string($item_code);
        $item_quantity = $opeObj->clean_string($item_quantity);
        $item_description = $opeObj->clean_string($item_description);
        $item_name = $opeObj->clean_string($item_name);

        if($item_code != '' AND $item_quantity != '' AND $item_description != '' AND $item_name != '' AND $user_id != ''){
        }else{
            return "Required fields are empty.";
        };

        $item_exists = $this->isItemExists($item_code);
        if($item_exists != 1){
        }else{
            return "Item already exists.";
        };

        $dbObj = new databaseConnect();
        $connection = $dbObj->openDBConn();
        if($connection != "-1"){
        }else{
            return "Could not connect to host.";
        };

        //Add Query
        $tsql = "insert into item_management(item_name, item_code, item_quantity, item_description, added_by, date_added)
                 values ('{$item_name}','{$item_code}','{$item_quantity}','{$item_description}','{$user_id}', NOW())";
        $connection->query($tsql);

        if ($connection->affected_rows > 0) {
            return 1;
        }else{
            return "Error adding item.";
        };
    }

    public function updateItem($record_id, $item_code, $item_quantity, $item_description, $item_name, $user_id){
        $opeObj = new Operations();
        $uid = $opeObj->clean_string($record_id);
        $item_code = $opeObj->clean_string($item_code);
        $item_quantity = $opeObj->clean_string($item_quantity);
        $item_description = $opeObj->clean_string($item_description);
        $item_name = $opeObj->clean_string($item_name);

        if($item_code != '' AND $item_quantity != '' AND $item_description != '' AND $item_name != '' AND $user_id != ''){
        }else{
            return "Required fields are empty.";
        };

        $dbObj = new databaseConnect();
        $connection = $dbObj->openDBConn();
        if($connection != "-1"){
        }else{
            return "Could not connect to host.";
        };

        //Update Query
        $update = "update item_management 
                   set item_name = '{$item_name}', item_code = '{$item_code}', item_quantity = '{$item_quantity}', item_description = '{$item_description}', date_added = NOW()
                   where id = '$uid' limit 1";
        $connection->query($update);

        if ($connection->affected_rows > 0) {
            return 1;
        }else{
            return "Error updating item.";
        };
    }

    public function deleteItem($record_id, $user_id){
        $opeObj = new Operations();
        $rid = $opeObj->clean_string($record_id);

        if($rid != '' AND $user_id != ''){
        }else{
            return "Required fields are empty.";
        };

        $dbObj = new databaseConnect();
        $connection = $dbObj->openDBConn();
        if($connection != "-1"){
        }else{
            return "Could not connect to host.";
        };

        //Delete Query
        $delete = "update willatoc_system.item_management 
                   set item_status = 0, added_by = '$user_id'
                   where id = '$rid' limit 1";
        $connection->query($delete);

        if ($connection->affected_rows > 0) {
            return 1;
        }else{
            return "Error updating item.";
        };
    }

    public function getItems(){
        $dbObj = new databaseConnect();
        $connection = $dbObj->openDBConn();
        if($connection != "-1"){
        }else{
            return "Could not connect to host.";
        };

        $query = "select * from willatoc_system.item_management where item_status = 1 order by id";
        $stmt = $connection->query($query);
        if($stmt){
        }else{
            return "Error checking items.";
        };

        if($stmt->num_rows > 0){
            $list = array();
            while($row = $stmt->fetch_assoc()){
                $list[]=array("recordId"=>$row['id'],
                    "itemName"=>$row['item_name'],
                    "itemCode"=>$row['item_code'],
                    "itemQuantity"=>$row['item_quantity'],
                    "itemDescription"=>substr($row['item_description'],0,50));
            };
            return $list;
        }else{
            return "No Items Found.";
        };
    }
}
?>