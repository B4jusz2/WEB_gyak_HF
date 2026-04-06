<?php session_start(); ?>
<?php if(file_exists('./logicals/'.$keres['fajl'].'.php')) { include("./logicals/{$keres['fajl']}.php"); } ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $ablakcim['cim'] . (isset($ablakcim['motto']) ? ' | ' . $ablakcim['motto'] : '') ?></title>
    <link rel="stylesheet" href="./styles/stilus.css" type="text/css">
    <?php if(file_exists('./styles/'.$keres['fajl'].'.css')) { ?>
        <link rel="stylesheet" href="./styles/<?= $keres['fajl'] ?>.css" type="text/css">
    <?php } ?>
</head>
<body>
    <header>
        <img src="./images/<?= $fejlec['kepforras'] ?>" alt="<?= $fejlec['kepalt'] ?>">
        <div>
            <h1><?= $fejlec['cim'] ?></h1>
            <?php if(isset($fejlec['motto']) && $fejlec['motto'] != '') { ?>
                <h2><?= $fejlec['motto'] ?></h2>
            <?php } ?>
            <?php if(isset($_SESSION['login'])) { ?>
                <p>Bejelentkezve: <strong><?= $_SESSION['csn'] . " " . $_SESSION['un'] . " (" . $_SESSION['login'] . ")" ?></strong></p>
            <?php } ?>
        </div>
    </header>

    <div id="wrapper">
        <nav>
            <ul>
                <?php foreach ($oldalak as $url => $oldal) { ?>
                    <?php if ((!isset($_SESSION['login']) && $oldal['menun'][0]) || (isset($_SESSION['login']) && $oldal['menun'][1])) { ?>
                        <li<?= (($oldal == $keres) ? ' class="active"' : '') ?>>
                            <a href="<?= ($url == '/') ? '.' : $url ?>">
                                <?= $oldal['szoveg'] ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </nav>

        <main id="content">
            <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
        </main>
    </div>

    <footer>
        <?php if(isset($lablec['copyright'])) { ?>
            &copy; <?= $lablec['copyright'] ?>
        <?php } ?>
        <?php if(isset($lablec['ceg'])) { ?>
            - <?= $lablec['ceg'] ?>
        <?php } ?>
    </footer>
</body>
</html>