<?php
session_start();

// Eger giris yapmamis ise, giris sayfasina yonlensin.
if ($_SESSION['admin'] != 1) {
        header("Location: giris.php");
        exit;
}

$sayfa_basligi = "Ögrenci Listesi";
include "ust.php";
include "veritabani.php";

if (isset($_SESSION['mesaj'])) {
        echo '<div class="alert alert-success">' . $_SESSION['mesaj'] . '</div>';
        unset($_SESSION['mesaj']);
}
?>

<!-- burada ogrenci listesi cikacak -->
<!-- her biri icin sil / guncelle -->

<!-- ornek tablo -->
<table class="table table-striped">
<thead>
        <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Numara</th>
                <th colspan="2"></th>
        </tr>
</thead>
<tbody>
<?php foreach ($db->query("SELECT * FROM ogrenci") as $ogrenci): ?>
        <tr>
                <td><?= $ogrenci['id'] ?></td>
                <td><?= $ogrenci['ad'] ?></td>
                <td><?= $ogrenci['soyad'] ?></td>
                <td><?= $ogrenci['numara'] ?></td>
                <td colspan="2" class="text-right">
                        <a href="ogrenci-sil.php?id=<?= $ogrenci['id'] ?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                        <a href="ogrenci-guncelle.php?id=<?= $ogrenci['id'] ?>" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
        </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php include "alt.php" ?>