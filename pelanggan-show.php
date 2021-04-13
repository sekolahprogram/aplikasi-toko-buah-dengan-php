<?php

$title = 'Lihat Pelanggan';

require_once "template/theHeader.php";

?>

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title is-4">Lihat Pelanggan</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <a href="pelanggan-edit.php?id=<?= $_GET['id'] ?>" class="button is-light">Edit</a>
        </div>
        <div class="level-item">
            <a href="pelanggan.php" class="button is-light">Kembali</a>
        </div>
    </div>
</div>

<hr>

<?php

if (isset($_GET['id'])) {
    $query = $conn->query(sprintf("SELECT * FROM pelanggan WHERE id_pelanggan = %s", $_GET['id']));

    $item = $query->fetch_object();
} else {
    return header('Location:pelanggan.php');
}

?>

<div class="field">
    <label class="label">Nama Pelanggan</label>
    <pre><?= $item->nama_pelanggan; ?></pre>
</div>
<div class="field">
    <label class="label">Telepon/Hp</label>
    <pre><?= $item->telepon_pelanggan; ?></pre>
</div>
<div class="field">
    <label class="label">Alamat</label>
    <pre><?= $item->alamat_pelanggan; ?></pre>
</div>

<?php

require_once "template/theFooter.php"

?>