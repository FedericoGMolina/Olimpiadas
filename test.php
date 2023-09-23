<?php
include './config/class_mysql.php';
include './config/db.php';

        if (!MysqlQuery::Guardar("rol", "rol", "'tilin'"))
            {
                echo 'ERROR';
                exit;
            }
   
?> 
