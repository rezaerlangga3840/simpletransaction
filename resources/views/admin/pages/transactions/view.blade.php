@extends('admin.master.main')
@section('bartitle','Transaksi')
@section('pagetitle')
Transaksi
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.transactions.daftar')}}">Transaksi</a></li>
<li class="breadcrumb-item active">Lihat Transaksi</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        Detail Transaksi
      </div>
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-4">Kode Transaksi</dt>
          <dd class="col-sm-8">{{$transactions->no_transaction}}</dd>
          <dt class="col-sm-4">Tanggal Transaksi</dt>
          <dd class="col-sm-8">{{$transactions->transaction_date}}</dd>
        </dl>
      </div>
      <div class="card-footer">
        <a class="btn btn-success btn-sm" href="{{route('admin.transactions.edit',['id'=>$transactions->id])}}"><i class="fa fa-edit"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        Daftar Item
      </div>
      <div class="card-body">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></button>
        <form class="ajax-form" data-endpoint="{{route('admin.transactions.saveitem',['id'=>$transactions->id])}}" enctype="multipart/form-data" method="post"><!---->
          <div class="modal fade" id="addModal">
            <div class="modal-dialog">
              <div class="modal-content bg-primary">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Item</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @csrf
                  <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" name="item" class="form-control" id="item" placeholder="Misal : Bakmi">
                  </div>
                  <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input name="quantity" type="number" id="quantity" class="form-control">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-success" onclick="submitForm(this)">Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Nama Item</th>
            <th>Jumlah</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
            @foreach($transaction_details as $item_name)
              <tr>
                <td>{{$item_name->item}}</td>
                <td>{{$item_name->quantity}}</td>
                <td>
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_kategori_{{ $item_name->id }}"><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_{{ $item_name->id }}"><i class="fa fa-trash"></i></button>
                  <!--modal edit-->
                  <form class="ajax-form" data-endpoint="{{route('admin.transactions.updateitem',['id'=>$item_name->id])}}" enctype="multipart/form-data" method="post">
                    <div class="modal fade" id="edit_kategori_{{ $item_name->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-primary">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Item</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                              <label for="item">Item</label>
                              <input type="text" value="{{ $item_name->item }}" name="item" class="form-control" id="item" placeholder="Misal : 001">
                            </div>
                            <div class="form-group">
                              <label for="quantity">Jumlah</label>
                              <input name="quantity" value="{{ $item_name->quantity }}" type="number" id="quantity" class="form-control">
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" onclick="submitForm(this)">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!--modal delete-->
                  <form method="POST" action="{{route('admin.transactions.deleteitem',['id'=>$item_name->id])}}">
                    <div class="modal fade" id="hapus_kategori_{{$item_name->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                          <div class="modal-header">
                            <h4 class="modal-title">Peringatan!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin hapus item ini?</p>
                            @csrf
                            {{method_field('DELETE')}}
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Ya, hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        
    </div>
  </div>
</div>
@endsection
@section('customscripts')
<script>
  $(document).ready(function(){
    $('#no_transaction_1').on('input', function(){
      var inputData = $(this).val();
      $('#no_transaction_2').val(inputData);
    });
  });
</script>
<script>
  function submitForm(button) {
    var form = $(button).closest('form');
    var formData = new FormData(form[0]);
    var endpoint = form.data('endpoint');
    $.ajax({
      type: 'POST',
      url: endpoint,
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Tanggapan sukses (validasi berhasil)
        $(form).closest('.modal').modal('hide');
        // Tambahkan logika lainnya jika diperlukan
        location.reload();
      },
      error: function (xhr, status, error) {
        // Tanggapan error (validasi gagal)
        if (xhr.status === 422) {
          var errors = xhr.responseJSON.errors;
          for (var key in errors) {
            alert(errors[key][0]);
          }
        } else {
          alert('Terjadi kesalahan. Silakan coba lagi.');
        }
      }
    });
  }
  $(document).ready(function () {
    // Tangkap submit form secara global
    $('.ajax-form').submit(function (e) {
      e.preventDefault();
      submitForm($(this).find('button[type="button"]'));
    });
  });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  @if(Session::has('added'))
    toastr.success("{{Session::get('added')}}")
  @endif
  @if(Session::has('updated'))
    toastr.success("{{Session::get('updated')}}")
  @endif
  @if(Session::has('deleted'))
    toastr.success("{{Session::get('deleted')}}")
  @endif
</script>
@endsection