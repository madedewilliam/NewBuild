<?php
    class databaseConnect {
        function openDBConn() {
            require_once('db_config.php');
            $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if(!$connection){
                return "-1";
            };
            return $connection;
        }

        public function Close($link){
            $link->close();
        }
    };
?>