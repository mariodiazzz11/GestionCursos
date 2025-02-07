<?php
    try {
        $enlace = new PDO ('mysql:host=127.0.0.1; dbname=cursoscp', "root", "");
        $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Error: ".$e->getMessage());
    }
?>