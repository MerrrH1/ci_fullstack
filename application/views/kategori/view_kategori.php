<div class="row">
    <div class="col-md-5">
        <div class="box box-danger">
            <div class="box-header with-border color-header">
                <h3 class="box-title"><i class="fa fa-th"></i>Data <?= $judul; ?></h3>
                <div class="box-tools pull-right my-4">
                    <a href="<?= base_url('kategori'); ?>" class="btn btn-default btn-sm">
                        <span class="fa fa-refresh"></span>Refresh
                    </a>
                    <button type="submit" class="btn btn-small btn-success btnTambah" id="btnTambah">
                        <span class="fa fa-plus"></span>Tambah
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered table-condensed align-middle" id="mydata">
                            <thead>
                                <tr>
                                    <th style="width: 30px" class="text-center">#No</th>
                                    <th style="width: 200px;">Kategori</th>
                                    <th style="width: 200px" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="align-middle">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form_add">
                    <input type="hidden" name="id_kategori" id="id_kategori">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var btnEdit = false;
        tampil_data();

        function tampil_data() {
            $.ajax({
                url: '<?= base_url('kategori/getData'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var i;
                    var no = 0;
                    var html = "";

                    for (let i = 0; i < response.length; i++) {
                        no++;
                        html += '<tr>' +
                            '<td class="text-center">' + no + '</td>' +
                            '<td>' + response[i].nama_kategori + '</td>' +
                            '<td><center><span>' +
                            '<button edit-id="' + response[i].id_kategori + '" class="btn btn-success btn-xs btn_edit"><i class="fa fa-edit"></i>Edit</button>' +
                            '<button style="margin-left: 5px;" data-id="' + response[i].id_kategori + '" class="btn btn-danger btn-xs btn_hapus"><i class="fa fa-trash"></i>Hapus</button>' +
                            '</span></center></td>' +
                            '</tr>';
                    }
                    $('#tbl_data').html(html);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }

        $(document).on('click', '#btnTambah', function (e) {
            e.preventDefault();
            btnEdit = false;
            $('#form_add')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#formModal').modal('show');
            $('.modal-title').text("Tambah Kategori Barang");
        });
    });
</script>