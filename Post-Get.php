<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Islemleri</title>
</head>
<style>

    .form{
        width: 100%;
        height: 500px;
        background-color: lightgray;
    }

</style>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=hastane", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Baglantı basarılı";

} catch(PDOException $e) {
    echo "baglantı basarısız <br> " . $e->getMessage();
}
?>

<div class="form">
    <form action="?islem=ekle" method="post">
        <span style="font-size: 18px">Ad Soyad:</span> <input type="text" name="adsoy">
        <span style="font-size: 18px">Departman:</span> <select name="bolum">
            <option>Seçiniz</option>
            <option>IT</option>
            <option>Muhasebe</option>
            <option>İK</option>

        </select>
        <input type="submit" value="kaydet">
    </form>
</div>

<?php

if ($_REQUEST['islem']=="ekle")
{
    $adsoy=$_REQUEST['adsoy'];
    $bolum=$_REQUEST['bolum'];
    $sql="INSERT INTO calisan (adsoy,departman) VALUES ('$adsoy','$bolum')";
    $db->exec($sql);
    echo "Ekleme Yapıldı. <br>";
    header("Location: ?islem=eklendi");
}


?>
<?php

if ($_REQUEST['islem']=="sil")
{

    $id=$_REQUEST['id'];
    $sql="DELETE FROM calisan WHERE Id=$id";
    $db->exec($sql);
    echo "Silme Yapıldı. <br>";
    header("Location: ?islem=silindi");
}


?>
*********LİSTE********

<table border="1" width="400">
    <tr>
        <th>ADI SOYADI</th>
        <th>Departman</th>
        <th>ID</th>
        <th>SİL</th>
    </tr>


<?php

$sql="SELECT * FROM calisan";

foreach ($db->query($sql) as $veri)
{
?>

    <tr>
        <td><?=$veri['adsoy']?></td>
        <td><?=$veri['departman']?></td>
        <td><?=$veri['Id']?></td>
        <td><a href="?islem=sil&id=<?=$veri['Id']?>">SİL</a></td>
    </tr>

<?php
}
?>
</table>









</body>
</html>



