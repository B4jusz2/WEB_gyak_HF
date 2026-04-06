<?php
try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=eromu',
        'eromu',
        'Azure2020',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    $sql = "SELECT id, nev, email, targy, uzenet, kuldo_nev, kuldes_ideje
            FROM uzenetek
            ORDER BY kuldes_ideje DESC";

    $stmt = $dbh->query($sql);
    $uzenetek = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    $hiba = "Adatbázis hiba: " . $e->getMessage();
}
?>