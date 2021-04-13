<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.2/css/bulma.min.css' integrity='sha512-byErQdWdTqREz6DLAA9pCnLbdoGGhXfU6gm1c8bkf7F51JVmUBlayGe2A31VpXWQP+eiJ3ilTAZHCR3vmMyybA==' crossorigin='anonymous' />
    <style type="text/css" media="print">
        @page {
            size: landscape;
        }
    </style>
</head>

<body>
    <?php

    require_once __DIR__ . "/config/config.php";

    ?>
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
    <script>
        window.print();
    </script>
</body>

</html>