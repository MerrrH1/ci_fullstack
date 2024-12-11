<div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border color-header">
          <h3 class="box-title"><i class="fa fa-th"></i> Data Supplier Barang</h3>
          <div class="box-tools pull-right">
           <a class="btn btn-default btn-sm" href="<?php echo base_url('supplier'); ?>">
           <span class="fa fa-refresh"></span> Refresh</a>
           <button type="button" class="btn btn-sm btn-success btnTambah" id="btnTambah">
             <span class="fa fa-plus"></span> Tambah</button>
         </div>
       </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-condensed" id="mydata">
              <thead>
                <tr>
                  <th style='width:30px;text-align: center;'>#No</th>
                  <th>Nama Supplier</th>
                  <th>Kontak Person</th>
                  <th>Kota</th>
                  <th>Alamat</th>
                  <th>Telp/ Fax</th>
                  <th style='width:120px;text-align: center;'>Action</th>
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

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Data Supplier Barang</h4>
          </div>
          <form action="" method="post" id="form_add">
            <div class="modal-body">
              <input type="hidden" id="id_supp" name="id_supp">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                  <label for="">Jenis</label>
                    <select class="form-control" id="jenis" name="jenis">
                      <option value="PT">PT</option>
                      <option value="CV">CV</option>
                      <option value="UD">UD</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="">Nama Supplier</label>
                    <input type="text" id="nama_supp" name="nama_supp" autocomplete="off" class="form-control input-sm" 
                      placeholder="Nama Supplier">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Kontak Person</label>
                     <input type="text" id="kontak_person" name="kontak_person" autocomplete="off" class="form-control input-sm" 
                      placeholder="Kontrak Person">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nomor Kontak</label>
                    <input type="text" id="no_kontak" name="no_kontak" autocomplete="off" class="form-control input-sm" 
                      placeholder="Nomor Kontak">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Kota</label>
                     <input type="text" id="kota" name="kota" autocomplete="off" class="form-control input-sm" 
                      placeholder="Kota">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" id="email" name="email" autocomplete="off" class="form-control input-sm" 
                      placeholder="alamat email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">No Telp/HP</label>
                     <input type="text" id="no_telp" name="no_telp" autocomplete="off" class="form-control input-sm" 
                      placeholder="No Telp">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">No Fax</label>
                    <input type="text" id="no_fax" name="no_fax" autocomplete="off" class="form-control input-sm" 
                      placeholder="Nomor Fax">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Alamat</label>
                     <textarea class="required form-control" name="alamat" rows="2" placeholder="Alamat Lengkap" required></textarea>
                  </div>
                </div>
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary " id="btnSimpan"
              data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ">Simpan Data</button>
          </div>
        </div>
      </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var btnEdit=false;
    tampil_data();
    //Menampilkan Data di tabel
    function tampil_data(){
      $.ajax({
        url: '<?php echo base_url(); ?>supplier/tampilkanData',
        type: 'POST',
        dataType: 'json',
        success: function(response){
          console.log(response)
          var i;
          var no = 0;
          var html = "";
          for(i=0;i < response.length ; i++){
            no++;
            html = html + '<tr>'
            + '<td >' + no  + '</td>'
            + '<td><p><b>' + response[i].nama_supp + '</b>.' + response[i].jenis+ '</p></td>'
            + '<td><b><span class="label label-success">' + response[i].kontak_person + 
              '</span></b><br/><span class="label label-warning">' + response[i].no_kontak+'</span></td>'
            + '<td>' + response[i].kota + '</td>'
            + '<td>' + response[i].alamat + '</td>'
            + '<td><b><span class="label label-success">Telp: ' + response[i].no_telp + 
              '</b></span><br/><span class="label label-info">Fax: ' + response[i].no_fax +'</span></td>'
            + '<td><center>' + '<span><button edit-id="'+response[i].id_supp+
              '" class="btn btn-success btn-xs btn_edit"><i class="fa fa-edit"></i> Edit</button><button style="margin-left: 5px;" data-id="'
              +response[i].id_supp+'" class="btn btn-danger btn-xs btn_hapus"><i class="fa fa-trash"></i> Hapus</button></span>'  + '</td>'
            + '</tr>';
          }
          $("#tbl_data").html(html);
          $('#mydata').DataTable();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
      });
    }

    //Memanggil Modal kategori
    $(document).on("click", "#btnTambah", function(e){
      e.preventDefault();
      bEdit=false;
      $('#form_add')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#formModal').modal('show'); // Tampilkan bootstrap modal
      $('.modal-title').text('Tambah Kategori Barang'); // Set Judul modal
    });

    //Edit Kategori
    $("#tbl_data").on('click','.btn_edit',function(){
      var id_supp = $(this).attr('edit-id');
      bEdit=true;
      $.ajax({
        url: '<?php echo base_url(); ?>supplier/tampilkanDataByID',
        type: 'POST',
        data: {id_supp:id_supp},
        dataType: 'json',
        success: function(response){
          $('#form_add')[0].reset(); // reset form on modals
          $('.form-group').removeClass('has-error'); // clear error class
          $('.help-block').empty(); // clear error string
          $('.modal-title').text('Edit Kategori Barang'); // Set Title to Bootstrap modal title
          $('input[name="nama_supp"]').val(response.nama_supp);
          $('input[name="id_supp"]').val(response.id_supp);
          $('input[name="kontak_person"]').val(response.kontak_person);
          $('input[name="no_kontak"]').val(response.no_kontak);
          $('input[name="kota"]').val(response.kota);
          $('input[name="email"]').val(response.email);
          $('input[name="no_telp"]').val(response.no_telp);
          $('input[name="no_fax"]').val(response.no_fax);
          $('textarea[name="alamat"]').val(response.alamat);
          $("#formModal").modal('show');
        }
      })
    });

    //Kirim Data Proses Save/Update ke Controller
    $(document).on("click", "#btnSimpan", function(e){
      e.preventDefault();
      var $this = $(this);
      var formData = new FormData($('#form_add')[0]);
      if (bEdit){
        //Jika Edit, Update Data
        var sURL='<?php echo base_url(); ?>supplier/perbaruiData';
      }else{
        var sURL='<?php echo base_url(); ?>supplier/tambahData';
      }
      $.ajax({
          url: sURL,
          type: "post",
          dataType: "json",
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function () {
            $this.button('loading');
          },
          complete: function () {
            $this.button('reset');
          },
          success: function(data){
            if (data.responce == "success") {
              $("#form_add")[0].reset();
              $('.form-group').removeClass('has-error'); // clear error class
              $('.help-block').empty(); // clear error string
              $('#formModal').modal('hide');
              Swal.fire({
                text: 'Data berhasil di Simpan',
                icon: 'success',
                title: 'Saving Succes',
                showConfirmButton: false,
                timer: 1500
              });
              $('#mydata').dataTable({"bDestroy": true}).fnDestroy();
              tampil_data();
            }else{
              Swal.fire('Error!','Ops! <br>' + data.message,'error');
            }
          }
        });
    });

    //Hapus Data
    $("#tbl_data").on('click','.btn_hapus',function(e){
      e.preventDefault();
      var id_supp = $(this).attr('data-id');
      Swal.fire({
        title: 'Hapus Data?',
        text: 'Anda Yakin menghapus Data Supplier ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya',
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return new Promise(function(resolve,reject) {
            $.ajax({
              url: '<?php echo base_url(); ?>supplier/hapusData',
              type: 'POST',
              dataType: "json",
              data: {id_supp: id_supp}
            })
            .done(function(data) {
              resolve(data)
            })
            .fail(function() {
              reject()
            });
          })
        },
        allowOutsideClick: () => !swal.isLoading()
      }).then((result) => {
        if (result.value) {
          
         $('#mydata').dataTable({"bDestroy": true}).fnDestroy();
          tampil_data();
          Swal.fire({
            icon: 'success',
            title: 'Data Telah Berhasil di Hapus',
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
    });
  });
</script>