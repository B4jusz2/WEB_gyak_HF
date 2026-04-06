<?php
if (isset($_POST['kuldes'])) {
    $nev = trim($_POST['nev']);
    $email = trim($_POST['email']);
    $targy = trim($_POST['targy']);
    $uzenetSzoveg = trim($_POST['uzenet']);

    if ($nev == "" || $email == "" || $targy == "" || $uzenetSzoveg == "") {
        $uzenet = "Minden mező kitöltése kötelező!";
    }
    elseif (mb_strlen($nev) < 3) {
        $uzenet = "A név legalább 3 karakter legyen!";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $uzenet = "Hibás e-mail cím!";
    }
    elseif (mb_strlen($targy) < 3) {
        $uzenet = "A tárgy legalább 3 karakter legyen!";
    }
    elseif (mb_strlen($uzenetSzoveg) < 10) {
        $uzenet = "Az üzenet legalább 10 karakter legyen!";
    }
    else {
        try {
            $dbh = new PDO(
                'mysql:host=localhost;dbname=eromu',
                'eromu',
                'Azure2020',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            if (isset($_SESSION['login'])) {
                $kuldoNev = $_SESSION['csn'] . " " . $_SESSION['un'];
            } else {
                $kuldoNev = "Vendég";
            }

            $sql = "INSERT INTO uzenetek (nev, email, targy, uzenet, kuldo_nev, kuldes_ideje)
                    VALUES (:nev, :email, :targy, :uzenet, :kuldo_nev, NOW())";

            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':nev' => $nev,
                ':email' => $email,
                ':targy' => $targy,
                ':uzenet' => $uzenetSzoveg,
                ':kuldo_nev' => $kuldoNev
            ));

            $uzenet = "Az üzenet mentése sikeres volt.";

            $_POST = array();
        }
        catch (PDOException $e) {
            $uzenet = "Adatbázis hiba: " . $e->getMessage();
        }
    }
}
?>