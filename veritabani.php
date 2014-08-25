<?php
try {
        $db = new PDO('mysql:host=localhost;dbname=test', 'root', 'vagrant');
}
catch (PDOException $e) {
        die('Veritabanına bağlantı kurulamadı.');
}