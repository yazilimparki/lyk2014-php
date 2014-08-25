<?php
session_start();

// Eger giris yapmamis ise, giris sayfasina yonlensin.
if ($_SESSION['admin'] != 1) {
        header("Location: giris.php");
        exit;
}

$sayfa_basligi = "Ögrenci Ekle";
include "ust.php";
include "veritabani.php";

if (isset($_POST['ekle'])) {
        $query = $db->prepare("INSERT INTO ogrenci (ad, soyad, numara) VALUES (:ad, :soyad, :numara)");
        $query->execute(array(
                ':ad' => htmlentities($db->quote($_POST['ad'])),
                ':soyad' => $_POST['soyad'],
                ':numara' => $_POST['numara']
        ));
        $_SESSION['mesaj'] = 'Kayıt eklendi.';
        header("Location: admin.php");
        exit;
}
?>

<!-- burada ogrenciyi yeni kayit olarak ekleyecek -->
<!-- sonrada bari admin.php'ye yonlensin sayfa -->

<form method="post">
<div class="form-group">
        <label>Ad</label>
        <input type="text" name="ad" class="form-control">
</div>
<div class="form-group">
        <label>Soyad</label>
        <input type="text" name="soyad" class="form-control">
</div>
<div class="form-group">
        <label>Numara</label>
        <input type="text" name="numara" class="form-control">
</div>
<input type="submit" value="Ekle" name="ekle" class="btn btn-primary">
</form>

<?php include "alt.php" ?>