<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border color-header">
                <h3 class="box-title"><i class="fa fa-th"></i>Data Satuan Barang</h3>
                <div class="box-tools pull-right my-4">
                    <a href="<?= base_url('satuan'); ?>" class="btn btn-default btn-sm">
                        <span class="fa fa-refresh"></span> Refresh
                    </a>
                    <button type="button" class="btn btn-sm btn-success btnTambah" id="btnTambah">
                        <span class="fa fa-plus"> Tambah</span>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-condensed" id="mydata">
                            <thead>
                                <tr>
                                    <th style="width: 30px; text-align: center;">#No</th>
                                    <th>Satuan Barang</th>
                                    <th style="widthL 120px; text-align: center;">Action</th>
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

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModaCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Satuan Barang</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form_add">
                    <input type="hidden" name="id_satuan" id="id_satuan">
                    <div class="form-group">
                        <label for="nama_satuan">Nama Satuan</label>
                        <input type="text" class="form-control" name="nama_satuan" id="nama_satuan" placeholder="Nama Kategori">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="btnSimpan" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>Processing ">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var bEdit = false;
        tampil_data();

        function tampil_data() {
            $.ajax({
                url: "<?= base_url('satuan/tampilkanData'); ?>",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    var i;
                    var no = 0;
                    var html = "";
                    for (i = 0; i < response.length; i++) {
                        no++;
                        html = html + '<tr>'
                            + '<td>' + no + '</td>'
                            + '<td>' + response[i].nama_satuan + '</td>'
                            + '<td><center>' + '<span><button edit-id="' + response[i].id_satuan +
                            '" class="btn btn-success btn-xs btn_edit"><i class="fa fa-edit"></i> Edit</button><button style="margin-left: 5px;" data-id="'
                            + response[i].id_satuan + '" class="btn btn-danger btn-xs btn_hapus"><i class="fa fa-trash"></i> Hapus</button></span>' + '</td>'
                            + '</tr>';
                    }
                    $("#tbl_data").html(html);
                    $("#mydata").DataTable();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }

        $(document).on('click','#btnTambah', function(e) {
            e.preventDefault();
            bEdit = false;
            $('#form_add')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#formModal').modal('show');
            $('.modal-title').text("Tambah Satuan Barang");
        });

        
    })
</script>