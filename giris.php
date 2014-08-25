<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="page-header">
<h1>Giriş</h1>
</div>

<?php
if (isset($_POST['giris'])) {
        include "veritabani.php";

        $query = $db->prepare("SELECT * FROM kullanicilar WHERE
                kullanici_adi = :kullanici_adi AND
                parola = :parola");

        $query->execute(array(
                ':kullanici_adi' => $_POST['kullanici_adi'],
                ':parola' => sha1($_POST['parola'])
        ));

        if ($query->rowCount() > 0) {
                session_start();
                $_SESSION['admin'] = 1;
                header("Location: admin.php");
                exit;
        }
        else {
                echo '<div class="alert alert-danger">Hatalı kullanıcı adı veya parolası.</div>';
        }
}
?>

<form method="post">
<div class="form-group">
        <label>Kullanıcı Adı:</label>
        <input type="text" name="kullanici_adi" class="form-control">
</div>
<div class="form-group">
        <label>Parola:</label>
        <input type="password" name="parola" class="form-control">
</div>
<input type="submit" value="Giriş Yap" name="giris" class="btn btn-primary">
</form>
</div>
</div>
</body>
</html>