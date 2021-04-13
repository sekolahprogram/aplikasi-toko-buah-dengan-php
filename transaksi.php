<?php

$title = 'Semua Transaksi';

require_once "template/theHeader.php";

?>

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title is-4">Semua Transaksi</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <a href="transaksi-create.php" class="button is-light">Tambah</a>
        </div>
    </div>
</div>

<hr>

<?php

if (isset($_GET['hapus'])) {
    $query = $conn->query(sprintf("SELECT * FROM barang WHERE id_barang = '%s'", $_GET['id_barang']));
    $barang = $query->fetch_object();

    $stok = $barang->stok_barang + $_GET['stok'];
    $conn->query(sprintf("UPDATE barang SET stok_barang = '%s' WHERE id_barang = '%s'", $stok, $_GET['id_barang']));
    
    $sql = sprintf("DELETE FROM transaksi WHERE id_transaksi = %s", $_GET['hapus']);

    if ($conn->query($sql)) {
        return header('Location:transaksi.php');
    } else {
        $message = 'Maaf!, Tidak bisa menghapus data tersebut.';
    }
}

hasMessage();

?>

<div class="table-container">
    <table class="table is-hoverable is-striped is-fullwidth">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM transaksi JOIN barang ON barang.id_barang = transaksi.barang_id JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.pelanggan_id ORDER BY id_transaksi DESC";

            $query = $conn->query($sql);

            while ($item = $query->fetch_object()) {

            ?>
                <tr>
                    <td><?= $item->id_transaksi; ?></td>
                    <td><?= $item->nama_pelanggan; ?></td>
                    <td><?= $item->nama_barang; ?></td>
                    <td><?= money($item->harga_transaksi); ?></td>
                    <td><?= kilo($item->jumlah_transaksi); ?></td>
                    <td><?= money($item->total_transaksi); ?></td>
                    <td><?= dateTime($item->tanggal_transaksi); ?></td>
                    <td>
                        <a href="transaksi-show.php?id=<?= $item->id_transaksi; ?>" class="button is-small is-rounded is-outlined is-primary">
                            Lihat
                        </a>
                        <?php if (oldTime($item->tanggal_transaksi)) { ?>
                            <a href="transaksi-edit.php?id=<?= $item->id_transaksi; ?>" class="button is-small is-rounded is-outlined is-info">
                                Ubah
                            </a>
                            <a href="?hapus=<?= $item->id_transaksi; ?>&id_barang=<?= $item->barang_id; ?>&stok=<?= $item->jumlah_transaksi; ?>" class="button is-small is-rounded is-outlined is-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');">
                                Hapus
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php

require_once "template/theFooter.php"

?>