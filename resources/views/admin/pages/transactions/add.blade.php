@extends('admin.master.main')
@section('bartitle','Transaksi')
@section('pagetitle')
Transaksi
@endsection
@section('pagebreadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.transactions.daftar')}}">Transaksi</a></li>
<li class="breadcrumb-item active">Transaksi Baru</li>
@endsection
@section('pagecontent')
<div class="row">
  <div class="col-md-12">
    <form action="{{route('admin.transactions.save')}}" enctype="multipart/form-data" method="post">
      <div class="card">
        <div class="card-header">
          Transaksi baru
        </div>
        <div class="card-body">
          @csrf
          <div class="form-group">
            <label for="no_transaction">Kode Transaksi</label>
            <input type="text" name="no_transaction" value="{{old('no_transaction')}}" class="form-control" id="no_transaction_1" placeholder="Misal : 001">
          </div>
          <div class="form-group">
            <label for="transaction_date">Tanggal</label>
            <input name="transaction_date" type="date" id="transaction_date" class="form-control">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
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