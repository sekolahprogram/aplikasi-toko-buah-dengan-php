<?php

$title = 'Tambah Pelanggan';

require_once "template/theHeader.php";

?>

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title is-4">Tambah Pelanggan</h1>
        </div>
    </div>
    <div class="level-right">
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

    if (insert('pelanggan', $fields)) {
        return header('Location:pelanggan.php');
    }

    hasMessage('Maaf!, tidak dapat menyimpan data.');
}

?>

<form action="" method="post">
    <div class="field">
        <label for="nama" class="label">Nama Pelanggan</label>
        <div class="control">
            <input type="text" name="nama" id="nama" class="input" value="<?= old('nama') ?>" required>
        </div>
    </div>
    <div class="field">
        <label for="telepon" class="label">Telepon/Hp</label>
        <div class="control">
            <input type="tel" name="telepon" id="telepon" class="input" value="<?= old('telepon') ?>" required>
        </div>
    </div>
    <div class="field">
        <label for="alamat" class="label">Alamat</label>
        <div class="control">
            <textarea name="alamat" id="alamat" cols="30" rows="10" class="textarea"><?= old('alamat') ?></textarea>
        </div>
    </div>
    <div class="field">
        <button name="simpan" class="button is-success">Simpan</button>
    </div>
</form>

<?php

require_once "template/theFooter.php"

?>