<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border color-header">
                <h3 class="box-title"><i class="fa fa-th"></i>Data Barang</h3>
                <div class="box-tools pull-right">
                    <a href="<?= base_url('produk'); ?>" class="btn btn-default btn-sm">
                        <span class="fa fa-refresh"></span> Refresh
                    </a>
                    <button type="button" id="btnTambah" class="btn btn-sm btn-success">
                        <span class="fa fa-plus"></span> Tambah
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-condensed" id="mydata">
                            <thead>
                                <tr>
                                    <th style="text-align: center;  width: 30px">#No</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Barang</th>
                                    <th style="text-align: center;  width: 90px">Harga Beli</th>
                                    <th style="text-align: center;  width: 80px">Harga Jual</th>
                                    <th style="text-align: center;  width: 80px">Harga Pokok</th>
                                    <th style="text-align: center;  width: 120px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span>&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Data Supplier Barang</h4>
            </div>
            <form action="" method="post" id="form_add">
                <div class="modal-body">
                    <input type="hidden" name="id_produk" id="id_produk">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kategori <span class="text-danger">*</span></label>
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    <option value="">- Pilih Kategori -</option>
                                    <?php foreach ($kategori as $row) {
                                        echo "<option value='$row->id_kategori'>$row->nama_kategori</option>";
                                    } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" name="nama_produk" id="nama_produk" autocomplete="off"
                                    class="form-control input-sm" placeholder="Nama Barang">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Satuan <span class="text-danger">*</span></label>
                                <select name="id_satuan" class="form-control" id="id_satuan">
                                    <option value="">- Pilih Satuan -</option>
                                    <?php 
                                    
                                    var_dump($kategori);
                                    foreach ($satuan as $row) {
                                        echo "<option value='$row->id_satuan'>$row->nama_satuan</option>";
                                    } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="for-group">
                                <label for="">Barcode</label>
                                <input type="text" name="barcode" autocomplete="off" placeholder="Nomor Kontak"
                                    id="barcode" class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Harga Beli <span class="text-danger">*</span></label>
                                <input type="text" name="harga_beli" autocomplete="off" id="harga_beli"
                                    class="form-control input-sm" onkeypress="return isNumber(this, event);"
                                    placeholder="Harga Beli">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Harga Jual <span class="text-danger">*</span></label>
                                <input type="text" name="harga_jual" autocomplete="off" id="harga_jual"
                                    class="form-control input-sm" onkeypress="return isNumber(this, event);"
                                    placeholder="Harga Jual">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Harga Pokok <span class="text-danger">*</span></label>
                                <input type="text" name="harga_Pokok" autocomplete="off" id="harga_pokok"
                                    class="form-control input-sm" onkeypress="return isNumber(this, event);"
                                    placeholder="Harga pokok">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnSimpan"
                    data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/validate.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var bEdit = false;
        tampil_data();

        function tampil_data() {
            $.ajax({
                url: '<?= base_url("produk/tampilkanData"); ?>',
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    var i;
                    var no = 0;
                    var html = "";
                    for (i = 0; i < response.length; i++) {
                        no++;
                        html = html + '<tr>'
                            + '<td>' + no + '</td>'
                            + '<td>' + response[i].nama_produk + '</td>'
                            + '<td>' + response[i].nama_kategori + '</td>'
                            + '<td>' + response[i].nama_satuan + '</td>'
                            + '<td style="text-align: center;">' + Intl.NumberFormat('id-ID').format(response[i].harga_beli) + '</td>'
                            + '<td style="text-align: center;">' + Intl.NumberFormat('id-ID').format(response[i].harga_jual) + '</td>'
                            + '<td style="text-align: center;">' + Intl.NumberFormat('id-ID').format(response[i].harga_pokok) + '</td>'
                            + '<td><center>' + '<span><button edit-id"' + response[i].id_produk +
                            '" class="btn btn-success btn-xs btn_edit"><i class="fa fa-edit"></i> Edit</button><button style="margin-left: 5px;" data-id="' + response[i].id_produk + '" class="btn btn-danger btn-xs btn_hapus><i class="fa fa-trash"></i> Hapus</button></span>' + '</td>'
                            + '</tr>';
                    }
                    $('#tbl_data').html(html);
                    $('#mydata').DataTable();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }

        $(document).on('click', '#btnTambah', function (e) {
            e.preventDefault();
            bEdit = false;
            $('#form_add')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#formModal').modal('show');
            $('.modal-title').text("Tambah Barang");
        });

        $('#tbl_data').on('click', '.btn_edit', function () {
            var id_produk = $(this).attr('edit-id');
            bEdit = false;
            $.ajax({
                url: '<?= base_url('produk/tampilkanDataById'); ?>',
                type: 'POST',
                data: { id_produk: id_produk },
                dataType: 'JSON',
                success: function (response) {
                    $('#form_add')[0].reset();
                    $('.form-group').removeClass('has-error');
                    $('help-block').empty();
                    $('.modal-title').text("Edit Barang");
                    $('input[name="nama_produk"]').val(response.nama_produk);
                    $('input[name="id_produk"]').val(response.id_produk);
                    $('input[name="id_kategori"]').val(response.id_kategori);
                    $('input[name="id_satuan"]').val(response.id_satuan);
                    $('input[name="barcode"]').val(response.barcode);
                    $('input[name="harga_beli"]').val(parseFloat(response.harga_beli).toFixed(0));
                    $('input[name="harga_jual"]').val(parseFloat(response.harga_jual).toFixed(0));
                    $('input[name="harga_pokok"]').val(parseFloat(response.harga_pokok).toFixed(0));
                    $('#formModal').modal('show');
                }
            });
        });

        $(document).on('click', '#btnSimpan', function (e) {
            e.preventDefault();
            var $this = $(this);
            var id_produk = $('#id_produk').val();
            var nama_produk = $('#nama_produk').val();
            var barcode = $('#barcode').val();
            var id_kategori = $('select[name="id_kategori"]').val();
            var id_satuan = $('select[name="id_satuan"]').val();
            var harga_beli = $('input[name="harga_beli"]').val();
            var harga_jual = $('input[name="harga_jual"]').val();
            var harga_pokok = $('input[name="harga_pokok"]').val();
            
            if(harga_beli && harga_jual && harga_pokok) {  
                harga_beli = harga_beli.replace(/[,.]/g, '');
    harga_jual = harga_jual.replace(/[,.]/g, '');
    harga_pokok = harga_pokok.replace(/[,.]/g, '');
            }

            if (bEdit) {
                var sURL = '<?= base_url('produk/perbaruiData'); ?>';
            } else {
                var sURL = '<?= base_url('produk/tambahData'); ?>'
            }
            $.ajax({
                url: sURL,
                type: 'POST',
                dataType: 'JSON',
                data: { id_produk: id_produk, nama_produk: nama_produk, barcode: barcode, id_kategori: id_kategori, id_satuan: id_satuan, harga_beli: harga_beli, harga_jual: harga_jual, harga_pokok: harga_pokok },
                beforeSend: function () {
                    $this.button('loading');
                },
                complete: function () {
                    $this.button('reset');
                },
                success: function (data) {
                    if (data.response == 'success') {
                        $('#form_add')[0].reset();
                        $('.form-group').removeClass('has-error');
                        $('.help-block').empty();
                        $('#formModal').modal('hide');
                        Swal.fire({
                            text: "Data berhasil disimpan",
                            icon: 'success',
                            title: 'Saving Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#mydata').dataTable({ "bDestroy": true }).fnDestroy();
                        tampil_data();
                    } else {
                        Swal.fire('Error!', 'Ops1 <br>' + data.message, 'error');
                    }
                }
            });
        });

        $('#tbl_data').on('click', '.btn_hapus', function (e) {
            e.preventDefault();
            var id_produk = $(this).attr('data-id');
            Swal.fire({
                title: "Hapus Data?",
                text: 'Anda yakin menghapus data barang ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Ya',
                preConfirm: () => {
                    return new Promise(function (resolve, reject) {
                        $.ajax({
                            url: '<?= base_url('produk/hapusData'); ?>',
                            type: 'POST',
                            dataType: 'JSON',
                            data: { id_produk: id_produk }
                        })
                            .done(function (data) {
                                resolve(data)
                            })
                            .fail(function (data) {
                                reject()
                            });
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    $('#mydata').dataTable({ "bDestroy": true }).fnDestroy();
                    tampil_data();
                    Swal.fire({
                        icon: 'success',
                        title: 'Data telah berhasil dihapus',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        });
    });
</script>