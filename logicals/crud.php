<?php
try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=eromu',
        'eromu',
        'Azure2020',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    $muvelet = isset($_GET['muvelet']) ? $_GET['muvelet'] : '';

    if ($muvelet == 'uj' && isset($_POST['mentes'])) {
        $nev = trim($_POST['nev']);
        $megyeid = trim($_POST['megyeid']);

        if ($nev != '' && $megyeid != '') {
            $sql = "INSERT INTO helyszin (nev, megyeid)
                    VALUES (:nev, :megyeid)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':nev' => $nev,
                ':megyeid' => $megyeid
            ));
            $crud_uzenet = "Az új rekord mentése sikerült.";
        } else {
            $crud_uzenet = "Minden mező kitöltése kötelező.";
        }
    }

    if ($muvelet == 'torol' && isset($_GET['id'])) {
        $sql = "DELETE FROM helyszin WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $_GET['id']));
        $crud_uzenet = "A rekord törlése sikerült.";
    }

    if ($muvelet == 'modosit' && isset($_GET['id'])) {
        if (isset($_POST['modositas'])) {
            $nev = trim($_POST['nev']);
            $megyeid = trim($_POST['megyeid']);

            if ($nev != '' && $megyeid != '') {
                $sql = "UPDATE helyszin
                        SET nev = :nev, megyeid = :megyeid
                        WHERE id = :id";
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(
                    ':nev' => $nev,
                    ':megyeid' => $megyeid,
                    ':id' => $_GET['id']
                ));
                $crud_uzenet = "A rekord módosítása sikerült.";
            } else {
                $crud_uzenet = "Minden mező kitöltése kötelező.";
            }
        }

        $sql = "SELECT * FROM helyszin WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $_GET['id']));
        $szerkesztettAdat = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $sql = "SELECT * FROM helyszin ORDER BY id DESC";
    $stmt = $dbh->query($sql);
    $adatok = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    $crud_uzenet = "Adatbázis hiba: " . $e->getMessage();
}
?>