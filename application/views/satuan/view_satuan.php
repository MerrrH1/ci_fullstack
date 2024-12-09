<table class="table-bordered table text-center align-middle">
    <tr>
        <th scope="row">No</th>
        <th scope="row">ID Satuan</th>
        <th scope="row">Nama Satuan</th>
        <th scope="row">Aksi</th>
    </tr>
    <?php foreach ($data as $i => $row) { ?>
        <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row->id_satuan; ?></td>
            <td><?= $row->nama_satuan; ?></td>
            <td>
                <a href="<?= base_url('satuan/edit/' . $row->id_satuan) ?>" class="btn btn-primary">Edit</a>
                <a href="<?= base_url('satuan/hapus/' . $row->id_satuan) ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>