<?php

$title = 'Lihat Transaksi';

require_once "template/theHeader.php";

?>

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title is-4">Lihat Transaksi</h1>
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

if (isset($_GET['id'])) {
    $query = $conn->query(sprintf("SELECT * FROM transaksi JOIN barang ON barang.id_barang = transaksi.barang_id JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.pelanggan_id WHERE id_transaksi = %s", $_GET['id']));

    $item = $query->fetch_object();
} else {
    return header('Location:transaksi.php');
}

?>

<div class="field">
    <label class="label">Nama Pelanggan</label>
    <pre><?= $item->nama_pelanggan; ?></pre>
</div>

<div class="field">
    <label class="label">Nama Barang</label>
    <pre><?= $item->nama_barang; ?></pre>
</div>

<div class="field">
    <label class="label">Harga</label>
    <pre><?= money($item->harga_transaksi); ?></pre>
</div>

<div class="field">
    <label class="label">Jumlah Barang</label>
    <pre><?= $item->jumlah_transaksi . 'Kg'; ?></pre>
</div>

<div class="field">
    <label class="label">Total</label>
    <pre><?= money($item->total_transaksi); ?></pre>
</div>

<div class="field">
    <label class="label">Tanggal Transaksi</label>
    <pre><?= $item->tanggal_transaksi; ?></pre>
</div>

<?php

require_once "template/theFooter.php"

?>