<h2>Képgaléria</h2>

<?php if(isset($_SESSION['login'])) { ?>
    <form action="kepek" method="post" enctype="multipart/form-data">
        <label for="kep">Kép kiválasztása:</label><br>
        <input type="file" name="kep" id="kep"><br><br>
        <input type="submit" name="feltoltes" value="Feltöltés">
    </form>
    <hr>
<?php } else { ?>
    <p>Képfeltöltéshez jelentkezzen be.</p>
<?php } ?>

<div class="galeria">
    <?php if(isset($kepek) && count($kepek) > 0) { ?>
        <?php foreach($kepek as $kep) { ?>
            <img src="./uploads/<?= $kep['fajlnev'] ?>" alt="Szélerőmű kép">
        <?php } ?>
    <?php } else { ?>
        <p>Még nincs feltöltött kép.</p>
    <?php } ?>
</div>