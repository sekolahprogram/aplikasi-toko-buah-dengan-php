<?php

$title = 'Tambah Transaksi';

require_once "template/theHeader.php";

?>

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title is-4">Tambah Transaksi</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <a href="transaksi.php" class="button is-light">Kembali</a>
        </div>
    </div>
</div>

<hr>

<?php

if (isset($_POST['simpan'])) {
    $query = $conn->query(sprintf("SELECT * FROM barang WHERE id_barang = '%s'", $_POST['barang']));
    $barang = $query->fetch_object();

    if ($barang->stok_barang >= $_POST['jumlah']) {

        $total = $barang->harga_barang * $_POST['jumlah'];

        $stok = $barang->stok_barang - $_POST['jumlah'];
        update('barang', ['stok_barang', $stok], 'id_barang', $_POST['barang']);
    
        $fields = [
            'harga_transaksi' => $barang->harga_barang,
            'total_transaksi' => $total,
            'jumlah_transaksi' => $_POST['jumlah'],
            'pelanggan_id' => $_POST['pelanggan'],
            'barang_id' => $_POST['barang'],
        ];
    
        if (insert('transaksi', $fields)) {
            return header('Location:transaksi.php');
        }
    
        hasMessage('Maaf!, tidak dapat menyimpan data.');
    }

    hasMessage("Maaf!, stok barang hanya tersisa {$barang->stok_barang}Kg lagi.");

}

?>

<form action="" method="post">
    <div class="field">
        <label for="pelanggan" class="label">Nama Pelanggan</label>
        <div class="select">
            <select name="pelanggan" id="pelanggan" required>
                <option hidden>Pilih Nama Pelanggan</option>
                <optgroup label="Pilih Nama Pelanggan">
                    <?php
                    $query = $conn->query("SELECT * FROM pelanggan");

                    while ($item = $query->fetch_object()) {
                    ?>
                        <option value="<?= $item->id_pelanggan ?>"><?= $item->nama_pelanggan ?></option>
                    <?php } ?>
                </optgroup>
            </select>
        </div>
    </div>
    <div class="field">
        <label for="barang" class="label">Nama Barang</label>
        <div class="select">
            <select name="barang" id="barang" required>
                <option hidden>Pilih Nama Barang</option>
                <optgroup label="Pilih Nama Barang">
                    <?php
                    $query = $conn->query("SELECT * FROM barang");

                    while ($item = $query->fetch_object()) {
                    ?>
                        <option value="<?= $item->id_barang ?>"><?= $item->nama_barang ?></option>
                    <?php } ?>
                </optgroup>
            </select>
        </div>
    </div>
    <div class="field">
        <label for="jumlah" class="label">Jumlah Berat</label>
        <div class="control">
            <input type="number" name="jumlah" id="jumlah" class="input" placeholder="tulis dengan angka (Kg)" value="<?= old('jumlah') ?>" required>
        </div>
    </div>
    <div class="field">
        <button name="simpan" class="button is-success">Simpan</button>
    </div>
</form>

<?php

require_once "template/theFooter.php"

?>