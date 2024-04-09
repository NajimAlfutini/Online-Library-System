<?php 
    // connection with the database
    $db = new PDO('mysql:host=localhost;dbname=project_library_db;charset=utf8', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>