<?php
session_start();

// Eger giris yapmamis ise, giris sayfasina yonlensin.
if ($_SESSION['admin'] != 1) {
        header("Location: giris.php");
        exit;
}

$sayfa_basligi = "Ögrenci Güncelle";
include "ust.php";
include "veritabani.php";

if (isset($_POST['guncelle'])) {
        $query = $db->prepare("UPDATE ogrenci SET ad = :ad, soyad = :soyad, numara = :numara WHERE id = :id");
        $query->execute(array(
                ':ad' => $_POST['ad'],
                ':soyad' => $_POST['soyad'],
                ':numara' => $_POST['numara'],
                ':id' => $_GET['id']
        ));
        $_SESSION['mesaj'] = 'Kayıt güncellendi.';
        header("Location: admin.php");
        exit;
}

$query = $db->prepare("SELECT * FROM ogrenci WHERE id = :id");
$query->execute(array(':id' => $_GET['id']));
$ogrenci = $query->fetch(PDO::FETCH_ASSOC);
?>

<form method="post">
<div class="form-group">
        <label>Ad</label>
        <input type="text" name="ad" value="<?= $ogrenci['ad'] ?>" class="form-control">
</div>
<div class="form-group">
        <label>Soyad</label>
        <input type="text" name="soyad" value="<?= $ogrenci['soyad'] ?>" class="form-control">
</div>
<div class="form-group">
        <label>Numara</label>
        <input type="text" name="numara" value="<?= $ogrenci['numara'] ?>" class="form-control">
</div>
<input type="submit" value="Güncelle" name="guncelle" class="btn btn-primary">
</form>

<?php include "alt.php" ?>