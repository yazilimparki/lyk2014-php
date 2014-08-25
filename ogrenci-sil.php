<?php
session_start();

// Eger giris yapmamis ise, giris sayfasina yonlensin.
if ($_SESSION['admin'] != 1) {
        header("Location: giris.php");
        exit;
}

include "veritabani.php";

$query = $db->prepare("DELETE FROM ogrenci WHERE id = :id");
$query->execute(array(':id' => $_GET['id']));
$_SESSION['mesaj'] = 'Kayıt silindi.';
header("Location: admin.php");
