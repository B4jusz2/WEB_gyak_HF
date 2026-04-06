<h2>Üzenetek</h2>
<?php if(!isset($_SESSION['login'])) { ?>
    <p>Az oldal megtekintéséhez be kell jelentkezni.</p>
<?php return; } ?>

<?php if(isset($hiba)) { ?>
    <p><strong><?= $hiba ?></strong></p>
<?php } ?>

<?php if(isset($uzenetek) && count($uzenetek) > 0) { ?>
    <table>
        <tr>
            <th>Küldő neve</th>
            <th>E-mail</th>
            <th>Tárgy</th>
            <th>Üzenet</th>
            <th>Küldés ideje</th>
        </tr>

        <?php foreach($uzenetek as $sor) { ?>
            <tr>
                <td><?= htmlspecialchars($sor['kuldo_nev']) ?></td>
                <td><?= htmlspecialchars($sor['email']) ?></td>
                <td><?= htmlspecialchars($sor['targy']) ?></td>
                <td><?= nl2br(htmlspecialchars($sor['uzenet'])) ?></td>
                <td><?= htmlspecialchars($sor['kuldes_ideje']) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>Még nincs elküldött üzenet.</p>
<?php } ?>