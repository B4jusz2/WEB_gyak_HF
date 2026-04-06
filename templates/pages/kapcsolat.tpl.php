<h2>Kapcsolat</h2>

<p>
Ha kérdése van, vagy üzenetet szeretne küldeni, töltse ki az alábbi űrlapot!
</p>

<?php if(isset($uzenet)) { ?>
    <p><strong><?= $uzenet ?></strong></p>
<?php } ?>

<form method="post" action="kapcsolat">
    <p>
        <label>Név:</label><br>
        <input type="text" name="nev" value="<?= isset($_POST['nev']) ? $_POST['nev'] : '' ?>">
    </p>

    <p>
        <label>Email:</label><br>
        <input type="text" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
    </p>

    <p>
        <label>Tárgy:</label><br>
        <input type="text" name="targy" value="<?= isset($_POST['targy']) ? $_POST['targy'] : '' ?>">
    </p>

    <p>
        <label>Üzenet:</label><br>
        <textarea name="uzenet" rows="5"><?= isset($_POST['uzenet']) ? $_POST['uzenet'] : '' ?></textarea>
    </p>

    <p>
        <input type="submit" name="kuldes" value="Üzenet küldése">
    </p>
</form>

<hr>

<h3>Elérhetőség</h3>
<p>
Email: info@szeleromu.hu<br>
Telefon: +36 30 123 4567
</p>