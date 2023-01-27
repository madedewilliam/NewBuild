<?php
    /*
        ===========================================================
        RoomRaccoon Technical Assessment by William Madede
        ===========================================================
        Author: William Madede
        Project: RoomRaccoon Technical Assessment

        You may not copy, alter or distribute this code without
        the express permission from the author.
        ===========================================================
    */
    /*
        Session Data Config
        This checks session data activity
    */
    session_start();
    ob_start();
    if(isset($_SESSION['username']) AND (isset($_SESSION['system_user'])) AND (isset($_SESSION['last_activity']))){
            $cur_time = time();
            if($cur_time - $_SESSION['last_activity'] > 1800) { //Any activity within any 30 minutes
                $_SESSION['errmsg'] = "Your session has timed out, Please login again.";
                unset($_SESSION['username']);
                unset($_SESSION['id']);
                unset($_SESSION['active']);
                unset($_SESSION['system_user']);
                unset($_SESSION['last_activity']);
                echo "<script>location='index'</script>";
                die;
            }else{
                session_regenerate_id(true); 
                $_SESSION['last_activity'] = time();
            };
    }else{

        $_SESSION['errmsg'] = "Please login.";
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        unset($_SESSION['active']);
        unset($_SESSION['system_user']);
        unset($_SESSION['last_activity']);
        echo "<script>location='index'</script>";
        die;
    };
    ob_end_clean();
?>