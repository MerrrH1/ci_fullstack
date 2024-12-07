<table class="table-bordered table text-center align-middle">
    <tr>
        <th scope="row">No</th>
        <th scope="row">ID Produk</th>
        <th scope="row">Nama Produk</th>
        <th scope="row">Nama Kategori</th>
        <th scope="row">Nama Satuan</th>
        <th scope="row">Barcode</th>
        <th scope="row">Harga Beli</th>
        <th scope="row">Harga Jual</th>
        <th scope="row">Harga Pokok</th>
        <th scope="row">Status</th>
        <th scope="row">Aksi</th>
    </tr>
    <?php foreach ($data->result() as $i => $row) { ?>
        <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row->id_produk; ?></td>
            <td><?= $row->nama_produk; ?></td>
            <td><?= $row->nama_kategori; ?></td>
            <td><?= $row->nama_satuan; ?></td>
            <td><?= $row->barcode; ?></td>
            <td><?= $row->harga_beli; ?></td>
            <td><?= $row->harga_jual; ?></td>
            <td><?= $row->harga_pokok ?></td>
            <td><?= $row->status; ?></td>
            <td>
                <a href="<?= base_url('produk/edit/' . $row->id_produk) ?>" class="btn btn-primary">Edit</a>
                <a href="<?= base_url('produk/hapus/' . $row->id_produk) ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>