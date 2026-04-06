<?php
try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=eromu',
        'eromu',
        'Azure2020',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    if (isset($_POST['feltoltes']) && isset($_SESSION['login'])) {
        if (isset($_FILES['kep']) && $_FILES['kep']['error'] == 0) {
            $engedelyezett = array('jpg', 'jpeg', 'png', 'gif');
            $eredetiNev = $_FILES['kep']['name'];
            $kiterjesztes = strtolower(pathinfo($eredetiNev, PATHINFO_EXTENSION));

            if (!in_array($kiterjesztes, $engedelyezett)) {
                $kepuzenet = "Csak jpg, jpeg, png vagy gif fájl tölthető fel.";
            } else {
                $ujNev = time() . "_" . basename($eredetiNev);
                $cel = "./images/feltoltesek/" . $ujNev;

                if (move_uploaded_file($_FILES['kep']['tmp_name'], $cel)) {
                    $feltolto = $_SESSION['csn'] . " " . $_SESSION['un'];

                    $sql = "INSERT INTO kepek (fajlnev, feltolto, feltoltes_ideje)
                            VALUES (:fajlnev, :feltolto, NOW())";

                    $stmt = $dbh->prepare($sql);
                    $stmt->execute(array(
                        ':fajlnev' => $ujNev,
                        ':feltolto' => $feltolto
                    ));

                    $kepuzenet = "A kép feltöltése sikeres.";
                } else {
                    $kepuzenet = "A kép mentése nem sikerült.";
                }
            }
        } else {
            $kepuzenet = "Nem lett kép kiválasztva.";
        }
    }

    $sql = "SELECT * FROM kepek ORDER BY feltoltes_ideje DESC";
    $stmt = $dbh->query($sql);
    $kepek = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    $kepuzenet = "Adatbázis hiba: " . $e->getMessage();
}
?>
