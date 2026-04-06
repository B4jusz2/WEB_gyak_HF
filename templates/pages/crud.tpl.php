<h2>CRUD alkalmazás</h2>

<?php if(isset($crud_uzenet)) { ?>
    <p><strong><?= $crud_uzenet ?></strong></p>
<?php } ?>

<p><a href="crud?muvelet=uj">Új helyszín felvétele</a></p>

<?php if(isset($_GET['muvelet']) && $_GET['muvelet'] == 'uj') { ?>
    <h3>Új rekord</h3>
    <form action="crud?muvelet=uj" method="post">
        <p>
            <label for="nev">Név:</label><br>
            <input type="text" name="nev" id="nev">
        </p>
        <p>
            <label for="megyeid">Megye ID:</label><br>
            <input type="number" name="megyeid" id="megyeid">
        </p>
        <p>
            <input type="submit" name="mentes" value="Mentés">
        </p>
    </form>
<?php } ?>

<?php if(isset($_GET['muvelet']) && $_GET['muvelet'] == 'modosit' && isset($szerkesztettAdat)) { ?>
    <h3>Rekord módosítása</h3>
    <form action="crud?muvelet=modosit&id=<?= $szerkesztettAdat['id'] ?>" method="post">
        <p>
            <label for="nev">Név:</label><br>
            <input type="text" name="nev" id="nev" value="<?= htmlspecialchars($szerkesztettAdat['nev']) ?>">
        </p>
        <p>
            <label for="megyeid">Megye ID:</label><br>
            <input type="number" name="megyeid" id="megyeid" value="<?= $szerkesztettAdat['megyeid'] ?>">
        </p>
        <p>
            <input type="submit" name="modositas" value="Módosítás mentése">
        </p>
    </form>
<?php } ?>

<h3>Nyilvántartott helyszínek</h3>

<?php if(isset($adatok) && count($adatok) > 0) { ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Név</th>
            <th>Megye ID</th>
            <th>Műveletek</th>
        </tr>
        <?php foreach($adatok as $sor) { ?>
            <tr>
                <td><?= $sor['id'] ?></td>
                <td><?= htmlspecialchars($sor['nev']) ?></td>
                <td><?= $sor['megyeid'] ?></td>
                <td>
                    <a href="crud?muvelet=modosit&id=<?= $sor['id'] ?>">Módosítás</a>
                    |
                    <a href="crud?muvelet=torol&id=<?= $sor['id'] ?>" onclick="return confirm('Biztosan törölni szeretné?')">Törlés</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>Nincs megjeleníthető rekord.</p>
<?php } ?>