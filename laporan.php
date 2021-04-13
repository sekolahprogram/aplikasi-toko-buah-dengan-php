<?php

$title = 'Semua Laporan';

require_once "template/theHeader.php";

?>

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title is-4">Semua Laporan</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <a href="laporan-print.php" target="_blank" rel="noopener noreferrer" class="button is-light">Print</a>
        </div>
    </div>
</div>

<hr>

<div class="table-container">
    <table class="table is-hoverable is-striped is-fullwidth">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Telepon/Hp</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Tanggal Laporan</th>
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
                    <td><?= $item->telepon_pelanggan; ?></td>
                    <td><?= $item->nama_barang; ?></td>
                    <td><?= money($item->harga_transaksi); ?></td>
                    <td><?= kilo($item->jumlah_transaksi); ?></td>
                    <td><?= money($item->total_transaksi); ?></td>
                    <td><?= dateTime($item->tanggal_transaksi); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php

require_once "template/theFooter.php"

?>