<?php

$title = 'Edit Pelanggan';

require_once "template/theHeader.php";

?>

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title is-4">Edit Pelanggan</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <a href="pelanggan-show.php?id=<?= $_GET['id'] ?>" class="button is-light">Lihat</a>
        </div>
        <div class="level-item">
            <a href="pelanggan.php" class="button is-light">Kembali</a>
        </div>
    </div>
</div>

<hr>

<?php

if (isset($_POST['simpan'])) {

    $fields = [
        'nama_pelanggan' => $_POST['nama'],
        'telepon_pelanggan' => $_POST['telepon'],
        'alamat_pelanggan' => $_POST['alamat'],
    ];

    if (update('pelanggan', $fields, 'id_pelanggan', $_POST['id'])) {
        return header('Location:pelanggan.php');
    }

    hasMessage('Maaf!, tidak dapat menyimpan data.');
}

if (isset($_GET['id'])) {
    $query = $conn->query(sprintf("SELECT * FROM pelanggan WHERE id_pelanggan = %s", $_GET['id']));

    $item = $query->fetch_object();
} else {
    return header('Location:pelanggan.php');
}

?>

<form action="" method="post">

    <input type="hidden" name="id" value="<?= $item->id_pelanggan; ?>">

    <div class="field">
        <label for="nama" class="label">Nama Pelanggan</label>
        <div class="control">
            <input type="text" name="nama" id="nama" class="input" value="<?= old('nama', $item->nama_pelanggan); ?>" required>
        </div>
    </div>
    <div class="field">
        <label for="telepon" class="label">Telepon/Hp</label>
        <div class="control">
            <input type="tel" name="telepon" id="telepon" class="input" value="<?= old('telepon', $item->telepon_pelanggan); ?>" required>
        </div>
    </div>
    <div class="field">
        <label for="alamat" class="label">Alamat</label>
        <div class="control">
            <textarea name="alamat" id="alamat" cols="30" rows="10" class="textarea"><?= old('alamat', $item->alamat_pelanggan); ?></textarea>
        </div>
    </div>
    <div class="field">
        <button name="simpan" class="button is-success">Perbarui</button>
    </div>
</form>

<?php

require_once "template/theFooter.php"

?>